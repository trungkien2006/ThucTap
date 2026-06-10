<?php

use App\Http\Controllers\PublicEventController;
use App\Http\Controllers\PublicRegistrationController;
use App\Http\Controllers\Admin\CheckInController;

Route::get('/', [PublicEventController::class, 'index'])->name('home');
Route::get('/events/{slug}', [PublicEventController::class, 'show'])->name('events.show');
Route::post('/events/{event}/register', [PublicRegistrationController::class, 'store'])->name('events.register');
Route::get('/register/confirm/{token}', [PublicRegistrationController::class, 'confirm'])->name('register.confirm');

Route::get('/dashboard', function () {
    return redirect()->route('admin.events.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('events', App\Http\Controllers\Admin\EventController::class);
    Route::get('/checkin/{token}', [CheckInController::class, 'scan'])->name('checkin');
});

require __DIR__.'/auth.php';
