<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Contracts\Support\ValidatedData;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   public function createTask(Request $request){


    $validatedData = $request->validate([
        "task_name" => "required|max:255|unique:tasks,task_name",
        "assigned_to" => "required|max:255",
        "budget_allocated" => "numeric|min:0",  //must be a number and >= 0
        "current_status" => "required|in:pending,in_progress,revision,completed",
        "comments" => "nullable|array", // should be an array if provided
        "comments.*" => "string|max:500", // Each comment must be a string with max length 500
        "file_name" => "nullable|string|max:255", // Optional file name
        "file_url" => "nullable|url", // Optional URL must be valid
        "created_by" => "required|exists:users,id",
    ]);

    Task::create([

        "task_name" => $validatedData["task_name"],
        "assigned_to" => $validatedData["assigned_to"],
        "budget_allocated" => $validatedData["budget_allocated"],
        "current_status" => $validatedData["current_status"],
        "file_name" => $validatedData[ "file_name"],
        "file_url" => $validatedData["file_url"],
        "created_by" => $validatedData["created_by"],



    ]);




   }

   public function getTaskDetails(){

   }

   public function deleteTask(){


   }

   public function updateTask(){

   }



}
