@extends('layouts.app')

@section('title', 'Upload Success')

@section('content')
<div class="container mx-auto max-w-3xl p-6">
    <div class="bg-green-100 border border-green-400 text-green-800 px-4 py-4 rounded relative mb-6">
        <strong>Success!</strong> Your Excel file <span class="font-semibold">{{ $fileName }}</span> was uploaded and emailed to <span class="underline">{{ $email }}</span>.
    </div>

    <h2 class="text-xl font-bold mb-4">Data Preview (First 5 rows):</h2>

    <div class="overflow-x-auto bg-white shadow-md rounded">
        <table class="min-w-full table-auto border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-100 text-left">
                    @foreach(array_keys($preview[0]) as $header)
                        <th class="px-4 py-2 border">{{ ucfirst($header) }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($preview as $row)
                    <tr class="hover:bg-gray-50">
                        @foreach($row as $value)
                            <td class="px-4 py-2 border">{{ $value }}</td>
                        @endforeach
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="{{ route('excel.form') }}" class="mt-6 inline-block bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700">
        Upload Another File
    </a>
</div>
@endsection
