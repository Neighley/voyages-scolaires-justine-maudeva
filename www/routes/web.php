<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VoyageController; 
use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $user = Auth::user();
    $inscriptions = collect();
    $mesVoyages = collect();

    if ($user->role === 'eleve') {
        $inscriptions = \App\Models\Voyage::whereHas('participants', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();
    } elseif (in_array($user->role, ['enseignant', 'admin'])) {
        $mesVoyages = \App\Models\Voyage::where('user_id', $user->id)->get();
    }

    return view('dashboard', compact('inscriptions', 'mesVoyages'));
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