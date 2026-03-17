<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Inertia\Inertia;
use Inertia\Response;

class PasswordController extends Controller
{
    /**
     * Show the user's password settings page.
     */
    public function edit(): Response
    {
        return Inertia::render('settings/password');
    }

    /**
     * Update the user's password.
     */
    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back();
    }
    public function forceUpdate(Request $request): RedirectResponse
    {
        // dd($request->all());
        // 1. Validación sin 'current_password'
        $validated = $request->validate([
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);
        // dd($validated);
        // dd($request->user());
        // 2. Actualización del usuario
        $codecompany = $request->user()->code_company; // Obtener el company_code del usuario autenticado
        // dd($codecompany);


        $request->user()->forceFill([
            // 'password' => Hash::make($validated['password']),
            'password' => Hash::make($codecompany . $validated['password']),
            'password_changed_at' => now(), // ¡Seguimos marcando que ya la cambió!
        ])->save();

        // 3. Redirección al dashboard
        return redirect()->route('dashboard');
    }
}
