<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Employee Leave CRUD ') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div
                    class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col justify-center">
                        <x-sidebar-logo class="block h-16 w-auto" />
                        <p class="font-bold text-gray-500 text-center mt-2 italic">
                            {{ __('Employee Leave Management ') }}
                        </p>
                    </div>
                    <div class="m-4">
                        <div class="flex justify-center mt-4">
                            <x-button
                                onclick="Livewire.dispatch('ModalAdd')">{{ __('Add Leave to Employee') }}</x-button>
                        </div>
                        <livewire:apply-sick-modal />
                        <livewire:sick-modal />
                        <livewire:vacation-modal />
                        <div class="mt-2">
                            <p class="font-bold text-gray-300 mt-4 italic">
                                {{ __('Sick Leave Management ') }}
                            </p>
                            <livewire:sick-leave-table />
                            <x-section-border />
                            <p class="font-bold text-gray-300 mt-4 italic">
                                {{ __('Vacation Leave Management ') }}
                            </p>
                            <livewire:vacation-leave-table />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
