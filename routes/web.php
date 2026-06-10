<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PublicEventController;

Route::get('/', [PublicEventController::class, 'index'])->name('home');
Route::get('/events/{slug}', [PublicEventController::class, 'show'])->name('events.show');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('events', App\Http\Controllers\Admin\EventController::class);
});

require __DIR__.'/auth.php';
