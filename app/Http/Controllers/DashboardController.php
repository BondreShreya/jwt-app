<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Employee;


class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
            'totalDepartments' => Department::count(),
            'totalEmployees' => Employee::count(),
            'recentEmployees' => Employee::latest()->take(5)->get(),
        ]);
    }
}
