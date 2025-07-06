<?php

namespace App\Policies;

use App\Models\Permission;
use App\Models\User;

class PermissionPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function owner(User $user, Permission $permission)
    {
        return $user->id === $permission->TaskGroup->user_id;
    }
}
