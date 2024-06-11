<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class UserManagementModal extends Component
{
    public $modalAdd = false;
    public $modalEdit = false;
    public $modalDelete = false;

    public $name;
    public $email;
    public $password;
    public $role;
    public $UserId;
    public $input = [];

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string',
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

        $this->UserId = $id;

        $user = User::find($id);
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
            $this->role = optional($user->roles->first())->name; 
        }

        $this->modalEdit = true;
    }

    public function ModalDelete($id)
    {
        $this->resetValidation();
        $this->reset();

        $this->UserId = $id;

        $this->modalDelete = true;
    }

    public function create()
    {
        $input = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
            $user = User::create($input);
            $user->assignRole('employee');

            $this->dispatch('reloadPage');
            $this->modalAdd = false;
            $this->resetForm();
            session()->flash('message', 'User added successfully.');
    }

    public function update()
    {
        $user = User::find($this->UserId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        if ($this->role) {
            $user->syncRoles([$this->role]); // Update user role
        }

        $this->dispatch('reloadPage');

        $this->modalEdit = false;
        $this->resetForm();
        session()->flash('message', 'User updated successfully.');
    }

    public function destroy()
    {
        $user = User::find($this->UserId);
        $user->delete();

        $this->dispatch('reloadPage');

        $this->modalDelete = false;
        $this->resetForm();
        session()->flash('message', 'User deleted successfully.');
    }



    public function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
    }
    public function render()
    {
        return view('livewire.user-management-modal');
    }
}
