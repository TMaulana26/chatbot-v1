<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SystemInstruction;

class InstructionModal extends Component
{
    public $modalAdd = false;
    public $modalEdit = false;
    public $modalDelete = false;

    public $name;
    public $instruction;

    protected $rules = [
        'name' => 'required|string|max:255',
        'instruction' => 'required|string|max:1000',
    ];

    protected $listeners = ['ModalAdd', 'ModalEdit', 'ModalDelete'];
    public function ModalAdd()
    {
        $this->resetValidation(); 
        $this->reset();
        $this->modalAdd = true;
    }

    public function ModalEdit()
    {
        $this->resetValidation(); 
        $this->reset();
        $this->modalEdit = true;
    }

    public function ModalDelete()
    {
        $this->resetValidation(); 
        $this->reset();
        $this->modalDelete = true;
    }

    public function create()
    {
        SystemInstruction::create([
            'name' => $this->name,
            'instruction' => $this->instruction,
        ]);

        $this->dispatch('instructionAdded');

        $this->modalAdd = false;
        $this->resetForm();
        session()->flash('message', 'Instruction added successfully.');
    }

    public function resetForm()
    {
        $this->name = '';
        $this->instruction = '';
    }
    public function render()
    {
        return view('livewire.instruction-modal');
    }
}
