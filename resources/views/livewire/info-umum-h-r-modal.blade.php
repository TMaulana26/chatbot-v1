<div>
    <!-- Add Modal -->
    <x-dialog-modal wire:model.live="modalAdd">
        <x-slot name="title">
            {{ __('Add New Info') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Create A New General Information') }}
            <form wire:keydown.enter="create">
                <div class="mt-4">
                    <x-label for="title" value="{{ __('Title') }}" />
                    <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" />
                    @error('title')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-label for="description" value="{{ __('Description') }}" />
                    <textarea name="description" id="description" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="description" ></textarea>
                    @error('description')
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
            {{ __('Edit General Info') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Edit A General Information') }}
            <form wire:keydown.enter="update">
                <div class="mt-4">
                    <x-label for="title" :value="__('Title')" />
                    <x-input id="title" class="block mt-1 w-full" type="text" wire:model="title" />
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

            <x-button class="ms-3" wire:click="update" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Delete Modal -->
    <x-dialog-modal wire:model.live="modalDelete">
        <x-slot name="title">
            {{ __('Delete A General Info') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this general information? This action cannot be undone.') }}
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
