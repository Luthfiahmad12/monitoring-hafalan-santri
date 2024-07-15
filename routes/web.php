<?php

use App\Http\Controllers\HafalanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SantriController;
use App\Http\Controllers\SurahController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('santri', SantriController::class);
    Route::resource('surah', SurahController::class);
    Route::resource('hafalan', HafalanController::class);
    Route::post('/ustadz', [SantriController::class, 'addUstadz'])->name('ustadz.store');
    Route::post('/updateUstadz/{id}', [SantriController::class, 'updateUstadz'])->name('updateUstadz');
    Route::post('/destroyUstadz/{id}', [SantriController::class, 'destroyUstadz'])->name('destroyUstadz');
});

require __DIR__ . '/auth.php';
