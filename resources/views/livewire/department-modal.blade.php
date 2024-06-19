<div>
    <!-- Add Modal -->
    <x-dialog-modal wire:model.live="modalAdd">
        <x-slot name="title">
            {{ __('Add Instruction') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Add a Department') }}
            <form wire:keydown.enter="addDepartment">
                <div class="mt-4">
                    <x-label for="name" value="{{ __('Title') }}" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                    @error('name')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-label for="description" value="{{ __('Description') }}" />
                    <x-input id="description" class="mt-1 block w-full" wire:model.defer="description" />
                    @error('instruction')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalAdd')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="addDepartment" wire:loading.attr="disabled">
                {{ __('Proceed') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Edit Modal -->
    <x-dialog-modal wire:model.live="modalEdit">
        <x-slot name="title">
            {{ __('Edit Instruction') }}
        </x-slot>

        <x-slot name="content">
            <form wire:keydown.enter="updateDepartment">
                <div class="mt-4">
                    <x-label for="name" :value="__('Name')" />
                    <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" />
                </div>
    
                <div class="mt-4">
                    <x-label for="description" :value="__('Description')" />
                    <x-input id="description" class="block mt-1 w-full" wire:model="description" />
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalEdit')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="updateDepartment" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Delete Modal -->
    <x-dialog-modal wire:model.live="modalDelete">
        <x-slot name="title">
            {{ __('Delete Instruction') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this Department? This action cannot be undone.') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalDelete')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="destroyDepartment" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>

