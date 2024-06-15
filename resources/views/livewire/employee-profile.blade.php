<x-form-section submit="save">
    <x-slot name="title">
        {{ __('Update Employee Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Ensure your employee information is up to date.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name"
                autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="job_title" value="{{ __('Job Title') }}" />
            <x-input id="job_title" type="text" class="mt-1 block w-full" wire:model.defer="state.job_title"
                autocomplete="job-title" />
            <x-input-error for="job_title" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="department_id" value="{{ __('Department') }}" />
            <select id="department_id" wire:model.defer="state.department_id"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                <option value="">{{__('Select a Department')}}</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </select>
            <x-input-error for="department_id" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4" x-data="{ tooltip: false, validatePhone() { this.tooltip = isNaN(this.$refs.phone.value); } }">
            <x-label for="phone" value="{{ __('Phone') }}" />
            <x-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="state.phone"
                autocomplete="phone" />
            <x-input-error for="phone" class="mt-2" />
            <span x-show="tooltip" class="text-red-500 text-sm">Please enter a valid phone number.</span>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="hire_date" value="{{ __('Hire Date') }}" />
            <x-input id="hire_date" placeholder="dd-mm-yyyy" type="date" class="mt-1 block w-full"
                wire:model.defer="state.hire_date" autocomplete="hire-date" />
            <x-input-error for="hire_date" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="salary" value="{{ __('Salary') }}" />
            <input id="salary" type="number"
                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                wire:model.defer="state.salary" autocomplete="salary" disabled placeholder="{{ __('Not Assign Yet') }}"/>
            <x-input-error for="salary" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button>
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
