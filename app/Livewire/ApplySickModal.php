<?php

namespace App\Livewire;

use App\Models\VacationLeave;
use Livewire\Component;
use App\Models\SickLeave;
use Illuminate\Support\Facades\Auth;

class ApplySickModal extends Component
{
    public $modalApplySick = false;
    public $modalApplyVacation = false;
    public $employeeId;
    public $leaveDate;
    public $reason;

    protected $rules = [
        'employeeId' => 'required',
        'leaveDate' => 'required|date',
        'reason' => 'required',
    ];

    protected $listeners = ['ModalApplySick', 'ModalApplyVacation'];

    public function ModalApplySick()
    {
        $this->resetForm();
        $this->employeeId = Auth::user()->employee->id;
        $this->modalApplySick = true;
    }

    public function ModalApplyVacation()
    {
        $this->resetForm();
        $this->employeeId = Auth::user()->employee->id;
        $this->modalApplyVacation = true;
    }

    public function applySick()
    {
        $this->validate();

        SickLeave::create([
            'employee_id' => $this->employeeId,
            'leave_date' => $this->leaveDate,
            'reason' => $this->reason,
        ]);

        $this->modalApplySick = false;
        $this->dispatch('responseApplySick', ['type' => 'sick', 'date' => $this->leaveDate]);
        $this->resetForm();
    }

    public function applyVacation()
    {
        $this->validate();

        VacationLeave::create([
            'employee_id' => $this->employeeId,
            'leave_date' => $this->leaveDate,
            'reason' => $this->reason,
        ]);

        $this->modalApplyVacation = false;
        $this->dispatch('responseApplySick', ['type' => 'vacation', 'date' => $this->leaveDate]);
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->resetValidation();
        $this->reset();
    }

    public function render()
    {
        return view('livewire.apply-sick-modal');
    }
}
