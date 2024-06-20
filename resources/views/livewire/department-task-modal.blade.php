<div>
    <!-- Add Modal -->
    <x-dialog-modal wire:model.live="modalAdd">
        <x-slot name="title">
            {{ __('Add Department Task') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Add a Task for a Department') }}
            <form wire:keydown.enter="addDepartmentTask">
                <div class="mt-4">
                    <x-label for="title" value="{{ __('Title') }}" />
                    <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" />
                    @error('title')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-label for="description" value="{{ __('Description') }}" />
                    <x-input id="description" class="mt-1 block w-full" wire:model.defer="description" />
                    @error('description')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-label for="departmentId" value="{{ __('Department') }}" />
                    <select id="departmentId" wire:model.defer="departmentId"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                        <option value="">{{ __('Select a Department') }}</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <x-label for="status" value="{{ __('Stastus') }}" />
                    <select id="status" wire:model.defer="status" 
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                        <option value="">{{ __('Select a Status') }}</option>
                        <option value="pending">{{ __('Pending') }}</option>
                        <option value="in progress">{{ __('In Progress') }}</option>
                        <option value="completed">{{ __('Completed') }}</option>
                    </select>
                </div>
                <div class="mt-4">
                    <x-label for="dueDate" value="{{ __('Due Date') }}" />
                    <x-input id="dueDate" type="date" class="mt-1 block w-full" wire:model.defer="dueDate" />
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalAdd')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="addDepartmentTask" wire:loading.attr="disabled">
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
            <form wire:keydown.enter="updateDepartmentTask">
                <div class="mt-4">
                    <x-label for="title" value="{{ __('Title') }}" />
                    <x-input id="title" type="text" class="mt-1 block w-full" wire:model.defer="title" />
                    @error('title')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-label for="description" value="{{ __('Description') }}" />
                    <x-input id="description" class="mt-1 block w-full" wire:model.defer="description" />
                    @error('description')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mt-4">
                    <x-label for="departmentId" value="{{ __('Department') }}" />
                    <select id="departmentId" wire:model.defer="departmentId"
                        class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                        <option value="">{{ __('Select a Department') }}</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mt-4">
                    <x-label for="status" value="{{ __('Stastus') }}" />
                    <select id="status" wire:model.defer="status" 
                    class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full">
                        <option value="">{{ __('Select a Status') }}</option>
                        <option value="pending">{{ __('Pending') }}</option>
                        <option value="in progress">{{ __('In Progress') }}</option>
                        <option value="completed">{{ __('Completed') }}</option>
                    </select>
                </div>
                <div class="mt-4">
                    <x-label for="dueDate" value="{{ __('Due Date') }}" />
                    <x-input id="dueDate" type="date" class="mt-1 block w-full" wire:model.defer="dueDate" />
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalEdit')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="updateDepartmentTask" wire:loading.attr="disabled">
                {{ __('Update') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Delete Modal -->
    <x-dialog-modal wire:model.live="modalDelete">
        <x-slot name="title">
            {{ __('Delete Department Task') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this Task? This action cannot be undone.') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalDelete')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="destroyDepartmentTask" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>

