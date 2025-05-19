@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Edit Project</h1>

    <div class="bg-white shadow-md rounded-lg p-6">
        <form action="{{ route('projects.update', $project->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- name Input -->
            <div class="mb-4">
                <label for="name" class="block text-lg font-semibold text-gray-700">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', $project->name) }}"
                    class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                @error('name')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description Input -->
            <div class="mb-4">
                <label for="description" class="block text-lg font-semibold text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full p-3 mt-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description', $project->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <button type="submit"
                    class="w-full bg-blue-500 text-white font-semibold py-3 rounded-md hover:bg-blue-600 transition duration-300 ease-in-out">
                    Update Project
                </button>
            </div>

            <!-- Back Button -->
            <div class="mt-4">
                <a href="{{ route('projects.index') }}" class="text-blue-500 hover:text-blue-600">Back to Projects</a>
            </div>
        </form>
    </div>
</div>
@endsection
