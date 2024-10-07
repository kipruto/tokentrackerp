<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'subtask_name',
        'completed',
    ];

    // Define the relationship with Task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
