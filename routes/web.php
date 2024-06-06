<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/chatbot', function () {
        return view('livewire.chatbot-page');
    })->name('chatbot');
    Route::get('/chatbot-2', function () {
        return view('livewire.chatbot-page');
    })->name('chatbot-2');
});
