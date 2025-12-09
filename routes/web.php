<?php

use App\Http\Controllers\PdfController;
use App\Http\Controllers\Profile\PasswordChangeController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
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


// Route::get('/generate-pdf', [PdfController::class, 'generate'])->name('pdf.generate');

require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
