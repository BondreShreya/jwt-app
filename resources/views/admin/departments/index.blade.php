@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Departments</h2>
            <a href="{{ route('departments.create') }}"
                class="inline-block bg-gray-300 text-gray-800 px-5 py-2 border border-gray-400 rounded hover:bg-gray-400 transition">
                + Add New
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg">
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 font-medium">Name</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departments as $dept)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-3">{{ $dept->name }}</td>
                            <td class="px-6 py-3 capitalize">{{ $dept->status }}</td>

                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('departments.edit', $dept) }}"
                                    class="inline-block bg-green-500 text-black px-3 py-1 rounded hover:bg-green-600 transition">
                                    Edit
                                </a>
                                <form action="{{ route('departments.destroy', $dept) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this department?');">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700 transition">
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