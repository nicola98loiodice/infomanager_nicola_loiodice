<?php

use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'homepage'])->name('homepage');
Route::middleware(['auth'])->group(function () {
    Route::get('/profilo', [UserController::class, 'show'])->name('profile.show');
});