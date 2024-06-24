<?php

namespace App\Livewire;

use App\Models\Attendance;
use Livewire\Component;

class AttendanceManagementModal extends Component
{
    public $modalAdd = false;
    public $modalEdit = false;
    public $modalDelete = false;
    public $attendanceId;
    public $name;
    public $employeeId;
    public $checkInTime;
    public $checkOutTime;

    protected $rules = [
        'checkInTime' => 'required',
        'checkOutTime' => 'required',
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

        $this->attendanceId = $id;

        $attendance = Attendance::find($id);
        if ($attendance) {
            $this->employeeId = $attendance->employee_id;
            $this->name = $attendance->employee->name;
            $this->checkInTime = $attendance->check_in_time;
            $this->checkOutTime = $attendance->check_out_time;
        }
        
        $this->modalEdit = true;
    }

    public function ModalDelete($id)
    {
        $this->resetValidation();
        $this->reset();

        $this->attendanceId = $id;

        $this->modalDelete = true;
    }

    public function createAttendance()
    {
        $this->validate();

        Attendance::create([
            'employee_id' => $this->employeeId,
            'check_in_time' => $this->checkInTime,
            'check_out_time' => $this->checkOutTime,
        ]);

        $this->dispatch('reloadPage');

        $this->modalAdd = false;
        $this->resetForm();
    }

    public function update()
    {
        $this->validate();

        $attendance = Attendance::find($this->attendanceId);
        
        $attendance->update([
            'check_in_time' => $this->checkInTime,
            'check_out_time' => $this->checkOutTime,
        ]);

        $this->dispatch('reloadPage');

        $this->modalEdit = false;
        $this->resetForm();
    }

    public function destroy()
    {
        $attendance = Attendance::find($this->attendanceId);
        $attendance->delete();

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
        return view('livewire.attendance-management-modal');
    }
}
