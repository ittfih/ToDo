<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskGroupRequest;
use App\Models\Permission;
use App\Models\TaskGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskgroupsids = Permission::where('user_id', Auth::id())->pluck('task_group_id');
        $sharedTaskGroups = TaskGroup::whereIn('id', $taskgroupsids)->get();
        return view('taskgroup.index', [
            'taskGroups' => TaskGroup::where('user_id', Auth::id())->get(),
            'sharedTaskGroups' => $sharedTaskGroups
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('taskgroup.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskGroupRequest $request)
    {
        $taskgroup = new TaskGroup();
        $taskgroup->user_id = Auth::id();
        $taskgroup->name = $request->input('name');
        $taskgroup->private = $request->boolean('private');
        $taskgroup->save();

        // TaskGroup::create($request->validated());

        return redirect()->route('taskgroup.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $taskGroup = TaskGroup::find($id);
        $this->authorize('view', $taskGroup);

        return view('taskgroup.show', [
            'taskGroup' => $taskGroup
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $taskGroup = TaskGroup::find($id);

        $this->authorize('edit', $taskGroup);

        return view('taskgroup.edit',  [
            'taskGroup' => $taskGroup
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $taskGroup = TaskGroup::find($id);
        $this->authorize('edit', $taskGroup);
        $taskGroup->name = $request->name;
        $taskGroup->private = $request->boolean('private');
        $taskGroup->save();
        return redirect()->route('taskgroup.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $taskGroup = TaskGroup::find($id);
        $this->authorize('edit', $taskGroup);
        $taskGroup->delete();
        return redirect()->route('taskgroup.index');
    }
}
