<?php

namespace App\Livewire;

use Illuminate\Support\Carbon;
use App\Models\SystemInstruction;
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
use PowerComponents\LivewirePowerGrid\PowerGridComponent;

final class SystemInstructionTable extends PowerGridComponent
{
    protected $listeners = ['reloadPage' => '$refresh'];

    public function setUp(): array
    {
        $this->showCheckBox();

        return [
            Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    public function datasource(): Builder
    {
        return SystemInstruction::query();
    }

    public function relationSearch(): array
    {
        return [];
    }

    public function fields(): PowerGridFields
    {
        return PowerGrid::fields()
            ->add('id')
            ->add('name')
            ->add('instruction')
            ->add('created_at')
            ->add('updated_at');
    }

    public function columns(): array
    {
        return [
            Column::make('Id', 'id'),
            Column::make('Name', 'name')
                ->sortable()
                ->searchable(),

            Column::make('Instruction', 'instruction')
                ->sortable()
                ->searchable(),

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

    #[\Livewire\Attributes\On('edit')]
    public function edit($rowId): void
    {
        $this->dispatch('modalEdit');
        $this->js('alert(' . $rowId . ')');
    }

    #[\Livewire\Attributes\On('delete')]
    public function delete($rowId): void
    {
        $this->dispatch('modalDelete');
        $this->js('alert(' . $rowId . ')');
    }

    public function actions(SystemInstruction $row): array
    {
        return [
            Button::add('edit')
                ->render(function ($rowId) {
                    return Blade::render(<<<HTML
                    <x-button onclick="Livewire.dispatch('ModalEdit', { id:  {$rowId->id}  })"><i class="fa-sharp fa-solid fa-pen-to-square"></i></x-button>
                HTML);
                }),

            Button::add('delete')
                ->render(function ($rowId) {
                    return Blade::render(<<<HTML
                    <x-button onclick="Livewire.dispatch('ModalDelete', { id:  {$rowId->id}  })"><i class="fa-sharp fa-solid fa-trash"></i></x-button>
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
