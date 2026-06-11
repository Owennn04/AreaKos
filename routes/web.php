<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Kos;

Route::get('/', function () {
    $kos = Kos::latest()->get();
    
    return view('welcome', compact('kos'));
});

Route::get('/dashboard', function () {
    $kos = \App\Models\Kos::where('user_id', auth()->id())->latest()->get();
    
    return view('dashboard', compact('kos'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

use App\Http\Controllers\KosController;

// Rute yang hanya bisa diakses jika user sudah login
Route::middleware(['auth'])->group(function () {
    Route::get('/kos/tambah', [KosController::class, 'create'])->name('kos.create');
    Route::post('/kos/simpan', [KosController::class, 'store'])->name('kos.store');
    Route::get('/kos/{kos}/edit', [KosController::class, 'edit'])->name('kos.edit');
    Route::put('/kos/{kos}', [KosController::class, 'update'])->name('kos.update');
    Route::delete('/kos/{kos}', [KosController::class, 'destroy'])->name('kos.destroy');
});
require __DIR__.'/auth.php';
