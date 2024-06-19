<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $departments = Department::all();

        foreach ($users as $user) {
            $department = $departments->random();

            Employee::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'job_title' => $this->generateJobTitle(),
                'phone' => $this->generatePhone(),
                'hire_date' => $this->generateHireDate(),
                'salary' => $this->generateSalary(),
                'department_id' => $department->id,
            ]);
        }
    }

    private function generateJobTitle(): string
    {
        $jobTitles = [
            'Manager',
            'Staff',
            'Supervisor',
            'Worker',
        ];

        return $jobTitles[array_rand($jobTitles)];
    }

    private function generatePhone(): string
    {
        $digits = 8;
        $min = pow(10, $digits - 1);
        $max = pow(10, $digits) - 1;
        $phone = mt_rand($min, $max);
        return $phone;
    }

    private function generateHireDate(): string
    {
        $date = date('Y-m-d', strtotime('-1 year'));
        return $date;
    }

    private function generateSalary(): string
    {
        $salary = rand(10000000, 100000000);
        return "Rp. " . number_format($salary, 2, ',', '.');
    }

}
