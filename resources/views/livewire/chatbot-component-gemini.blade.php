<div>
    <div
        class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-600/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700 rounded-3xl">
        <div class="flex flex-col justify-center">
            <x-sidebar-logo class="block h-20 w-auto" />
            <p class="font-medium text-gray-500 text-center mt-2 italic">
                Ayo Coba HR Chatbot-nya. (Gemini API)
            </p>
        </div>
        <div class="space-y-4 max-w-5xl mx-auto dark:bg-gray-700 p-4 rounded-xl mt-4 mb-24">
            @if (empty($userInputs))
                <div class="text-center text-gray-400 dark:text-gray-300 py-8">
                    <p class="text-xl font-semibold">Silakan Mulai Chat</p>
                    <p class="mt-2">Tanyakan apa saja kepada DEON, asisten HR virtual Anda</p>
                </div>
            @endif

            @foreach ($responses as $key => $response)
                @if (isset($userInputs[$key]))
                    <div x-init="hasMessages = true" class="flex flex-col space-y-2">
                        <div class="self-end max-w-[90%]">
                            <div class="bg-gray-600 text-white p-3 rounded-lg rounded-br-none shadow">
                                <p class="text-sm font-semibold mb-1">{{ Auth::user()->name }}</p>
                                <p>{{ $userInputs[$key] }}</p>
                            </div>
                        </div>
                        <div class="self-start max-w-[80%]">
                            <div class="bg-gray-200 dark:bg-gray-800 p-3 rounded-lg rounded-bl-none shadow">
                                <p class="text-sm font-semibold mb-1 text-gray-600 dark:text-gray-300">Deon</p>
                                <div class="text-gray-800 dark:text-gray-200">{!! $response !!}</div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>

        <livewire:apply-sick-modal />
    </div>

    <div class="fixed bottom-0 left-0 w-full p-4 bg-gray-900">
        <div class="flex justify-center items-center w-full max-w-3xl mx-auto">
            <button wire:click="clearChat"
                class="mr-4 bg-gray-500 hover:bg-gray-300 text-white rounded-full p-2 transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-gray-900 focus:ring-opacity-50 px-3"
                title="Hapus Chat">
                <i class="fas fa-trash-alt"></i>
            </button>
            <form class="flex-grow" wire:submit.prevent="chat">
                <div class="relative w-full">
                    <input
                        class="w-full bg-gray-800 text-white rounded-full py-3 px-12 pr-16 leading-tight focus:outline-none focus:ring-2 focus:ring-blue-500"
                        type="text" wire:model.defer="message" wire:loading.class="opacity-50" wire:target="chat"
                        placeholder="Chat dengan DEON lalu tekan enter atau klik tombol kirim">
                    <div class="absolute inset-y-0 left-3 flex items-center">
                        <i class="fas fa-robot text-gray-400"></i>
                    </div>
                    <button type="submit" class="absolute inset-y-0 right-3 flex items-center"
                        wire:loading.attr="disabled" wire:target="chat">
                        <svg class="h-6 w-6 text-gray-400 hover:text-white transition-colors" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                </div>
            </form>
        </div>
        <div class="text-xs text-center text-gray-300" x-data="{ showCommands: false }">
            <p class="mb-1 mt-3 cursor-pointer" @click="showCommands = !showCommands">
                Perintah yang bisa di gunakan:
                <span x-show="showCommands">▼</span>
                <span x-show="!showCommands">▶</span>
            </p>
            <div x-show="showCommands" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform scale-95"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-95">
                <p class="space-x-2">
                    <span class="bg-gray-800 px-2 py-1 rounded inline-block relative group cursor-help">
                        /clear
                        <span
                            class="absolute bottom-full left-1/2 transform -translate-x-1/2 bg-black text-white px-2 py-1 rounded text-xs whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none mb-1">
                            Memulai chat baru
                        </span>
                    </span>
                    <span class="bg-gray-800 px-2 py-1 rounded inline-block relative group cursor-help">
                        /masuk
                        <span
                            class="absolute bottom-full left-1/2 transform -translate-x-1/2 bg-black text-white px-2 py-1 rounded text-xs whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none mb-1">
                            Absen masuk
                        </span>
                    </span>
                    <span class="bg-gray-800 px-2 py-1 rounded inline-block relative group cursor-help">
                        /keluar
                        <span
                            class="absolute bottom-full left-1/2 transform -translate-x-1/2 bg-black text-white px-2 py-1 rounded text-xs whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none mb-1">
                            Absen keluar
                        </span>
                    </span>
                    <span class="bg-gray-800 px-2 py-1 rounded inline-block relative group cursor-help">
                        /sakit
                        <span
                            class="absolute bottom-full left-1/2 transform -translate-x-1/2 bg-black text-white px-2 py-1 rounded text-xs whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none mb-1">
                            Pengajuan izin sakit
                        </span>
                    </span>
                    <span class="bg-gray-800 px-2 py-1 rounded inline-block relative group cursor-help">
                        /cuti
                        <span
                            class="absolute bottom-full left-1/2 transform -translate-x-1/2 bg-black text-white px-2 py-1 rounded text-xs whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none mb-1">
                            Pengajuan izin cuti
                        </span>
                    </span>
                </p>
            </div>
        </div>
    </div>
    @error('message')
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-90"
            class="fixed bottom-32 left-1/2 transform -translate-x-1/2 bg-red-500 text-white px-4 py-2 rounded shadow-lg">
            {{ $message }}
        </div>
    @enderror
</div>
