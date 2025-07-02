<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class projectController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $project = Project::create($validated);
        return response()->json($project, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $project = Project::findOrFail($id);
        $project->update($validated);
        return response()->json($project);
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);
        $project->delete();
        return response()->json(['message' => 'Project deleted successfully.']);
    }

    public function index()
    {
        $projects = Project::all();
        return response()->json($projects);
    }
}
