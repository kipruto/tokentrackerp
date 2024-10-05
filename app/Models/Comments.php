<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'comment',
        'file_name',
        'file_url',
    ];

    // Define the relationship with Task
    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}

