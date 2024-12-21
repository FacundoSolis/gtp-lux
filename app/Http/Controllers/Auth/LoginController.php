<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | Este controlador maneja la autenticación de los usuarios y
    | redirige a la pantalla de inicio después de iniciar sesión.
    | Usa un trait para proporcionar esta funcionalidad.
    |
    */

    use AuthenticatesUsers;

    /**
     * Dónde redirigir a los usuarios después del login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Crea una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Manejar el logout del usuario autenticado.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout(); // Cerrar sesión
        $request->session()->invalidate(); // Invalidar la sesión actual
        $request->session()->regenerateToken(); // Regenerar el token CSRF

        return redirect('/login');
    }
}