<?php

namespace App\Http\Controllers;

use App\Models\DepartmentTask;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Http\Request;
use GuzzleHttp\RequestOptions;
use App\Models\SystemInstruction;
use Illuminate\Support\Facades\Auth;

class SendChatController extends Controller
{
    public function fetchData()
    {
        $systemInstructions = SystemInstruction::all();
        $employeeData = Employee::all();
        $departmentData = Department::all();
        $departmentTasksData = DepartmentTask::all();
        $attendanceData = Auth::user()->attendances;

        return compact('systemInstructions', 'employeeData', 'departmentData', 'departmentTasksData', 'attendanceData');
    }

    public function prosessInstruction($systemInstructions, $employeeData, $departmentData, $departmentTasksData, $attendanceData)
    {
        $instructionText = '';
        foreach ($systemInstructions as $instruction) {
            $instructionText .= $instruction->instruction . "\n";
        }

        $employeeDataText = '';
        foreach ($employeeData as $data) {
            $employeeDataText .= "(Nama : " . $data->name . ", ";
            $employeeDataText .= "Departermen : " . $data->department_id . ", ";
            $employeeDataText .= "Jabatan : " . $data->job_title . ", ";
            $employeeDataText .= "Email : " . $data->email . ", ";
            $employeeDataText .= "No. HP : " . $data->phone . ", ";
            $employeeDataText .= "Mulai Kerja : " . $data->hire_date . ", ";
            $employeeDataText .= "Gaji : " . $data->salary . ") \n ";
        }

        $departmentDataText = '';
        foreach ($departmentData as $data) {
            $departmentDataText .= "(Departemen : " . $data->id . ", ";
            $departmentDataText .= "Nama : " . $data->name . ", ";
            $departmentDataText .= "Deskripsi : " . $data->description . ", ";
            $departmentDataText .= "Tugas : " . $data->tasks->pluck('title')->last() . " ) \n";
        }

        $departmentTasksDataText = '';
        foreach ($departmentTasksData as $data) {
            $departmentTasksDataText .= "(Tugas : " . $data->id . ", ";
            $departmentTasksDataText .= "Departemen : " . $data->department_id . ", ";
            $departmentTasksDataText .= "Judul : " . $data->title . ", ";
            $departmentTasksDataText .= "Deskripsi : " . $data->description . ",";
            $departmentTasksDataText .= "Status : " . $data->status . ", ";
            $departmentTasksDataText .= "Deadline : " . $data->due_date . " ) \n";
        }

        $attendanceDataText = '';
        foreach ($attendanceData as $data) {
            $attendanceDataText .= "(Kerja : " . $data->employee_id . ", ";
            $attendanceDataText .= "Nama : " . $data->user->name . ", ";
            $attendanceDataText .= "Masuk : " . $data->check_in_time . ", ";
            $attendanceDataText .= "Keluar : " . $data->check_out_time . " ) \n";
        }

        $currentTime = Carbon::now('Asia/Jakarta')->format('d/m/y H:i');
        $instructionText = str_replace('[NOW]', $currentTime, $instructionText);
        $instructionText = str_replace('[EMPLOYEE_DATA]', $employeeDataText, $instructionText);
        $instructionText = str_replace('[USERNAME]', Auth::user()->employee->name, $instructionText);
        $instructionText = str_replace('[DEPARTMENT_DATA]', $departmentDataText, $instructionText);
        $instructionText = str_replace('[DEPARTMENT_TASK_DATA]', $departmentTasksDataText, $instructionText);
        if (empty($attendanceDataText)) {
            $attendanceDataText = "(Belum Melakukan Absensi)";
            $instructionText = str_replace('[ATTENDANCE_DATA]', $attendanceDataText, $instructionText);
        } else {
            $instructionText = str_replace('[ATTENDANCE_DATA]', $attendanceDataText, $instructionText);
        }

        return $instructionText;
    }

    public function callApi($requestPayload)
    {
        $client = new Client([
            'base_uri' => 'https://generativelanguage.googleapis.com/v1beta/models/gemini-1.5-flash-latest:generateContent',
            'headers' => [
                'Content-Type' => 'application/json',
            ],
        ]);


        $response = $client->post('?key=' . env('GEMINI_API_KEY'), [
            RequestOptions::JSON => $requestPayload,
        ]);

        return json_decode($response->getBody(), true);
    }
}
