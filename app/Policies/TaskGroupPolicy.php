<?php

namespace App\Policies;

use App\Models\TaskGroup;
use App\Models\User;
use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class TaskGroupPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function owner(User $user, TaskGroup $taskGroup)
    {
        return $user->id === $taskGroup->user_id;
    }

    public function add(User $user, TaskGroup $taskGroup)
    {
        if ($this->owner($user, $taskGroup)) return True;
        $permission = Permission::where('user_id', $user->id)
            ->where('task_group_id', $taskGroup->id)
            ->first();
        if ($permission != null && $permission->add_task == 1) return True;
        else return false;
    }

    //I don't like this fragment of code
    public function view(?User $user = null, TaskGroup $taskGroup)
    {
        if ($taskGroup->private == 0) return 1;
        if (Auth::check() == false) return 0;
        if ($this->owner($user, $taskGroup)) return 1;
        $permission = Permission::where('user_id', $user->id)
            ->where('task_group_id', $taskGroup->id)
            ->first();
        if ($permission != null) return 1;
        return 0;
    }

    public function edit(User $user, TaskGroup $taskGroup)
    {
        return $this->owner($user, $taskGroup);
    }
}
