<div>
    <!-- Add Modal -->    
    <x-dialog-modal wire:model.live="modalAdd">
        <x-slot name="title">
            {{ __('Edit Attendance') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Edit An Employee Attendance') }}
            <form wire:keydown.enter="createAttendance">
                <div class="mt-4">
                    <x-label for="employeeId" :value="__('Employee Id')" />
                    <x-input id="employeeId" class="block mt-1 w-full" type="text" wire:model="employeeId"/>
                </div>

                <div class="mt-4">
                    <x-label for="checkInTime" :value="__('Check In Time')" />
                    <x-input id="checkInTime" class="block mt-1 w-full" type="Datetime-local" wire:model.defer="checkInTime"/>
                    <x-input-error for="checkInTime" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-label for="checkOutTime" :value="__('Check Out Time')" />
                    <x-input id="checkOutTime" class="block mt-1 w-full" type="Datetime-local" wire:model.defer="checkOutTime"/>
                    <x-input-error for="checkOutTime" class="mt-2" />
                </div>
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalAdd')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="createAttendance" wire:loading.attr="disabled">
                {{ __('Add Attendance') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>



    <!-- Edit Modal -->
    <x-dialog-modal wire:model.live="modalEdit">
        <x-slot name="title">
            {{ __('Edit Attendance') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Edit An Employee Attendance') }}
            <form wire:keydown.enter="update">
                <div class="mt-4">
                    <x-label for="employeeId" :value="__('Employee Id')" />
                    <x-input id="employeeId" class="block mt-1 w-full" type="text" wire:model="employeeId" disabled/>
                </div>
    
                <div class="mt-4">
                    <x-label for="name" :value="__('Employee Name')" />
                    <x-input id="name" class="block mt-1 w-full" wire:model="name" disabled/>
                </div>

                <div class="mt-4">
                    <x-label for="checkInTime" :value="__('Check In Time')" />
                    <x-input id="checkInTime" class="block mt-1 w-full" type="Datetime-local" wire:model.defer="checkInTime"/>
                    <x-input-error for="checkInTime" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-label for="checkOutTime" :value="__('Check Out Time')" />
                    <x-input id="checkOutTime" class="block mt-1 w-full" type="Datetime-local" wire:model.defer="checkOutTime"/>
                    <x-input-error for="checkOutTime" class="mt-2" />
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
            {{ __('Delete Employee Attendance') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Are you sure you want to delete this employee attendance? This action cannot be undone.') }}
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

