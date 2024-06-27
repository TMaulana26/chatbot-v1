<?php

namespace App\Livewire;

use App\Models\Attendance;
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

final class AttendanceTable extends PowerGridComponent
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
        return Attendance::query()->with('employee');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('employee.name', fn($row) => e($row->employee->name))
            ->add('employee_id')
            ->add('check_in_time')
            ->add('check_out_time')
            ->add('created_at')
            ->add('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),

            Column::make('Name', 'employee.name', 'employee.name')
                ->sortable()
                ->searchable(),

            Column::make('Employee id', 'employee_id'),
            Column::make('Check in time', 'check_in_time_formatted', 'check_in_time')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Check in time', 'check_in_time')
                ->sortable()
                ->searchable(),

            Column::make('Check out time', 'check_out_time_formatted', 'check_out_time')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Check out time', 'check_out_time')
                ->sortable()
                ->searchable(),

            Column::make('Created at', 'created_at_formatted', 'created_at')
                ->sortable()
                ->searchable()
                ->hidden(),

            Column::make('Created at', 'created_at')
                ->sortable()
                ->searchable(),

            Column::make('Updated at', 'updated_at_formatted', 'updated_at')
                ->sortable()
                ->searchable()
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

    public function actions(Attendance $row): array
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

    /*
    public function actionRules($row): array
    {
       return [
            // Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($row) => $row->id === 1)
                ->hide(),
        ];
    }
    */
}
