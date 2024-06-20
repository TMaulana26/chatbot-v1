<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Employee;
use App\Models\Attendance;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = Employee::all();

        foreach ($employees as $employee) {
            // Generating random attendance data for the past 30 days
            for ($i = 0; $i < 30; $i++) {
                $date = Carbon::now()->subDays($i);
                $checkInTime = Carbon::createFromTime(mt_rand(8, 10), mt_rand(0, 59));
                $checkOutTime = Carbon::createFromTime(mt_rand(17, 19), mt_rand(0, 59));

                Attendance::create([
                    'employee_id' => $employee->id,
                    'check_in_time' => $date->copy()->setTimeFrom($checkInTime),
                    'check_out_time' => $date->copy()->setTimeFrom($checkOutTime),
                ]);
            }
        }
    }
}
