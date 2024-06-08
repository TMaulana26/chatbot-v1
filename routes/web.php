<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\SystemInstuctionCRUD;
use App\Http\Controllers\ChatController;

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

    Route::group(['prefix' => 'system-instruction'], function () {
       Route::get('/index', [SystemInstuctionCRUD::class, 'render'])->name('system-instruction.index'); 
    });


    Route::post('/chatbot-2/session', [ChatController::class, 'createSession']);
    Route::post('/chatbot-2/message', [ChatController::class, 'addMessage']);
    Route::get('/chatbot-2/session/{id}/messages', [ChatController::class, 'getSessionMessages']);
});
