<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Request; 


class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected function redirectTo()
    {
        // Redirige al login si el usuario no está autenticado
        if (!Auth::check()) {
            return '/login';
        }

        // Si el usuario está autenticado, redirigirlo al panel
        return '/home';
    }
    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with([
            'token' => $token,
            'email' => $request->email,
        ]);
}
}
