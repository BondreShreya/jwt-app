@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold text-gray-800">Employees</h2>
            <a href="{{ route('employees.create') }}"
                class="inline-block bg-gray-300 text-gray-800 px-5 py-2 border border-gray-400 rounded hover:bg-gray-400 transition">
                + Add New
            </a>
        </div>

        <div class="overflow-x-auto bg-white shadow-md rounded-lg p-2">
            <form method="GET" action="{{ route('employees.index') }}" class="mb-4">
                <select name="department_id" onchange="this.form.submit()" class="border border-gray-300 rounded px-3 py-2">
                    <option value="">-- All Departments --</option>
                    @foreach($departments as $dept)
                        <option value="{{ $dept->id }}" {{ request('department_id') == $dept->id ? 'selected' : '' }}>
                            {{ $dept->name }}
                        </option>
                    @endforeach
                </select>
            </form>
            <table class="min-w-full text-sm text-left text-gray-700">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 font-medium">Name</th>
                        <th class="px-6 py-3 font-medium">Email</th>
                        <th class="px-6 py-3 font-medium">Department</th>
                        <th class="px-6 py-3 font-medium">Photo</th>
                        <th class="px-6 py-3 font-medium">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employees as $emp)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $emp->name }}</td>
                            <td class="px-6 py-4">{{ $emp->email }}</td>
                            <td class="px-6 py-4">{{ $emp->department->name }}</td>
                            <td class="px-6 py-4">
                                @if($emp->profile_photo)
                                    <img src="{{ asset('storage/' . $emp->profile_photo) }}" alt="photo"
                                        class="w-8 h-8 object-cover">
                                @else
                                    <span class="text-gray-400 italic">No Photo</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 space-x-2">
                                <a href="{{ route('employees.edit', $emp) }}"
                                    class="inline-block bg-green-500 text-black px-3 py-1 rounded hover:bg-green-600 transition">
                                    Edit
                                </a>
                                <form action="{{ route('employees.destroy', $emp) }}" method="POST" class="inline-block"
                                    onsubmit="return confirm('Are you sure you want to delete this employee?');">
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
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('employees.index') }}"
                    class="inline-block bg-gray-300 text-gray-800 px-5 py-2 border border-gray-400 rounded hover:bg-gray-400 transition">
                    ← Refresh
                </a>
                <a href="{{ route('employees.export') }}"
                    class="inline-block bg-gray-300 text-gray-800 px-5 py-2 border border-gray-400 rounded hover:bg-gray-400 transition">
                    ⬇ Export to Excel
                </a>
            </div>

        </div>
    </div>
@endsection