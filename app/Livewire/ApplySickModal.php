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
    public $modalAdd = false;
    public $employeeId;
    public $leaveDate;
    public $reason;

    protected $rules = [
        'employeeId' => 'required',
        'leaveDate' => 'required|date',
        'reason' => 'required',
    ];

    protected $listeners = ['ModalApplySick', 'ModalApplyVacation', 'ModalAdd'];

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

    public function ModalAdd()
    {
        $this->resetForm();
        $this->modalAdd = true;
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

    public function addLeave()
    {
        $this->validate([
            'typeLeave' => 'required|string',
            'employeeId' => 'required|integer',
            'leaveDate' => 'required|date',
            'reason' => 'required|string|max:255',
        ]);

        if ($this->typeLeave === 'sick') {
            SickLeave::create([
                'employee_id' => $this->employeeId,
                'leave_date' => $this->leaveDate,
                'reason' => $this->reason,
            ]);
        } elseif ($this->typeLeave === 'vacation') {
            VacationLeave::create([
                'employee_id' => $this->employeeId,
                'leave_date' => $this->leaveDate,
                'reason' => $this->reason,
            ]);
        } elseif ($this->typeLeave === 'null') {
            $this->addError('typeLeave', 'Please select a valid type of leave.');
            return;
        }

        $this->modalAdd = false;
        $this->dispatch('reloadPage');
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
