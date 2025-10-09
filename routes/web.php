<?php

use App\Http\Controllers\AdminShiftController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
// rotta per la vista show solo utenti registrati
Route::middleware(['auth'])->group(function () {
    Route::get('/profilo', [UserController::class, 'show'])->name('profile.show');
});


// rotte per il controllo turni
Route::middleware('auth')->group(function () {
    Route::get('/firma-turno', [ShiftController::class, 'create'])->name('shifts.create');
    Route::post('/firma-turno', [ShiftController::class, 'store'])->name('shifts.store');
    Route::get('/calendario',[ShiftController::class, 'calendario'])->name('shifts.index');
});


// rotte protette admin
Route::middleware([IsAdmin::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/shifts', [App\Http\Controllers\AdminShiftController::class, 'index'])->name('shifts.index');
        Route::post('/shifts', [App\Http\Controllers\AdminShiftController::class, 'store'])->name('shifts.store');
        Route::delete('/shifts/{shift}', [AdminShiftController::class, 'destroy'])->name('shifts.destroy');

    });