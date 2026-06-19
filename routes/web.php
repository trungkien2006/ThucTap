<?php

use App\Http\Controllers\PublicEventController;
// use App\Http\Controllers\Admin\CheckInController;
use App\Http\Controllers\Admin\SpeakerController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\DocumentController;

use App\Http\Controllers\FrontendController;

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/events/{slug}', [PublicEventController::class, 'show'])->name('events.show');
Route::post('/events/{id}/like', [PublicEventController::class, 'like'])->name('events.like');

Route::get('/dashboard', function () {
    return redirect()->route('admin.events.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Events
    Route::resource('events', App\Http\Controllers\Admin\EventController::class);
    Route::get('events/{event}/design', [App\Http\Controllers\Admin\EventController::class, 'design'])->name('events.design');
    Route::post('events/{event}/save-design', [App\Http\Controllers\Admin\EventController::class, 'saveDesign'])->name('events.save_design');
    Route::post('events/upload-document', [App\Http\Controllers\Admin\EventController::class, 'uploadDocument'])->name('events.upload_document');
    Route::get('events/{event}/preview', [App\Http\Controllers\Admin\EventController::class, 'preview'])->name('events.preview');

    // Check-in
    // Route::get('/checkin/{token}', [CheckInController::class, 'scan'])->name('checkin');

    // Speakers
    Route::resource('speakers', SpeakerController::class);

    // Media
    Route::resource('media', MediaController::class)->only(['index', 'store', 'destroy']);

    // Documents
    Route::resource('documents', DocumentController::class)->only(['index', 'store', 'destroy']);
});

require __DIR__.'/auth.php';