@extends('layouts.app')

@section('content')
    <div class="container mx-auto max-w-lg bg-white p-6 rounded shadow">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold">
                {{ isset($employee) ? 'Edit' : 'Create' }} Employee
            </h2>
            <a href="{{ route('employees.index') }}"
                class="inline-block bg-gray-300 text-gray-800 px-5 py-2 border border-gray-400 rounded hover:bg-gray-400 transition">
                ← Back
            </a>
        </div>
        <form action="{{ isset($employee) ? route('employees.update', $employee) : route('employees.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($employee)) @method('PUT') @endif

            <div class="flex flex-wrap gap-4 mb-4">
                <div class="flex-1 min-w-[200px]">
                    <label class="block mb-1 font-medium">Name</label>
                    <input type="text" name="name" value="{{ old('name', $employee->name ?? '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500"
                        placeholder="Employee Name">
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label class="block mb-1 font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email', $employee->email ?? '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500"
                        placeholder="Email">
                </div>

                <div class="flex-1 min-w-[200px]">
                    <label class="block mb-1 font-medium">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone', $employee->phone ?? '') }}"
                        class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500"
                        placeholder="Phone">
                </div>
            </div>
            <div class="flex flex-wrap gap-4 mb-4">
                <div class="flex-1 min-w-[200px]">
                    <label class="block mb-1 font-medium">Joining Date</label>
                    <input type="date" name="joining_date" value="{{ old('joining_date', $employee->joining_date ?? '') }}"
                        class="min-w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500">
                </div>
                <div class="flex-1 min-w-[200px]">
                    <label class="block mb-1 font-medium">Department</label>
                    <select name="department_id"
                        class="min-w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring focus:border-blue-500">
                        @foreach($departments as $dept)
                            <option value="{{ $dept->id }}" {{ (old('department_id', $employee->department_id ?? '') == $dept->id) ? 'selected' : '' }}>{{ $dept->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- File Input and Image Preview -->
                <div class="flex-1 min-w-[200px]">
                    <label class="block mb-1 font-medium">Profile Photo</label>
                    <input type="file" name="profile_photo" class="min-w-full" onchange="previewImage(event)">

                    <div class="mt-2">
                        <img id="profilePreview"
                            src="{{ old('profile_photo') ? '' : (isset($employee) && $employee->profile_photo ? asset('storage/' . $employee->profile_photo) : '') }}"
                            width="80" class="rounded border"
                            style="display: {{ (isset($employee) && $employee->profile_photo) ? 'block' : 'none' }}">
                    </div>
                </div>

            </div>
            <div class="mt-6">
                <button type="submit"
                    class="inline-block bg-gray-300 text-gray-800 px-5 py-2 border border-gray-400 rounded hover:bg-gray-400 transition">
                    Save
                </button>
            </div>
        </form>
    </div>
    <script>
        function previewImage(event) {
            const input = event.target;
            const preview = document.getElementById('profilePreview');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection