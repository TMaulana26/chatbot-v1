<?php

namespace App\Livewire;

use App\Models\VacationLeave;
use Livewire\Component;

class VacationModal extends Component
{
    public $modalEditVacation = false;
    public $modalDeleteVacation = false;
    public $vacationId;
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

    protected $listeners = ['ModalEditVacation' => 'ModalEdit', 'ModalDeleteVacation' => 'ModalDelete'];

    public function ModalEdit($id)
    {
        $this->vacationId = $id;

        $vacation = VacationLeave::find($id);
        if ($vacation) {
            $this->employeeId = $vacation->employee_id;
            $this->leaveDate = $vacation->leave_date;
            $this->reason = $vacation->reason;
            $this->status = $vacation->status;
        }

        $this->modalEditVacation = true;
    }

    public function ModalDelete($id)
    {
        $this->vacationId = $id;
        $this->modalDeleteVacation = true;
    }

    public function updateVacation()
    {
        $this->validate();
        $vacation = VacationLeave::find($this->vacationId);
        $vacation->update([
            'employee_id' => $this->employeeId,
            'leave_date' => $this->leaveDate,
            'reason' => $this->reason,
            'status' => $this->status
        ]);

        $this->modalEditVacation = false;
        $this->dispatch('reloadPage');
        $this->resetForm();
    }

    public function destroyVacation()
    {
        $vacation = VacationLeave::find($this->vacationId);
        $vacation->delete();

        $this->dispatch('reloadPage');
        
        $this->modalDeleteVacation = false;
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset();
    }

    public function render()
    {
        return view('livewire.vacation-modal');
    }
}
