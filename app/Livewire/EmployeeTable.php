<?php

namespace App\Livewire;

use App\Models\Employee;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Blade;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Button;
use PowerComponents\LivewirePowerGrid\Column;
use PowerComponents\LivewirePowerGrid\Footer;
use PowerComponents\LivewirePowerGrid\Header;
use PowerComponents\LivewirePowerGrid\PowerGrid;
use PowerComponents\LivewirePowerGrid\Exportable;
use PowerComponents\LivewirePowerGrid\Facades\Filter;
use PowerComponents\LivewirePowerGrid\PowerGridFields;
use PowerComponents\LivewirePowerGrid\Traits\WithExport;
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class EmployeeTable extends PowerGridComponent
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
        return Employee::query()->with('department')->with('user');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('user_name', fn($row) => e($row->user->name))
            ->add('name')
            ->add('email')
            ->add('job_title')
            ->add('department_name', fn($row) => e($row->department->name))
            ->add('phone')
            ->add('hire_date')
            ->add('salary')
            ->add('created_at')
            ->add('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Username', 'user_name'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Email', 'email')
                ->sortable()
                ->searchable(),

            Column::make('Job title', 'job_title')
                ->sortable()
                ->searchable(),
            Column::make('Department', 'department_name'),

            Column::make('Phone', 'phone')
                ->sortable()
                ->searchable(),

            Column::make('Hire date',  'hire_date')
                ->sortable(),

            Column::make('Salary', 'salary')
                ->sortable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable()
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

    public function filters(): array
    {
        return [
        ];
    }

    public function actions(Employee $row): array
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
