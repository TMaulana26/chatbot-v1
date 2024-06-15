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
    public $instructionId;

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

    public function ModalEdit($id)
    {
        $this->resetValidation(); 
        $this->reset();

        $this->instructionId = $id;

        $instruction = SystemInstruction::find($id);
        if ($instruction) {
            $this->name = $instruction->name;
            $this->instruction = $instruction->instruction;
        }

        $this->modalEdit = true;
    }

    public function ModalDelete($id)
    {
        $this->resetValidation(); 
        $this->reset();

        $this->instructionId = $id;

        $this->modalDelete = true;
    }

    public function create()
    {
        $this->validate();

        SystemInstruction::create([
            'name' => $this->name,
            'instruction' => $this->instruction,
        ]);

        $this->dispatch('reloadPage');

        $this->modalAdd = false;
        $this->resetForm();
        session()->flash('message', 'Instruction added successfully.');
    }

    public function update()
    {
        $this->validate();
        
        $instruction = SystemInstruction::find($this->instructionId);
        $instruction->update([
            'name' => $this->name,
            'instruction' => $this->instruction,
        ]);

        $this->dispatch('reloadPage');

        $this->modalEdit = false;
        $this->resetForm();
        session()->flash('message', 'Instruction updated successfully.');
    }

    public function destroy()
    {
        $instruction = SystemInstruction::find($this->instructionId);
        $instruction->delete();

        $this->dispatch('reloadPage');

        $this->modalDelete = false;
        $this->resetForm();
        session()->flash('message', 'Instruction deleted successfully.');
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
