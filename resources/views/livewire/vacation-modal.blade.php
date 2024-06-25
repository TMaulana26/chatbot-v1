<div>
    <!-- Edit Modal -->
    <x-dialog-modal wire:model.live="modalEditVacation">
        <x-slot name="title">
            {{ __('Edit Leave to an Employee') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Edit Sick or Vacation leave to an Employee.') }}
            <form wire:keydown.enter="update">
                <div class="mt-4">
                    <x-label for="employeeId" value="{{ __('Employee Id') }}" />
                    <x-input id="employeeId" type="text" class="mt-1 block w-full" wire:model.defer="employeeId" />
                    @error('employeeId')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <x-label for="leaveDate" value="{{ __('Vacation Date') }}" />
                    <x-input id="leaveDate" class="mt-1 block w-full" type="date" wire:model.defer="leaveDate" />
                    @error('leaveDate')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <x-label for="reason" value="{{ __('Reason') }}" />
                    <x-input id="reason" class="mt-1 block w-full" wire:model.defer="reason" />
                    @error('reason')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <x-label for="status" value="{{ __('Stastus') }}" />
                    <select name="status" id="status" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full" wire:model.defer="status">
                        <option value="pending">{{ __('Pending') }}</option>
                        <option value="approved">{{ __('Approved') }}</option>
                        <option value="declined">{{ __('Declined') }}</option>
                    </select>
                    @error('status')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalEdit')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="updateVacation" wire:loading.attr="disabled">
                {{ __('Proceed') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Delete Modal -->
    <x-dialog-modal wire:model.live="modalDeleteVacation">
        <x-slot name="title">
            {{ __('Delete Vacation Leave to an Employee') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this employee Vacation Leave? This action cannot be undone.') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalDeleteVacation')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="destroyVacation" wire:loading.attr="disabled">
                {{ __('Delete') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
