@extends('layouts.app')

@section('content')
    <div class="py-10 px-6 max-w-7xl mx-auto mt-4">
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-gradient-to-r from-blue-100 to-blue-200 p-6 rounded-lg shadow">
                <h3 class="text-sm text-gray-600">Total Departments</h3>
                <p class="text-3xl font-bold text-blue-800">{{ $totalDepartments }}</p>
            </div>
            <div class="bg-gradient-to-r from-green-100 to-green-200 p-6 rounded-lg shadow">
                <h3 class="text-sm text-gray-600">Total Employees</h3>
                <p class="text-3xl font-bold text-green-800">{{ $totalEmployees }}</p>
            </div>
            <!-- Add more cards if needed -->
        </div>

        <!-- Recent Employees List -->
        <div class="bg-white shadow rounded-lg mt-4">
            <div class="px-6 py-4 border-b">
                <h4 class="text-lg font-semibold text-gray-700">Recent Employees</h4>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left font-medium text-gray-500">Photo</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500">Name</th>
                            <th class="px-6 py-3 text-left font-medium text-gray-500">Email</th>
                            <th class="px-6 py-3 text-right font-medium text-gray-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @forelse ($recentEmployees as $employee)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-3">
                                                <img src="{{ $employee->profile_photo && file_exists(public_path('storage/' . $employee->profile_photo))
                            ? asset('storage/' . $employee->profile_photo)
                            : asset('images/default-user.png') }}" alt="{{ $employee->name }}"
                                                    class="w-10 h-10  object-cover">
                                            </td>
                                            <td class="px-6 py-3 font-medium text-gray-800">{{ $employee->name }}</td>
                                            <td class="px-6 py-3 text-gray-600">{{ $employee->email }}</td>
                                            <td class="px-6 py-3 text-right space-x-2">
                                                <a href="{{ route('employees.index') }}"
                                                    class="inline-block text-blue-600 hover:underline">View</a>
                                                <a href="{{ route('employees.edit', $employee->id) }}"
                                                    class="inline-block text-green-600 hover:underline">Edit</a>
                                                <form action="{{ route('employees.destroy', $employee->id) }}" method="POST"
                                                    class="inline-block"
                                                    onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:underline">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No recent employees found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection