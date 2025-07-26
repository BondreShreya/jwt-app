@extends('layouts.app')

@section('content')
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
        <h2 class="text-2xl font-bold mb-6 text-blue-600">
            {{ isset($department) ? 'Edit' : 'Create' }} Department
        </h2>

        <form action="{{ isset($department) ? route('departments.update', $department) : route('departments.store') }}"
            method="POST" class="space-y-6">
            @csrf
            @if(isset($department))
                @method('PUT')
            @endif

            <!-- Department Name -->
            <div>
                <label for="name" class="block text-gray-700 font-medium mb-1">Department Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $department->name ?? '') }}"
                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none"
                    placeholder="Enter department name" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-gray-700 font-medium mb-1">Status</label>
                <select name="status" id="status"
                    class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:outline-none" required>
                    <option value="active" {{ old('status', $department->status ?? '') == 'active' ? 'selected' : '' }}>Active
                    </option>
                    <option value="inactive" {{ old('status', $department->status ?? '') == 'inactive' ? 'selected' : '' }}>
                        Inactive</option>
                </select>
                @error('status')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex justify-between">
                <!-- Back Button -->
                <a href="{{ route('departments.index') }}"
                    class="inline-block bg-gray-300 text-gray-800 px-5 py-2 border border-gray-400 rounded hover:bg-gray-400 transition">
                    ← Back
                </a>

                <!-- Submit Button -->
                <button type="submit"
                    class="inline-block bg-gray-300 text-gray-800 px-5 py-2 border border-gray-400 rounded hover:bg-gray-400 transition">
                    Save
                </button>
            </div>
        </form>
    </div>
@endsection