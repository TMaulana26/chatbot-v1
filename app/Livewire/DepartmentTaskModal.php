<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Department;
use App\Models\DepartmentTask;

class DepartmentTaskModal extends Component
{
    public $modalAdd = false;
    public $modalEdit = false;
    public $modalDelete = false;

    public $title;
    public $description;
    public $departmentId;
    public $status;
    public $dueDate;
    public $taskId;

    protected $rules = [
        'title' => 'required',
        'description' => 'required',
        'departmentId' => 'required',
        'status' => 'required',
        'dueDate' => 'required',
    ];

    protected $listeners = ['ModalAdd', 'ModalEdit', 'ModalDelete',];

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

        $this->taskId = $id;

        $task = DepartmentTask::find($id);
        if ($task) {
            $this->title = $task->title;
            $this->description = $task->description;
            $this->departmentId = $task->department_id;
            $this->status = $task->status;
            $this->dueDate = $task->due_date;
        }

        $this->modalEdit = true;
    }

    public function ModalDelete($id)
    {
        $this->resetValidation();
        $this->reset();

        $this->taskId = $id;
        $this->modalDelete = true;
    }

    public function addDepartmentTask()
    {
        $this->validate();
        DepartmentTask::create([
            'title' => $this->title,
            'description' => $this->description,
            'department_id' => $this->departmentId,
            'status' => $this->status,
            'due_date' => $this->dueDate
        ]);
        $this->dispatch('reloadPage');
        $this->modalAdd = false;
        $this->resetForm();

    }

    public function updateDepartmentTask()
    {
        $this->validate();
        $task = DepartmentTask::find($this->taskId);
        $task->update([
            'title' => $this->title,
            'description' => $this->description,
            'department_id' => $this->departmentId,
            'status' => $this->status,
            'due_date' => $this->dueDate
        ]);
        $this->dispatch('reloadPage');
        $this->modalEdit = false;
        $this->resetForm();
    }

    public function destroyDepartmentTask()
    {
        $task = DepartmentTask::find($this->taskId);
        $task->delete();
        $this->dispatch('reloadPage');
        $this->modalDelete = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->departmentId = '';
        $this->status = '';
        $this->dueDate = '';
    }

    public function render()
    {
        $this->departments = Department::all();
        return view('livewire.department-task-modal', [
            'departments' => $this->departments
        ]);
    }
}
