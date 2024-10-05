<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $filliable = [
        "task_name",
        "assigned_to",
        "budget_allocated",
        "current_status",
        "created_by",
    ];
}
