<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\SickLeave;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SickLeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            for ($i=0; $i < 3 ; $i++) { 
                SickLeave::create([
                    'employee_id' => $employee->id,
                    'leave_date' => Carbon::now()->subDays(rand(0, 365))->toDateString(),
                    'reason' => $this->generateReason(),
                    'status' => $this->generateStatus(), 
                ]);
            }
        }
    }

    private function generateReason(): string
    {
        $reasons = [
            'Flu',
            'Cold',
            'Headache',
            'Stomach ache',
            'Fever',
        ];
        return $reasons[array_rand($reasons)];
    }

    private function generateStatus(): string
    {
        $status = [
            'pending',
            'approved',
            'declined',
        ];
        return $status[array_rand($status)];
    }
}
