<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'start_date' ,
        'client_name',
        'deadline',
        'status'
    ];

    public function employees()
    {
        return $this->belongsToMany(Employee::class, 'employee_project');
    }

}
