@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6 px-4">

    <div class="max-w-3xl mx-auto bg-white shadow-md rounded-lg overflow-hidden">
        <div class="bg-indigo-600 text-white p-6">
            <h2 class="text-3xl font-semibold">{{ $project->name }}</h2>
        </div>
        
        <div class="p-6">
            <div class="mb-4">
                <h3 class="text-xl font-semibold">Description</h3>
                <p class="text-gray-600 mt-2">{{ $project->description }}</p>
            </div>
            
            <div class="mb-4">
                <h3 class="text-xl font-semibold">Created At</h3>
                <p class="text-gray-600 mt-2">{{ $project->created_at->format('M d, Y') }}</p>
            </div>
            
            <div class="mt-6 flex justify-between items-center">
                <a href="{{ route('projects.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded-lg hover:bg-gray-600 transition duration-200">
                    Back to Projects
                </a>
                <a href="{{ route('projects.edit', $project->id) }}" class="bg-blue-500 text-white py-2 px-4 rounded-lg hover:bg-blue-600 transition duration-200">
                    Edit Project
                </a>
            </div>
        </div>
    </div>

</div>
@endsection
