<?php

use App\Http\Controllers\PdfController;
use App\Http\Controllers\Profile\PasswordChangeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// Route::get('/', function () {
//     return Inertia::render('welcome');
// })->name('home');

//página de login.
Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
    Route::get('/session/ping', function () {
        return response()->json(['status' => 'session extended']);
    })->name('session.ping');
});

Route::middleware(['auth'])->group(function () {
    Route::post('/notifications/{alert}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::put('/notifications/{alert}/archive', [NotificationController::class, 'archive'])->name('notifications.archive');
    Route::put('/notifications/{alert}/unarchive', [NotificationController::class, 'unarchive'])->name('notifications.unarchive');
    Route::delete('/notifications/{alert}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/notifications/history', [NotificationController::class, 'getHistory'])->name('notifications.history');
});


// Route::get('/generate-pdf', [PdfController::class, 'generate'])->name('pdf.generate');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
