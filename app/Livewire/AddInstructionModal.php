<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SystemInstruction;

class AddInstructionModal extends Component
{
    public $modal = false;
    public $name;
    public $instruction;

    protected $rules = [
        'name' => 'required|string|max:255',
        'instruction' => 'required|string|max:1000',
    ];

    protected $listeners = ['addModal'];
    public function addModal()
    {
        $this->resetValidation(); 
        $this->reset();
        $this->modal = true;
    }

    public function create()
    {
        SystemInstruction::create([
            'name' => $this->name,
            'instruction' => $this->instruction,
        ]);

        $this->dispatch('instructionAdded');

        $this->modal = false;
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
        return view('livewire.add-instruction-modal');
    }
}
