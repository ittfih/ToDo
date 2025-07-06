<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionRequest;
use App\Models\Permission;
use App\Models\TaskGroup;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(int $taskGroupId)
    {
        $permissions = Permission::where('task_group_id', $taskGroupId)->get();
        $this->authorize('owner', TaskGroup::find($taskGroupId));
        return view('permission.index', [
            'id' => $taskGroupId,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(int $taskGroupId)
    {
        $this->authorize('owner', TaskGroup::find($taskGroupId));
        return view('permission.create', [
            'id' => $taskGroupId,
            'users' => User::all()->pluck('id', 'name')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PermissionRequest $request)
    {
        $taskGroup = TaskGroup::find($request->task_group_id);
        //$this->authorize('owner', $taskGroup);

        $user = User::find($request->user_id);
        if ($user == null) throw new Exception("user with id " . $request->user_id . " does not exists");

        $permission = new Permission();
        $permission->user_id = $request->user_id;
        $permission->task_group_id = $request->task_group_id;
        $permission->add_task = $request->boolean('add_task');
        $permission->edit_task = $request->boolean('edit_task');
        $permission->remove_task = $request->boolean('remove_task');
        $permission->change_status = $request->boolean('change_status');
        $permission->save();

        return redirect()->route('permission.index', $request->task_group_id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id, Permission $permission)
    {
        $this->authorize('owner', $permission);
        return view('permission.edit', [
            'id' => $id,
            'permission' => $permission,
            'users' => User::all()->pluck('id', 'name')
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(int $id, PermissionRequest $request, Permission $permission)
    {
        $this->authorize('owner', $permission);
        $user = User::find($request->user_id);
        if ($user == null) throw new Exception("user with id " . $request->user_id . " does not exists");

        $permission->user_id = $request->user_id;
        $permission->task_group_id = $request->task_group_id;
        $permission->add_task = $request->boolean('add_task');
        $permission->edit_task = $request->boolean('edit_task');
        $permission->remove_task = $request->boolean('remove_task');
        $permission->change_status = $request->boolean('change_status');
        $permission->save();

        return redirect()->route('permission.index', $request->task_group_id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, Permission $permission)
    {
        $this->authorize('owner', $permission);
        $taskGroupId = $permission->task_group_id;
        $permission->delete();

        return redirect()->route('permission.index', $taskGroupId);
    }
}
