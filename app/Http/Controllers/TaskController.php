<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Subtask;
use App\Models\Comments;
use App\Models\User;

class TaskController extends Controller
{
    public function createTask(Request $request)
    {

        $userId = $request->input('assigned_to');
        $finduser = User::find($userId);
        if ($finduser) {
            $assigned_to = $finduser.id;
            console.log($assigned_to);
        }

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

            'task_id' => 'required|exists:tasks,id',
            'comment_text' => 'required|string|max:500',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $task = Task::create([
            "task_name" => $validatedData["task_name"],
            "assigned_to" => $assigned_to,
            "budget_allocated" => $validatedData["budget_allocated"],
            "current_status" => $validatedData["current_status"],
            "file_name" => $validatedData["file_name"],
            "file_url" => $validatedData["file_url"],
            "created_by" => $validatedData["created_by"],
        ]);


        $subtask = "";
        if (!empty($request->input('task_list'))) {
            foreach ($request->input('task_list') as $subtask) {
                $subtask = $subtask;
            }
        };

        Subtask::create([
            'task_id' => $task->id,
            'subtask_name' => $subtask['name'],
            'status' => $subtask['status'],
        ]);

        $eachcomment = "";
        if (!empty($request->input('comments'))) {
            foreach ($request->input('comments') as $comment) {
                $eachcomment = $comment;
            }
        };

        Comments::create([
            'task_id' => $task->id,
            'comment' => $eachcomment,
        ]);


    // Handle file upload if present
    $file_name = null;
    $file_url = null;

    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $file_name = time() . '_' . $file->getClientOriginalName();
        $file_url = $file->storeAs('uploads/comments', $file_name, 'public'); // Store in storage/app/public/uploads/comments
    }

    // Create a new comment with optional file info
    Comment::create([
        'task_id' => $validatedData['task_id'],
        'comment_text' => $validatedData['comment_text'],
        'file_name' => $file_name,
        'file_url' => $file_url,
    ]);


    }

    public function getTaskDetails() {}

    public function deleteTask() {}

    public function updateTask() {}
}
