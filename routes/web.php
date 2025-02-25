<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\Backend\ChatController;
use App\Http\Controllers\Web\Backend\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth', 'verified');

Route::get('/dashboard/chat/{id}', [ChatController::class, 'index'])->name('dashboard.chat')->middleware('auth', 'verified');

Route::post('/dashboard/chat/send/{id}', [ChatController::class, 'send'])->name('send')->middleware('auth', 'verified');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
