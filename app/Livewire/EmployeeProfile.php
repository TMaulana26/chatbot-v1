<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class EmployeeProfile extends Component
{
    public $departments;
    public $state = [
        'name' => '',
        'job_title' => '',
        'department_id' => '',
        'phone' => '',
        'hire_date' => '',
        'salary' => '',
    ];

    public function mount()
    {
        $employee = Auth::user()->employee;

        if ($employee) {
            $this->state['name'] = $employee->name;
            $this->state['job_title'] = $employee->job_title;
            $this->state['department_id'] = $employee->department_id;
            $this->state['phone'] = $employee->phone;
            $this->state['hire_date'] = $employee->hire_date;
            $this->state['salary'] = $employee->salary;
        } else {
            $this->state['name'] = Auth::user()->name;
        }

        $this->departments = Department::all();
    }

    public function save()
    {
        $user = Auth::user();
        $employee = $user->employee;

        if ($employee) {
            $employee->update($this->state);
        } else {
            Employee::create(array_merge($this->state, ['email' => $user->email, 'user_id' => $user->id]));
        }

        $user->syncRoles(['employee']);
        $this->dispatch('saved');

    }

    public function render()
    {
        return view('livewire.employee-profile', [
            'departments' => $this->departments
        ]);
    }
}
