<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');

// rotta per la vista show
Route::middleware(['auth'])->group(function () {
    Route::get('/profilo', [UserController::class, 'show'])->name('profile.show');
});


// rotte per il controllo turni
Route::middleware('auth')->group(function () {
    Route::get('/firma-turno', [ShiftController::class, 'create'])->name('shifts.create');
    Route::post('/firma-turno', [ShiftController::class, 'store'])->name('shifts.store');
});