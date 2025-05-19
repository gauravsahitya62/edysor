<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    // 🔐 Require auth for all actions
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    // 📥 GET /api/projects
    public function index()
    {
        $projects = Auth::user()->projects;
        return response()->json($projects);
    }

    // 📤 POST /api/projects
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project = Auth::user()->projects()->create($request->only('name', 'description'));

        return response()->json($project, 201);
    }

    // 📄 GET /api/projects/{id}
    public function show($id)
    {
        $project = Auth::user()->projects()->findOrFail($id);
        return response()->json($project);
    }

    // ✏️ PUT /api/projects/{id}
    public function update(Request $request, $id)
    {
        $project = Auth::user()->projects()->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($request->only('name', 'description'));

        return response()->json($project);
    }

    // ❌ DELETE /api/projects/{id}
    public function destroy($id)
    {
        $project = Auth::user()->projects()->findOrFail($id);
        $project->delete();

        return response()->json(['message' => 'Project deleted']);
    }
}

