<?php

namespace App\Http\Controllers;

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

        return compact('systemInstructions', 'employeeData', 'departmentData');
    }

    public function prosessInstruction($systemInstructions, $employeeData, $departmentData)
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

        $currentTime = Carbon::now('Asia/Jakarta')->format('d/m/y H:i');
        $instructionText = str_replace('[NOW]', $currentTime, $instructionText);
        $instructionText = str_replace('[EMPLOYEE_DATA]', $employeeDataText, $instructionText);
        $instructionText = str_replace('[USERNAME]', Auth::user()->employee->name, $instructionText);
        $instructionText = str_replace('[DEPARTMENT_DATA]', $departmentDataText, $instructionText);

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
