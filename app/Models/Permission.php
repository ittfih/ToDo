<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'user_id',
        'add_task',
        'edit_task',
        'remove_task',
        'change_status'
    ];

    public function TaskGroup()
    {
        return $this->belongsTo(TaskGroup::class);
    }

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
