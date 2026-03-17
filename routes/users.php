<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::middleware(['auth'])->group(function () {
    Route::get('/humanResources/users/employees', [UserController::class, 'employees'])->name('employees');
    Route::put('/humanResources/users/employees/{user}', [UserController::class, 'updateEmployees'])->name('users.updateEmployees');
});
