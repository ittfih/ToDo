<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'status'
    ];

    public function TaskGroup()
    {
        return $this->belongsTo(TaskGroup::class);
    }
}
