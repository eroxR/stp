<?php

namespace App\Http\Requests\Auth;

use App\Models\Company;
use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @throws \Illuminate\Validation\ValidationException
     */

    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $loginInput = $this->input('email'); // Sigue siendo 'email' por el nombre del campo del form

        // Determina el método de login y busca al usuario
        $isEmailLogin = filter_var($loginInput, FILTER_VALIDATE_EMAIL);
        $user = null;

        if ($isEmailLogin) {
            // Búsqueda por email
            $user = User::where('email', $loginInput)->first();
        } else {
            // Búsqueda por username (con lógica de empresa)
            preg_match('/^([0-9]+)/', $loginInput, $matches);
            if (isset($matches[1])) {
                $companyCode = $matches[1];
                $company = Company::where('code_company', $companyCode)->first();
                if ($company) {
                    $user = User::where('username', $loginInput)->where('company_id', $company->id)->first();
                }
            } else {
                // Permite buscar por username sin código de empresa (ej. Super Usuario)
                $user = User::where('username', $loginInput)->first();
            }
        }

        // $loginInput = $this->input('email');
        // $credentials = [];
        // $companyFound = true; // Asumimos que la empresa se encontrará

        // if (filter_var($loginInput, FILTER_VALIDATE_EMAIL)) {
        //     // --- Login por EMAIL ---
        //     $credentials = ['email' => $loginInput, 'password' => $this->input('password')];
        // } else {
        //     // --- Login por USERNAME ---
        //     preg_match('/^([0-9]+)/', $loginInput, $matches);

        //     if (isset($matches[1])) {
        //         $companyCode = $matches[1];
        //         $company = Company::where('code_company', $companyCode)->first();

        //         if ($company) {
        //             $credentials = [
        //                 'username' => $loginInput,
        //                 'password' => $this->input('password'),
        //                 'company_id' => $company->id, // ¡Filtro clave para multi-empresa!
        //             ];
        //         } else {
        //             $companyFound = false; // Marcamos que la empresa no se encontró
        //         }
        //     } else {
        //         // Si el username no tiene un prefijo numérico, intentamos un login normal por username.
        //         // Esto permite que un superadmin sin código de empresa pueda entrar.
        //         $credentials = ['username' => $loginInput, 'password' => $this->input('password')];
        //     }
        // }

        // --- LÓGICA DE VALIDACIÓN Y AUTENTICACIÓN ---

        // Si la empresa no se encontró, lanzamos un error inmediatamente.
        // if (!$companyFound) {
        //     throw ValidationException::withMessages([
        //         'email' => 'El código de la empresa en el nombre de usuario no es válido.',
        //     ]);
        // }

        // // Intentamos autenticar con las credenciales que construimos.
        // if (!Auth::attempt($credentials)) {
        //     RateLimiter::hit($this->throttleKey());

        //     // Lanzamos el error estándar de "credenciales incorrectas".
        //     throw ValidationException::withMessages([
        //         'email' => trans('auth.failed'),
        //     ]);
        // }

        if (! $user || ! Hash::check($this->input('password'), $user->password)) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        // 2. ¿El usuario está intentando usar un método no permitido?
        if ($isEmailLogin && $user->type_access == 1) { // 1 = Solo Username
            throw ValidationException::withMessages([
                'email' => 'Esta cuenta solo permite el acceso con nombre de usuario.',
            ]);
        }
        if (! $isEmailLogin && $user->type_access == 2) { // 2 = Solo Email
            throw ValidationException::withMessages([
                'email' => 'Esta cuenta solo permite el acceso con correo electrónico.',
            ]);
        }

        Auth::login($user);

        RateLimiter::clear($this->throttleKey());
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     */
    public function throttleKey(): string
    {
        return $this->string('email')
            ->lower()
            ->append('|' . $this->ip())
            ->transliterate()
            ->value();
    }
}
