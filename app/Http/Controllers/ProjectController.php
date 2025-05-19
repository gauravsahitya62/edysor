<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        return view('projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Add the user_id manually
        $user_id = Auth::user()->id;

        // Create the project with the user_id
        Project::create([
            'name' => $request->name,
            'description' => $request->description,
            'user_id' => $user_id, // Add the user_id here
        ]);

        // Redirect back with success message
        return redirect()->route('projects.index')->with('success', 'Project created!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        // Return the project details view and pass the project to the view
        return view('projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
     public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $project->update($request->only('name', 'description'));

        return redirect()->route('projects.index')->with('success', 'Project updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();

        return redirect()->route('projects.index')->with('success', 'Project deleted!');
    }
}
