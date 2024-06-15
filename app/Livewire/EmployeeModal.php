<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Employee;
use App\Models\Department;

class EmployeeModal extends Component
{
    public $modalAdd = false;
    public $modalEdit = false;
    public $modalDelete = false;

    public $departments;
    public $users;

    public $employeeId;
    public $userId;
    public $name;
    public $email;
    public $jobTitle;
    public $department_id;
    public $phone;
    public $hireDate;
    public $salary;

    protected $rules = [
        'userId' => 'required',
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'jobTitle' => 'required|string|max:255',
        'department_id' => 'required',
        'phone' => 'required|string|max:255',
        'hireDate' => 'required|date',
        'salary' => 'required|numeric',
    ];

    protected $listeners = ['ModalAdd', 'ModalEdit', 'ModalDelete', 'fetchEmployeeData'];

    public function ModalAdd()
    {
        $this->resetValidation();
        $this->reset();

        $id = $this->employeeId ?? null;

        $employee = Employee::find($id);
        if ($employee) {
            $this->userId = $employee->user_id;
            $this->name = $employee->name;
            $this->email = $employee->email;
            $this->jobTitle = $employee->jobTitle;
            $this->department_id = $employee->department_id;
            $this->phone = $employee->phone;
            $this->hireDate = $employee->hireDate;
            $this->salary = $employee->salary;
        }

        $this->modalAdd = true;
    }

    public function ModalEdit($id)
    {
        $this->resetValidation();
        $this->reset();

        $this->employeeId = $id;

        $employee = Employee::find($id);
        if ($employee) {
            $this->userId = $employee->user_id;
            $this->name = $employee->name;
            $this->email = $employee->email;
            $this->jobTitle = $employee->jobTitle;
            $this->department_id = $employee->department_id;
            $this->phone = $employee->phone;
            $this->hireDate = $employee->hireDate;
            $this->salary = $employee->salary;
        }

        $this->modalEdit = true;
    }

    public function ModalDelete($id)
    {
        $this->resetValidation();
        $this->reset();

        $this->employeeId = $id;

        $this->modalDelete = true;
    }

    public function createOrUpdate()
    {
        $this->validate();

        Employee::updateOrCreate(
            ['id' => $this->employeeId],
            [
                'user_id' => $this->userId,
                'name' => $this->name,
                'email' => $this->email,
                'jobTitle' => $this->jobTitle,
                'department_id' => $this->department_id,
                'phone' => $this->phone,
                'hireDate' => $this->hireDate,
                'salary' => $this->salary,
            ]
        );

        $this->dispatch('reloadPage');

        $this->modalAdd = false;
        $this->resetForm();
    }

    public function destroy()
    {
        $employee = Employee::find($this->employeeId);
        if ($employee) {
            $employee->delete();
        }

        $this->dispatch('reloadPage');

        $this->modalDelete = false;
        $this->resetForm();
    }

    public function fetchEmployeeData($userId)
    {
        $employee = Employee::where('user_id', $userId)->first();

        if ($employee) {
            $this->userId = $employee->user_id;
            $this->name = $employee->name;
            $this->email = $employee->email;
            $this->jobTitle = $employee->jobTitle;
            $this->department_id = $employee->department_id;
            $this->phone = $employee->phone;
            $this->hireDate = $employee->hireDate;
            $this->salary = $employee->salary;
            $this->employeeId = $employee->id;
        } else {
            $this->reset(['name', 'email', 'jobTitle', 'department_id', 'phone', 'hireDate', 'salary', 'employeeId']);
        }
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset();
    }

    public function render()
    {
        $this->departments = Department::all();
        $this->users = User::all();
        return view('livewire.employee-modal', ['departments' => $this->departments, 'users' => $this->users]);
    }
}
