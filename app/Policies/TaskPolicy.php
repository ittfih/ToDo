<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function owner(User $user, Task $task)
    {
        return $user->id === $task->TaskGroup->user_id;
    }


    public function add(User $user, Task $task)
    {
        if ($this->owner($user, $task)) return True;
        $permission = Permission::where('user_id', $user->id)
            ->where('task_group_id', $task->TaskGroup->id)
            ->first();
        if ($permission != null && $permission->add_task == 1) return True;
        else return false;
    }

    public function edit(User $user, Task $task)
    {
        if ($this->owner($user, $task)) return True;
        $permission = Permission::where('user_id', $user->id)
            ->where('task_group_id', $task->TaskGroup->id)
            ->first();
        if ($permission != null && $permission->edit_task == 1) return True;
        else return false;
        //return $user->id === $task->TaskGroup->user_id;
    }

    public function remove(User $user, Task $task)
    {
        if ($this->owner($user, $task)) return True;
        $permission = Permission::where('user_id', $user->id)
            ->where('task_group_id', $task->TaskGroup->id)
            ->first();
        if ($permission != null && $permission->remove_task == 1) return True;
        else return false;
    }

    public function changeStatus(User $user, Task $task)
    {
        if ($this->owner($user, $task)) return True;
        $permission = Permission::where('user_id', $user->id)
            ->where('task_group_id', $task->TaskGroup->id)
            ->first();
        if ($permission != null && $permission->change_status == 1) return True;
        else return false;
    }
}
