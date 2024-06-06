<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }} {{ Auth::user()->getRoleNames()->first() }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                @if (request()->routeIs('chatbot'))
                    @livewire('chatbot-component')
                @endif
                @if (request()->routeIs('chatbot-2'))
                    @livewire('chatbot-component-gemini')
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
