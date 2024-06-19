<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Department;

class DepartmentModal extends Component
{
    public $modalAdd = false;
    public $modalEdit = false;
    public $modalDelete = false;

    public $name;
    public $description;
    public $departmentId;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
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

        $this->departmentId = $id;

        $department = Department::find($id);
        if ($department) {
            $this->name = $department->name;
            $this->description = $department->description;
        }

        $this->modalEdit = true;
    }

    public function ModalDelete($id)
    {
        $this->resetValidation();
        $this->reset();

        $this->departmentId = $id;

        $this->modalDelete = true;
    }

    public function addDepartment()
    {
        $this->validate();

        Department::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->dispatch('reloadPage');

        $this->modalAdd = false;
        $this->resetForm();
    }

    public function updateDepartment()
    {
        $this->validate();

        $department = Department::find($this->departmentId);
        $department->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->dispatch('reloadPage');

        $this->modalEdit = false;
        $this->resetForm();
    }

    public function destroyDepartment()
    {
        $department = Department::find($this->departmentId);
        $department->delete();

        $this->dispatch('reloadPage');

        $this->modalDelete = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
    }

    public function render()
    {
        return view('livewire.department-modal');
    }
}
