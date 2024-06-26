<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\InfoUmumHR;

class InfoUmumHRModal extends Component
{
    public $modalAdd = false;
    public $modalEdit = false;
    public $modalDelete = false;

    public $title;
    public $description;
    public $infoId;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:1000',
    ];

    protected $listeners = ['ModalAdd', 'ModalEdit', 'ModalDelete'];

    public function ModalAdd()
    {
        $this->resetForm();
        $this->modalAdd = true;
    }

    public function ModalEdit($id)
    {
        $this->resetForm();

        $this->infoId = $id;

        $info = InfoUmumHR::find($id);
        if ($info) {
            $this->title = $info->title;
            $this->description = $info->description;
        }
        $this->modalEdit = true;
    }

    public function ModalDelete($id)
    {
        $this->resetForm();

        $this->infoId = $id;
        $this->modalDelete = true;
    }

    public function create()
    {
        $this->validate();

        InfoUmumHR::Create([
            'title' => $this->title,
            'description' => $this->description
        ]);

        $this->dispatch('reloadPage');
        $this->modalAdd = false;

        $this->resetForm();
    }

    public function update()
    {
        $this->validate();

        $info = InfoUmumHR::find($this->infoId);
        $info->update([
            'title' => $this->title,
            'description' => $this->description
        ]);

        $this->dispatch('reloadPage');

        $this->modalEdit = false;
        $this->resetForm();
    }

    public function destroy()
    {
        $info = InfoUmumHR::find($this->infoId);
        $info->delete();
        
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
        return view('livewire.info-umum-h-r-modal');
    }
}
