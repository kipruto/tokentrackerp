<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ProjectController extends Controller
{
    // Fetch all projects
    public function index()
    {
        $projects = Project::paginate(10);
        return response()->json($projects, 200);
    }

    // Fetch a specific project
    public function show($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Projects not found'], 404);
        }

        return response()->json($project, 200);
    }

    // Create a new project
    public function store(Request $request)
    {
         // Define validation rules
    $validator = Validator::make($request->all(), [
        'project_name' => 'required|string|max:255',
        'client_id' => 'required|string|max:255',
        'start_date' => 'required|date',
        'deadline' => 'required|date|after_or_equal:start_date',
        'status' => 'required|in:active,inactive,pending,completed,cancelled',
    ]);

    // If validation fails, return a 422 response with error messages
    if ($validator->fails()) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $validator->errors(),
        ], 422);
    }

    // Proceed to create the project if validation passes
    $project = Project::create([
        'project_name' => $request->input('project_name'),
        'client_name' => $request->input('client_id'),
        'start_date' => $request->input('start_date'),
        'deadline' => $request->input('deadline'),
        'status' => $request->input('status'),
    ]);

    return response()->json($project, 201);
    }

    // Update a project
    public function update(Request $request, $id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $project->update($request->all());

        return response()->json($project, 200);
    }

    // Delete a project
    public function destroy($id)
    {
        $project = Project::find($id);

        if (!$project) {
            return response()->json(['message' => 'Project not found'], 404);
        }

        $project->delete();

        return response()->json(['message' => 'Project deleted'], 200);
    }

     // Fetch all clients
     public function fetchclients()
     {
        $clients = Project::select('client_name')->distinct()->get();
        return response()->json($clients);
     }
}
