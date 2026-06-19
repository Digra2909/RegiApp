<?php

use App\Http\Controllers\DirectionController;
use App\Http\Controllers\EntiteController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\GlobalController;
use App\Http\Controllers\PosteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

// Provide a dashboard route used by navigation and redirects
Route::middleware(['auth', 'verified'])->get('/dashboard', function () {
    return redirect()->route('Equipement.index');
})->name('dashboard');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('Entite', EntiteController::class)->middleware('role:admin');
    Route::resource('Poste', PosteController::class)->middleware('role:admin');
    Route::resource('Direction', DirectionController::class)->middleware('role:admin');
    // Equipement: index available to admin and rapporteur, other actions only to admin
    Route::get('Equipement', [EquipementController::class, 'index'])->name('Equipement.index')->middleware('role:admin|rapporteur');
    Route::resource('Equipement', EquipementController::class)->except(['index'])->middleware('role:admin');

    // Global analytics view (access: admin and opérateur)
    Route::get('global', [GlobalController::class, 'index'])->name('global')->middleware('role:admin|operateur');

    // User management (settings) - only accessible by admins
    Route::middleware('role:admin')->group(function () {
        Route::get('settings/users', [UserController::class, 'index'])->name('settings.users.index');
        Route::get('settings/users/create', [UserController::class, 'create'])->name('settings.users.create');
        Route::post('settings/users', [UserController::class, 'store'])->name('settings.users.store');
        Route::get('settings/users/{user}/edit', [UserController::class, 'edit'])->name('settings.users.edit');
        Route::put('settings/users/{user}', [UserController::class, 'update'])->name('settings.users.update');
        Route::delete('settings/users/{user}', [UserController::class, 'destroy'])->name('settings.users.destroy');
    });
});

require __DIR__.'/auth.php';
