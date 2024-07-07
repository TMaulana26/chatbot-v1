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
        $employees = [
            [
                'name' => 'Hafidz Saputra',
                'email' => 'hafidz.saputra@krl.co.id',
                'phone' => '085692797845',
                'hire_date' => '2018-01-01',
                'department' => 'Media Relations',
            ],
            [
                'name' => 'Fathan Mubien',
                'email' => 'fathan.mubien@krl.co.id',
                'phone' => '081377371211',
                'hire_date' => '2018-01-15',
                'department' => 'Media Relations',
            ],
            [
                'name' => 'Abung Fayshal',
                'email' => 'abung.fayshal@krl.co.id',
                'phone' => '082298059673',
                'hire_date' => '2016-11-07',
                'department' => 'Community and Event',
            ],
            [
                'name' => 'Muhammad Faishal Akbar',
                'email' => 'muhammad.akbar@krl.co.id',
                'phone' => '081381635950',
                'hire_date' => '2018-10-01',
                'department' => 'Community and Event',
            ],
            [
                'name' => 'Fajar Ramadhan Firmansyah',
                'email' => 'fajar.firmansyah@krl.co.id',
                'phone' => '081222500037',
                'hire_date' => '2018-10-01',
                'department' => 'Community and Event',
            ],
            [
                'name' => 'Admin Mtim',
                'email' => 'mtim0343@gmail.com',
                'phone' => '081234567890',
                'hire_date' => '2017-02-01',
                'department' => 'Teknologi Informasi',
            ],
            [
                'name' => 'HR Mtim',
                'email' => 'tm052602@gmail.com',
                'phone' => '081234567891',
                'hire_date' => '2019-05-01',
                'department' => 'Teknologi Informasi',
            ],
            [
                'name' => 'Admin Deon',
                'email' => 'admin@deon.com',
                'phone' => '081234567892',
                'hire_date' => '2019-05-01',
                'department' => 'Teknologi Informasi',
            ],
            [
                'name' => 'HR Deon',
                'email' => 'hr@deon.com',
                'phone' => '081234567893',
                'hire_date' => '2019-05-01',
                'department' => 'SDM',
            ],
        ];

        foreach ($employees as $employeeData) {
            $user = User::where('email', $employeeData['email'])->first();
            $department = Department::where('name', $employeeData['department'])->first();
            $salary = rand(9000000, 20000000);
            $formattedSalary = "Rp. " . number_format($salary, 2, ',', '.');

            Employee::create([
                'name' => $employeeData['name'],
                'email' => $employeeData['email'],
                'job_title' => $this->generateJobTitle(),
                'phone' => $employeeData['phone'],
                'hire_date' => $employeeData['hire_date'],
                'department_id' => $department->id,
                'user_id' => $user->id,
                'salary' => $formattedSalary,
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
}
