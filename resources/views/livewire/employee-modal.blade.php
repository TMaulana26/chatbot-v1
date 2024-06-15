<div>
    <!-- Add Modal -->
    <div x-data="{ userId: @entangle('userId') }">
        <x-dialog-modal wire:model="modalAdd">
            <x-slot name="title">
                {{ __('Add Employee') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Create A New Employee') }}
                <div class="">
                    <x-label for="userId" value="{{ __('User Id') }}" />
                    <select x-model="userId" id="userId"
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
                    <x-label for="job_title" value="{{ __('Job Title') }}" />
                    <x-input id="job_title" type="text" class="mt-1 block w-full" wire:model.defer="jobTitle" />
                    <x-input-error for="job_title" class="mt-2" />
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
                    <x-label for="hire_date" value="{{ __('Hire Date') }}" />
                    <x-input id="hire_date" type="date" class="mt-1 block w-full" wire:model.defer="hireDate" />
                    <x-input-error for="hire_date" class="mt-2" />
                </div>

                <div class="">
                    <x-label for="salary" value="{{ __('Salary') }}" />
                    <x-input id="salary" type="text" class="mt-1 block w-full" wire:model.defer="salary" />
                    <x-input-error for="salary" class="mt-2" />
                </div>
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="$toggle('modalAdd')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </x-secondary-button>

                <x-button class="ms-3" wire:click="createOrUpdate" wire:loading.attr="disabled">
                    {{ __('Save') }}
                </x-button>
            </x-slot>
        </x-dialog-modal>
        
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('userId', () => ({
                    userId: @entangle('userId'),
                    init() {
                        this.$watch('userId', value => {
                            if (value) {
                                Livewire.dispatch('fetchEmployeeData', value);
                            }
                        });
                    }
                }));
            });

            document.addEventListener('livewire:load', function () {
                Livewire.on('reloadPage', () => {
                    location.reload();
                });
            });
        </script>
    </div>
</div>
