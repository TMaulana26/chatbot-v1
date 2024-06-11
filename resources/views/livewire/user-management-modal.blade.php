<div>
    <!-- Add Modal -->
    <x-dialog-modal wire:model.live="modalAdd">
        <x-slot name="title">
            {{ __('Add Instruction') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Create A New User') }}
            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                    autofocus autocomplete="name" wire:model.defer="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('E-mail') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" wire:model.defer="email" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" wire:model.defer="password" />
            </div>
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
            {{ __('Edit User') }}
        </x-slot>

        <x-slot name="content">
            <div class="mt-4">
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" class="block mt-1 w-full" type="text" wire:model="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" :value="__('E-mail')" />
                <x-input id="email" class="block mt-1 w-full" wire:model="email" />
            </div>

            <div class="mt-4">
                <x-label for="Role" :value="__('Role')" />
                <div class="flex justify-center mt-1 space-x-4">
                    <div class="mx-1">
                        <input type="radio" name="role" value="admin" id="role_admin" wire:model="role" />
                        <label for="role_admin">Admin</label>
                    </div>
                    <div class="mx-1">
                        <input type="radio" name="role" value="hr" id="role_hr" wire:model="role" />
                        <label for="role_hr">HR</label>
                    </div>
                    <div class="mx-1">
                        <input type="radio" name="role" value="employee" id="role_employee" wire:model="role" />
                        <label for="role_employee">Employee</label>
                    </div>
                </div>
            </div>
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
            {{ __('Delete User') }}
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
