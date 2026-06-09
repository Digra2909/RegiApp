<?php

use App\Http\Controllers\EntiteController;
use App\Http\Controllers\EquipementController;
use App\Http\Controllers\PosteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('Entite', EntiteController::class);
Route::resource('Poste', PosteController::class);
Route::resource('Equipement', EquipementController::class);
