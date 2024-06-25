<?php

use App\Livewire\SickVacationLeaveManagement;
use App\Livewire\TaskManagement;
use App\Livewire\UsersManagement;
use App\Livewire\SystemInstruction;
use App\Livewire\EmployeeManagement;
use Illuminate\Support\Facades\Route;
use App\Livewire\AttendanceManagement;
use App\Livewire\DepartmentManagement;
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

    Route::group(['prefix' => 'crud'], function () {
        Route::group(['prefix' => 'system-instruction'], function () {
           Route::get('/', [SystemInstruction::class, 'render'])->name('system-instruction.index');
        });
        Route::group(['prefix' => 'users-management'], function () {
            Route::get('/', [UsersManagement::class, 'render'])->name('users-management.index');
        });
        Route::group(['prefix' => 'employees-management'], function () {
            Route::get('/', [EmployeeManagement::class, 'render'])->name('employees-management.index');
        });
        Route::group(['prefix' => 'department-management'], function () {
           Route::get('/', [DepartmentManagement::class, 'render'])->name('department-management.index'); 
        });
        Route::group(['prefix' => 'department-tasks-management'], function () {
           Route::get('/', [TaskManagement::class, 'render'])->name('department-tasks-management.index'); 
        });
        Route::group(['prefix' => 'attendance-management'], function () {
            Route::get('/', [AttendanceManagement::class, 'render'])->name('attendance-management.index');
        });
        Route::group(['prefix' => 'leave-management'], function () {
           Route::get('/', [SickVacationLeaveManagement::class, 'render'])->name('leave-management.index'); 
        });
    });

    Route::post('/chatbot-2/session', [ChatController::class, 'createSession']);
    Route::post('/chatbot-2/message', [ChatController::class, 'addMessage']);
    Route::get('/chatbot-2/session/{id}/messages', [ChatController::class, 'getSessionMessages']);
});
