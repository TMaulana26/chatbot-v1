<?php

namespace App\Livewire;

use App\Models\user;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Responsive;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class UserTable extends PowerGridComponent
{
    protected $listeners = ['reloadPage' => '$refresh'];

    public function setUp(): array
    {
        return [
            Header::make()
            ->showSearchInput()
            ->showToggleColumns(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return User::query()
            ->leftJoin('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->leftJoin('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->select('users.*', 'roles.name as role_name');
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('user_name', fn($user) => e($user->name))
            ->add('user_email', fn($user) => e($user->email))
            ->add('role_name', fn($user) => e($user->roles->isNotEmpty() ? $user->roles[0]['name'] : 'No role assigned'))
            ->add('created_at')
            ->add('updated_at');

    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id')
                ->sortable(),

            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Roles', 'role_name')
                ->sortable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::make('Updated at', 'updated_at_formatted', 'updated_at')
                ->sortable()
                ->hidden(),

            Column::make('Updated at', 'updated_at')
                ->sortable()
                ->searchable(),

            Column::action('Action')
        ];
    }

    public function actions(user $row): array
    {
        return [
            Button::add('edit')
                ->render(function ($rowId) {
                    return Blade::render(<<<HTML
                    <x-success-button onclick="Livewire.dispatch('ModalEdit', { id:  {$rowId->id}  })"><i class="fa-sharp fa-solid fa-pen-to-square"></i></x-success-button>
                HTML);
                }),

            Button::add('delete')
                ->render(function ($rowId) {
                    return Blade::render(<<<HTML
                    <x-danger-button onclick="Livewire.dispatch('ModalDelete', { id:  {$rowId->id}  })"><i class="fa-sharp fa-solid fa-trash"></i></x-danger-button>
                HTML);
                }),
        ];
    }
}
