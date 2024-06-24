<div>
     <!-- Sick Modal -->
     <x-dialog-modal wire:model.live="modalApplySick">
        <x-slot name="title">
            {{ __('Ajukan Izin Sakit') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Membuat Pengajuan Izin Sakit.') }}
            <form wire:keydown.enter="applySick">
                <div class="mt-4">
                    <x-label for="employeeId" value="{{ __('Employee Id') }}" />
                    <x-input id="employeeId" type="text" class="mt-1 block w-full" wire:model.defer="employeeId" value="{{ Auth::user()->employee->id }}" disabled/>
                    @error('employeeId')
                        <span class="text-red-600">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mt-4">
                    <x-label for="leaveDate" value="{{ __('Leave Date') }}" />
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
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalApplySick')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="applySick"  wire:loading.attr="disabled">
                {{ __('Proceed') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <!-- Vacation Modal -->
     <x-dialog-modal wire:model.live="modalApplyVacation">
        <x-slot name="title">
            {{ __('Ajukan Izin Cuti') }}
        </x-slot>

        <x-slot name="content">
            {{ __('Membuat Pengajuan Izin Cuti.') }}
            <form wire:keydown.enter="applyVacation">
                <div class="mt-4">
                    <x-label for="employeeId" value="{{ __('Employee Id') }}" />
                    <x-input id="employeeId" type="text" class="mt-1 block w-full" wire:model.defer="employeeId" value="{{ Auth::user()->employee->id }}" disabled/>
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
            </form>
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('modalApplyVacation')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="applyVacation"  wire:loading.attr="disabled">
                {{ __('Proceed') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>
