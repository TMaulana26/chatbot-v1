<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SickLeave;

class SickModal extends Component
{
    public $modalEditSick = false;
    public $modalDeleteSick = false;
    public $sickId;
    public $employeeId;
    public $leaveDate;
    public $reason;
    public $status;

    protected $rules = [
        'employeeId' => 'required',
        'leaveDate' => 'required|date',
        'reason' => 'required',
        'status' => 'required',
    ];

    protected $listeners = ['ModalEditSick' => 'ModalEdit', 'ModalDeleteSick' => 'ModalDelete'];

    public function ModalEdit($id)
    {
        $this->sickId = $id;

        $sick = SickLeave::find($id);
        if ($sick) {
            $this->employeeId = $sick->employee_id;
            $this->leaveDate = $sick->leave_date;
            $this->reason = $sick->reason;
            $this->status = $sick->status;
        }

        $this->modalEditSick = true;
    }

    public function ModalDelete($id)
    {
        $this->sickId = $id;
        $this->modalDeleteSick = true;
    }

    public function updateSick()
    {
        $this->validate();
        $sick = SickLeave::find($this->sickId);
        $sick->update([
            'employee_id' => $this->employeeId,
            'leave_date' => $this->leaveDate,
            'reason' => $this->reason,
            'status' => $this->status,
        ]);

        $this->modalEditSick = false;
        $this->dispatch('reloadPage');
        $this->resetForm();
    }

    public function destroySick()
    {
        $sick = SickLeave::find($this->sickId);
        $sick->delete();

        $this->dispatch('reloadPage');
        
        $this->modalDeleteSick = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset();
    }

    public function render()
    {
        return view('livewire.sick-modal');
    }
}
