<?php

use App\Http\Controllers\DirectionController;
use App\Http\Controllers\EntiteController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('Entite', EntiteController::class);
    Route::resource('Poste', PosteController::class);
    Route::resource('Direction', DirectionController::class);
    Route::resource('Equipement', EquipementController::class);
});

require __DIR__.'/auth.php';
