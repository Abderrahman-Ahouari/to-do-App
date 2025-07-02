<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class Taskcontroller extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'priority' => 'required|integer',
            'project_id' => 'nullable|integer',
            'deadline' => 'nullable|date',
        ]);

        $task = Task::create($validated);

        return response()->json($task, 201);
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'sometimes|required|string',
            'priority' => 'sometimes|required|integer',
            'project_id' => 'nullable|integer',
            'deadline' => 'nullable|date',
        ]);

        $task = Task::findOrFail($id);
        $task->update($validated);

        return response()->json($task);
    }
    
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(['message' => 'Task deleted successfully.']);
    }

    public function indexByProject($project_id)
    {
        $tasks = Task::where('project_id', $project_id)->get();
        return response()->json($tasks);
    }
}
