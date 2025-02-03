<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    use ResetsPasswords {
        // Sobrescribimos resetPassword para evitar iniciar sesión automáticamente.
        resetPassword as traitResetPassword;
    }

    /**
     * Actualiza la contraseña sin iniciar sesión automáticamente.
     *
     * @param  \App\Models\User  $user
     * @param  string  $password
     * @return void
     */
    protected function resetPassword($user, $password)
    {
        $user->forceFill([
            'password' => Hash::make($password),
            'remember_token' => Str::random(60),
        ])->save();

        // No se llama a Auth::login($user), por lo que el usuario no se autentica automáticamente.
    }

    /**
     * Redirige al usuario tras restablecer la contraseña.
     *
     * @return string
     */
    protected function redirectTo()
    {
        return '/login';
    }

    /**
     * Muestra el formulario de restablecimiento de contraseña.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\View\View
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
    }
}
