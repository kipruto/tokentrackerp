<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Client;
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
        // Define validation rules for the project and conditional rules for new client details
        $validator = Validator::make($request->all(), [
            'project_name' => 'required|string|max:255',
            'client_id' => 'required|string|max:255',
            'new_client_name' => 'required_if:client_id,new|string|max:255',
            'new_client_company' => 'nullable|string|max:255',
            'new_client_address' => 'nullable|string|max:500',
            'new_client_phone' => 'nullable|string|max:20',
            'new_client_country' => 'nullable|string|max:100',
            'project_type' => 'required|in:internal,external',
            'start_date' => 'required|date',
            'deadline' => 'required|date|after_or_equal:start_date',
            'status' => 'required|in:incoming,in_progress,on_hold,completed,cancelled',
        ]);

        // If validation fails, return a 422 response with error messages
        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors(),
            ], 422);
        }

        // Check if a new client should be created
        $clientId = $request->input('client_id');
        if ($clientId === 'new') {
            // Create a new client with the provided details
            $client = Client::create([
                'name' => $request->input('new_client_name'),
                'company' => $request->input('new_client_company'),
                'address' => $request->input('new_client_address'),
                'phone' => $request->input('new_client_phone'),
                'country' => $request->input('new_client_country'),
            ]);
            $clientId = $client->id; // Use the new client's ID in the project creation
        }

        // Proceed to create the project using the determined client ID
        $project = Project::create([
            'project_name' => $request->input('project_name'),
            'project_type' => $request->input('project_type', 'Internal'), //default internal if not selected
            'client_id' => $clientId,
            'start_date' => $request->input('start_date'),
            'deadline' => $request->input('deadline'),
            'status' => $request->input('status'),
        ]);

        // Return a success response with the created project data
        return response()->json([
            'message' => 'Project created successfully',
            'project' => $project,
        ], 201);
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
