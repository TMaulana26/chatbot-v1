<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tutorial Video') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 lg:p-8 bg-white dark:bg-gray-800 dark:bg-gradient-to-bl dark:from-gray-700/50 dark:via-transparent border-b border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col justify-center mb-8">
                        <x-sidebar-logo class="block h-16 w-auto mx-auto" />
                        <p class="font-bold text-gray-500 text-center mt-2 italic">
                            Video Tutorial Penggunaan Chatbot
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Video Container -->
                        <div class="space-y-4">
                            <div class="aspect-w-16 aspect-h-9 bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                                <video class="w-full h-full object-cover" controls>
                                    <source src="{{ asset('videos/Intro.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                <h3 class="font-semibold text-lg mb-2 text-gray-800 dark:text-gray-200">Tutorial Penggunaan Chatbot</h3>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Video ini menjelaskan tata cara register user dan menjadi employee, untuk menggunakan chatbot. 
                                    Anda akan mempelajari bagaimana cara membuat akun dan menjadi employee untuk menggunakan chatbot,
                                    untuk membantu masalah HR dan kepegawaan employee.
                                </p>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="aspect-w-16 aspect-h-9 bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden">
                                <video class="w-full h-full object-cover" controls>
                                    <source src="{{ asset('videos/Commands.mp4') }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                            <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                                <h3 class="font-semibold text-lg mb-2 text-gray-800 dark:text-gray-200">Tutorial Penggunaan Chatbot</h3>
                                <p class="text-gray-600 dark:text-gray-300">
                                    Video ini menjelaskan tata cara menggunakan command pada sebuah input chat untuk sebuah chatbot. 
                                    Anda akan mempelajari berbagai perintah yang tersedia dan bagaimana menggunakannya secara efektif 
                                    untuk berinteraksi dengan chatbot.
                                </p>
                            </div>
                        </div>
                        <!-- Coming Soon Container -->
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden flex items-center justify-center">
                            <p class="text-2xl font-bold text-gray-600 dark:text-gray-300">Coming Soon</p>
                        </div>
                        <div class="aspect-w-16 aspect-h-9 bg-gray-200 dark:bg-gray-700 rounded-lg overflow-hidden flex items-center justify-center">
                            <p class="text-2xl font-bold text-gray-600 dark:text-gray-300">Coming Soon</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>