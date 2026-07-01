<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoyageController; 
use App\Http\Controllers\ParticipantController;
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
    Route::resource('voyages', VoyageController::class);
    Route::post('/voyages/{voyage}/participants', [ParticipantController::class, 'store'])->name('voyages.participants.store');
    Route::patch('/participants/{participant}/autoriser', [ParticipantController::class, 'autoriser'])->name('participants.autoriser');
});

require __DIR__.'/auth.php';