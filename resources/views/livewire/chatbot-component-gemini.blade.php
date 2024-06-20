<div>
    <div
        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
        <div class="flex flex-col justify-center">
            <x-application-logo class="block h-10 w-auto" />
            <p class="font-medium text-gray-500 text-center mt-2 italic">
                Ayo Coba HR Chatbot-nya. (Gemini API)
            </p>
        </div>

        @foreach ($responses as $key => $response)
            @if (isset($userInputs[$key]))
                <div class="p-1 my-2">
                    <div class="border rounded-lg bg-gray-100 overflow-hidden mt-2 shadow-sm sm:rounded-lg">
                        <div class="p-2 text-end">
                            {{ Auth::user()->name }} <br>
                            <hr>
                            {{ $userInputs[$key] }}
                        </div>
                    </div>
                    <div class="border rounded-lg bg-gray-100 overflow-hidden mt-2 shadow-sm sm:rounded-lg">
                        <div class="p-2 text-start">
                            Deon <br>
                            <hr> {!! $response !!}
                        </div>
                    </div>
                </div>
            @endif
        @endforeach

        <div class="flex justify-center my-5">
            <x-button wire:click="clearChat">{{ __('Hapus Chat') }}
            </x-button>
        </div>
    </div>
    <div class="fixed bottom-0 left-0 mb-8 w-full">
        <form class="flex justify-center w-full" wire:submit.prevent="chat">
            <input
                class="w-1/2 shadow appearance-none border rounded py-2 px-3 mr-2 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                type="text" wire:model.defer="message" wire:loading.class="opacity-20" wire:target="chat"
                placeholder="Chat dengan BOT lalu tekan enter atau klik tombol kirim">
            <x-secondary-button type="submit">{{ __('Kirim') }}</x-secondary-button>
        </form>
    </div>
</div>
