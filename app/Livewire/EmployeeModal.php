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
    public $jobTitle;
    public $department_id;
    public $phone;
    public $hireDate;
    public $salary;

    protected $rules = [
        'userId' => 'required',
        'name' => 'required|string|max:255',
        'jobTitle' => 'required|string|max:255',
        'department_id' => 'required',
        'phone' => 'required|string|max:255',
        'hireDate' => 'required|date',
        'salary' => 'sometimes|string|max:255',
    ];

    protected $listeners = ['ModalAdd', 'ModalEdit', 'ModalDelete'];

    public function ModalAdd()
    {
        $this->resetValidation();
        $this->reset();

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
            $this->jobTitle = $employee->job_title;
            $this->department_id = $employee->department_id;
            $this->phone = $employee->phone;
            $this->hireDate = $employee->hire_date;
            $this->salary = str_replace(['Rp.', ',', '.'], '', $employee->salary);
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

    public function createEmployee()
    {
        $this->validate();

        Employee::create([
            'user_id' => $this->userId,
            'name' => $this->name,
            'email' => $this->users->where('id', $this->userId)->first()->email,
            'job_title' => $this->jobTitle,
            'department_id' => $this->department_id,
            'phone' => $this->phone,
            'hire_date' => $this->hireDate,
            'salary' => "Rp. " . number_format($this->salary, 2, '.', ','),
        ]);

        $this->dispatch('reloadPage');

        $this->modalAdd = false;
        $this->resetForm();
    }

    public function update()
    {
        $this->validate();

        $employee = Employee::find($this->employeeId);

        $employee->update([
            'name' => $this->name,
            'job_title' => $this->jobTitle,
            'department_id' => $this->department_id,
            'phone' => $this->phone,
            'hire_date' => $this->hireDate,
            'salary' => "Rp. " . number_format((float) $this->salary, 2, '.', ','),
        ]);

        $this->dispatch('reloadPage');

        $this->modalEdit = false;
        $this->resetForm();
    }

    public function destroy()
    {
        $employee = Employee::find($this->employeeId);
        $employee->delete();

        $this->dispatch('reloadPage');

        $this->modalDelete = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset();
    }

    public function render()
    {
        $employeeUserIds = Employee::pluck('user_id')->toArray();
        $this->departments = Department::all();
        $this->users = User::whereNotIn('id', $employeeUserIds)->get();
        return view('livewire.employee-modal', ['departments' => $this->departments, 'users' => $this->users]);
    }
}
