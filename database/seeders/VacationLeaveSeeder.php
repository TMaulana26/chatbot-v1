<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\VacationLeave;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VacationLeaveSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            for ($i=0; $i < 3 ; $i++) { 
                VacationLeave::create([
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
            'Family Vacation',
            'Personal Time Off',
            'Travel',
            'Rest and Relaxation',
            'Medical Treatment',
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
