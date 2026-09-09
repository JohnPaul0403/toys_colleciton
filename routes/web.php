<?php

use App\Http\Controllers\Admin\AdminToysController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\ContactPageController;
use App\Http\Controllers\ToysController;
use Illuminate\Support\Facades\Route;

Route::get('/', MainPageController::class)->name('home');
Route::get('/contact', ContactPageController::class)->name('contact');
Route::get('/toys', [ToysController::class, 'index'])->name('toys');
Route::get('/toys/{id}', [ToysController::class, 'show'])->name('toy');

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin')->group(function () {
    Route::resource('toys', AdminToysController::class)->except(['index']);
});

Route::get('/dashboard', [AdminToysController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
