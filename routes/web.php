<?php

use App\Http\Controllers\Admin\AdminToysController;
use App\Http\Controllers\ToysController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ToysController::class, 'index'])->name('home');
Route::get('/toys/{id}', [ToysController::class, 'show'])->name('toy');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin')->group(function () {
    Route::resource('toys', AdminToysController::class)->except(['index']);
});

Route::get('/dashboard', [AdminToysController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
