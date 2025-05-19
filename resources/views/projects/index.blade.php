@extends('layouts.app')

@section('title', 'Projects')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-4">All Projects</h1>

        <!-- Create New Project Button -->
        <a href="{{ route('projects.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded-md hover:bg-blue-700 mb-4 inline-block">
            Create New Project
        </a>

        <div class="project-list bg-white p-6 rounded-lg shadow-md">
            <table class="min-w-full table-auto">
                <thead>
                    <tr class="border-b">
                        <th class="px-4 py-2 text-left">Project Name</th>
                        <th class="px-4 py-2 text-left">Description</th>
                        <th class="px-4 py-2 text-left">Created At</th>
                        <th class="px-4 py-2 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($projects as $project)
                        <tr class="border-b">
                            <td class="px-4 py-2">{{ $project->name }}</td>
                            <td class="px-4 py-2">{{ $project->description }}</td>
                            <td class="px-4 py-2">{{ $project->created_at->format('Y-m-d') }}</td>
                            <td class="px-4 py-2">
                                <a href="{{ route('projects.show', $project->id) }}" class="text-blue-500 hover:text-blue-700">View</a>
                            </td>
                            <td class="px-4 py-2">
                                <!-- Delete Project Form -->
                                <form action="{{ route('projects.destroy', $project->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
