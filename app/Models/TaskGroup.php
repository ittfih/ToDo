<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskGroup extends Model
{
    public $fillable = [
        'name',
        'protected'
    ];

    public function Tasks()
    {
        return $this->hasMany(Task::class);
    }
}
