<?php

namespace App\Livewire;

use Livewire\Component;

class EmployeeProfile extends Component
{
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'phone' => 'required|string|max:255',
        'address' => 'required|string|max:255',
        
    ];

    public function render()
    {
        return view('livewire.employee-profile');
    }
}
