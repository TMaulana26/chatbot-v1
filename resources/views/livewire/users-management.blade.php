<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Users Management CRUD ') }}
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
                            {{ __('Users Management ') }}
                        </p>
                    </div>
                    <div class="">
                        <div class="flex justify-center mt-4">
                            <x-button onclick="Livewire.dispatch('ModalAdd')">{{ __('Add User') }}</x-button>
                        </div>
                        <livewire:user-management-modal />
                        <livewire:user-table />
                    </div>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
