<?php

namespace App\Livewire;

use App\Models\InfoUmumHR;
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

final class InfoUmumHRTable extends PowerGridComponent
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
            Responsive::make()
                ->fixedColumns('id', 'title', 'created_at', 'updated_at'),
        ];
    }

    public function datasource(): Builder
    {
        return InfoUmumHR::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('title')
            ->add('description')
            ->add('created_at')
            ->add('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Title', 'title')
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
                ->searchable()
                ->hidden(),

            Column::make('Updated at', 'updated_at')
                ->searchable()
                ->sortable(),

            Column::action('Action'),

            Column::make('Description', 'description')
                ->sortable()
                ->searchable(),

        ];
    }

    public function filters(): array
    {
        return [
        ];
    }

    public function actions(InfoUmumHR $row): array
    {
        return [
            Button::add('edit')
                ->render(function ($rowId) {
                    return Blade::render(<<<HTML
                <x-success-button onclick="Livewire.dispatch('ModalEdit', { id:  {$rowId->id}  })"><i class="fa-sharp fa-solid fa-pen-to-square text-gray-300"></i></x-success-button>
            HTML);
                }),

            Button::add('delete')
                ->render(function ($rowId) {
                    return Blade::render(<<<HTML
                <x-danger-button onclick="Livewire.dispatch('ModalDelete', { id:  {$rowId->id}  })"><i class="fa-sharp fa-solid fa-trash text-gray-300"></i></x-danger-button>
            HTML);
                }),
        ];
    }
}
