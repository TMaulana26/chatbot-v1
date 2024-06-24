<div>
    <!-- Add Modal -->
    <div x-data="{ userId: @entangle('userId') }">
        <x-dialog-modal wire:model.live="modalAdd">
            <x-slot name="title">
                {{ __('Add Employee') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Create A New Employee') }}
                <form wire:keydown.enter="createEmployee">
                    <div class="">
                        <x-label for="userId" value="{{ __('User Id') }}" />
                        <select id="userId" x-init="$nextTick(() => { $('#userId').select2(); })" x-on:change="userId = $event.target.value"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                            <option value="">{{ __('Select a User') }}</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->id }} : {{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="">
                        <x-label for="name" value="{{ __('Name') }}" />
                        <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                        <x-input-error for="name" class="mt-2" />
                    </div>
    
                    <div class="">
                        <x-label for="jobTitle" value="{{ __('Job Title') }}" />
                        <x-input id="jobTitle" type="text" class="mt-1 block w-full" wire:model.defer="jobTitle" />
                        <x-input-error for="jobTitle" class="mt-2" />
                    </div>
    
                    <div class="">
                        <x-label for="department_id" value="{{ __('Department') }}" />
                        <select id="department_id" wire:model.defer="department_id"
                            class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                            <option value="">{{ __('Select a Department') }}</option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>
    
                    <div class="">
                        <x-label for="phone" value="{{ __('Phone') }}" />
                        <x-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="phone" />
                        <x-input-error for="phone" class="mt-2" />
                    </div>
    
                    <div class="">
                        <x-label for="hireDate" value="{{ __('Hire Date') }}" />
                        <x-input id="hireDate" type="date" class="mt-1 block w-full" wire:model.defer="hireDate" />
                        <x-input-error for="hireDate" class="mt-2" />
                    </div>
    
                    <div class="">
                        <x-label for="salary" value="{{ __('Salary') }}" />
                        <x-input id="salary" type="text" class="mt-1 block w-full" wire:model.defer="salary" />
                        <x-input-error for="salary" class="mt-2" />
                    </div>
                </form>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('modalAdd')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-button class="ms-3" wire:click="createEmployee" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
            <script>
                document.addEventListener('livewire:load', function() {
                    Livewire.on('reinitializeSelect2', () => {
                        $('#userId').select2();
                    });
                });
            </script>
        </x-dialog-modal>

    </div>

    <!-- Edit Modal -->

    <x-dialog-modal wire:model.live="modalEdit">
        <x-slot name="title">
            {{ __('Edit Employee') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Edit An Employee') }}
            <form wire:keydown.enter="update">
                <div class="">
                    <x-label for="name" value="{{ __('Name') }}" />
                    <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="name" />
                    <x-input-error for="name" class="mt-2" />
                </div>
    
                <div class="">
                    <x-label for="jobTitle" value="{{ __('Job Title') }}" />
                    <x-input id="jobTitle" type="text" class="mt-1 block w-full" wire:model.defer="jobTitle" />
                    <x-input-error for="jobTitle" class="mt-2" />
                </div>
    
                <div class="">
                    <x-label for="department_id" value="{{ __('Department') }}" />
                    <select id="department_id" wire:model.defer="department_id"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                        <option value="">{{ __('Select a Department') }}</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
    
                <div class="">
                    <x-label for="phone" value="{{ __('Phone') }}" />
                    <x-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="phone" />
                    <x-input-error for="phone" class="mt-2" />
                </div>
    
                <div class="">
                    <x-label for="hireDate" value="{{ __('Hire Date') }}" />
                    <x-input id="hireDate" type="date" class="mt-1 block w-full" wire:model.defer="hireDate" />
                    <x-input-error for="hireDate" class="mt-2" />
                </div>
    
                <div class="">
                    <x-label for="salary" value="{{ __('Salary') }}" />
                    <x-input id="salary" type="text" class="mt-1 block w-full" wire:model.defer="salary" />
                    <x-input-error for="salary" class="mt-2" />
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalEdit')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="update" wire:loading.attr="disabled">
                {{ __('Save') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Delete Modal -->
    <x-dialog-modal wire:model.live="modalDelete">
        <x-slot name="title">
            {{ __('Delete Instruction') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this Employee? This action cannot be undone.') }}
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
