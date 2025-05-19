@extends('layouts.app')

@section('title', 'Upload Excel')

@section('content')
<div class="container mx-auto mt-10 max-w-xl">
    <h1 class="text-2xl font-semibold mb-6">Upload Excel File</h1>

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('excel.upload') }}" method="POST" enctype="multipart/form-data" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <div class="mb-4">
            <label for="file" class="block text-gray-700 text-sm font-bold mb-2">Choose Excel File:</label>
            <input type="file" name="file" id="file"
                   class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('file') border-red-500 @enderror"
                   required>
            @error('file')
                <p class="text-red-500 text-xs italic mt-2">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex items-center justify-between">
            <button type="submit"
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Upload
            </button>
        </div>
    </form>
</div>
@endsection
