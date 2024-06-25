<?php

namespace App\Livewire;

use App\Models\VacationLeave;
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

final class VacationLeaveTable extends PowerGridComponent
{
    protected $listeners = ['reloadPage' => '$refresh'];

    

    public function setUp(): array
    {
        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage(perPage: 5, perPageValues: [5, 10, 50, 100])
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return VacationLeave::query()->with('employee');
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('employee_id')
            ->add('employee.name', fn($row) => e($row->employee->name))
            ->add('leave_date_formatted', fn(VacationLeave $model) => Carbon::parse($model->leave_date)->format('d/m/Y'))
            ->add('reason')
            ->add('status')
            ->add('created_at')
            ->add('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Employee id', 'employee_id'),
            Column::make('Name', 'employee.name', 'employee.name')
                ->searchable(),

            Column::make('Leave date', 'leave_date_formatted', 'leave_date')
                ->sortable()
                ->searchable(),

            Column::make('Reason', 'reason')
                ->sortable()
                ->searchable(),

            Column::make('Status', 'status')
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

    public function actions(VacationLeave $row): array
    {
        return [
            Button::add('edit')
                ->render(function ($rowId) {
                    return Blade::render(<<<HTML
                    <x-success-button onclick="Livewire.dispatch('ModalEditVacation', { id:  {$rowId->id}  })"><i class="fa-sharp fa-solid fa-pen-to-square"></i></x-success-button>
                HTML);
                }),

            Button::add('delete')
                ->render(function ($rowId) {
                    return Blade::render(<<<HTML
                    <x-danger-button onclick="Livewire.dispatch('ModalDeleteVacation', { id:  {$rowId->id}  })"><i class="fa-sharp fa-solid fa-trash"></i></x-danger-button>
                HTML);
                }),
        ];
    }
}
