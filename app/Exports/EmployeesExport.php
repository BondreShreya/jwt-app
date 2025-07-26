<?php

namespace App\Exports;

use App\Models\Employee;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Employee::with('department')
            ->get()
            ->map(function ($employee) {
                return [
                    'Name' => $employee->name,
                    'Email' => $employee->email,
                    'Phone' => $employee->phone,
                    'Department' => $employee->department->name ?? '',
                    'Joining Date' => $employee->joining_date,
                ];
            });
    }

    public function headings(): array
    {
        return ['Name', 'Email', 'Phone', 'Department', 'Joining Date'];
    }
}
