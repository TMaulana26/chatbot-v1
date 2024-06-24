<div>
    <!-- Add Modal -->
    <x-dialog-modal wire:model.live="modalAdd">
        <x-slot name="title">
            {{ __('Add Instruction') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Create A New Instruction For The DEON') }}
            <form wire:keydown.enter="create">
                <div class="mt-4">
                    <x-label for="name" value="{{ __('Title') }}" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                    @error('name')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-label for="instruction" value="{{ __('Instruction') }}" />
                    <x-input id="instruction" class="mt-1 block w-full" wire:model.defer="instruction" />
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

            <x-button class="ms-3" wire:click="create" wire:loading.attr="disabled">
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
            <form wire:keydown.enter="update">
                <div class="mt-4">
                    <x-label for="name" :value="__('Name')" />
                    <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" />
                </div>
    
                <div class="mt-4">
                    <x-label for="instruction" :value="__('Instruction')" />
                    <x-input id="instruction" class="block mt-1 w-full" wire:model="instruction" />
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalEdit')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="update" wire:loading.attr="disabled">
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
            {{ __('Are you sure you want to delete this instruction? This action cannot be undone.') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalDelete')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="destroy" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
