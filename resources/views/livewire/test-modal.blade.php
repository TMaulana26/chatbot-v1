<div>
    <div class="m-4">
        <div class="flex justify-center mt-4">
            <x-button wire:click="testModal">{{ __('Test Modal') }}</x-button>
        </div>
    </div>
    <!-- Test Modal -->
    <x-dialog-modal wire:model.live="confirmingTestModal">
        <x-slot name="title">
            {{ __('Test Modal') }}
        </x-slot>

        <x-slot name="content">
            {{ __('This is a test modal. Do you want to proceed?') }}
        </x-slot>

        <x-slot name="footer">
            <x-secondary-button wire:click="$toggle('confirmingTestModal')"
                wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-secondary-button>

            <x-button class="ms-3" wire:click="proceedWithTest" wire:loading.attr="disabled">
                {{ __('Proceed') }}
            </x-button>
        </x-slot>
    </x-dialog-modal>
</div>