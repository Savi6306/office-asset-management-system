<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        $employees = [
            [
                'employee_id' => 'EMP001',
                'name' => 'John Doe',
                'email' => 'john.doe@company.com',
                'phone' => '+1 234 567 8900',
                'department' => 'IT',
                'position' => 'Software Engineer',
                'hire_date' => '2023-01-15',
                'status' => 'active',
                'address' => '123 Main St, New York, NY',
            ],
            [
                'employee_id' => 'EMP002',
                'name' => 'Jane Smith',
                'email' => 'jane.smith@company.com',
                'phone' => '+1 234 567 8901',
                'department' => 'HR',
                'position' => 'HR Manager',
                'hire_date' => '2022-03-20',
                'status' => 'active',
                'address' => '456 Oak Ave, Los Angeles, CA',
            ],
            [
                'employee_id' => 'EMP003',
                'name' => 'Robert Johnson',
                'email' => 'robert.j@company.com',
                'phone' => '+1 234 567 8902',
                'department' => 'Finance',
                'position' => 'Financial Analyst',
                'hire_date' => '2023-06-10',
                'status' => 'active',
                'address' => '789 Pine Rd, Chicago, IL',
            ],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}