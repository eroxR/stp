<?php

use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\Settings\PasswordController;
use App\Http\Controllers\Settings\ProfileController;
use App\Models\Company;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware('auth')->group(function () {
    Route::redirect('settings', '/settings/profile');

    Route::get('settings/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('settings/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('settings/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('settings/password', [PasswordController::class, 'edit'])->name('password.edit');

    Route::put('settings/password', [PasswordController::class, 'update'])
        ->middleware('throttle:6,1')
        ->name('password.update');

    Route::get('settings/appearance', function () {
        return Inertia::render('settings/appearance');
    })->name('appearance');

    Route::put('/password/force-update', [PasswordController::class, 'forceUpdate'])->name('password.force-update');

    Route::get('/settings/permissions', [PermissionController::class, 'index'])->name('permissions');
    // Route::post('/permissions', [PermissionController::class, 'store'])->name('manage.permissions');
    Route::post('/settings/permissions/toggle', [PermissionController::class, 'togglePermission'])->name('permissions.toggle');
    Route::post('/settings/permissions/sync', [PermissionController::class, 'syncPermissions'])->name('permissions.sync');
    Route::post('/settings/permissions/copy', [PermissionController::class, 'copyPermissions'])->name('permissions.copy');

    Route::get('/settings/company-info', [CompanyController::class, 'index'])->name('companyInfo');
    Route::put('/settings/company-info', [CompanyController::class, 'update'])->name('company.update');
});
