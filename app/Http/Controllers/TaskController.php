<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
            $assigned_to = $finduser->id;
        }

        $validatedData = $request->validate([
            "task_name" => "required|max:255|unique:tasks,task_name",
            "assigned_to" => "required|max:255",
            "budget_allocated" => "numeric|min:0",  //must be a number and >= 0
            "current_status" => "required|in:backlog,inprogress,revision,done",
            "comments" => "nullable|array", // should be an array if provided
            "comment" => "string|max:500", // Each comment must be a string with max length 500
            "created_by" => "required|exists:users,id",

            // Validate Subtasks

            "task_items" => "nullable|array", // Subtasks can be provided or omitted
            "task_items.*.name" => "nullable|string|max:255", // Each subtask name is optional
            "task_items.*.completed" => "boolean", // Each subtask completion status must be a boolean

        ]);

        $task = Task::create([
            "task_name" => $validatedData["task_name"],
            "assigned_to" => $assigned_to,
            "budget_allocated" => $validatedData["budget_allocated"],
            "current_status" => $validatedData["current_status"],
            "created_by" => $validatedData["created_by"],
        ]);


        if (!empty($request->input('task_items'))) {
            if ($request->has('task_items') && is_array($request->input('task_items'))) {
                foreach ($request->input('task_items') as $subtask) {
                    Subtask::create([
                        'task_id' => $task->id,
                        'subtask_name' => $subtask['name'] ?? null, // Defaults to null if not provided
                        'completed' => $subtask['completed'] ?? false, // Defaults to false if not provided
                    ]);
                }
            }
        };


        // Handle file upload if present
        $file_name = null;
        $file_url = null;

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $file_name = time() . '_' . $file->getClientOriginalName();
            $file_url = $file->storeAs('uploads/comments', $file_name, 'public'); // Store in storage/app/public/uploads/comments
        }

        if (!empty($request->input('comments'))) {
            foreach ($request->input('comments') as $comment) {
                Comments::create([
                    'task_id' => $task->id,
                    'comment' => $comment,
                    // 'file_name' => $file_name,
                    // 'file_url' => $file_url,
                ]);
            }
        };
        return response()->json([
            "message" => "Task created"
        ], 200);
    }

    public function getTaskDetails() {}

    public function deleteTask() {}

    public function updateTask() {}
}
