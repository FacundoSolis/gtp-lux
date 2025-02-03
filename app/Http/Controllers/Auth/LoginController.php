<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Validation\ValidatesRequests; // Trait para validación
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Mail\TwoFactorTokenMail;

class LoginController extends Controller
{
    // Usamos los traits para métodos auxiliares y validación.
    use AuthenticatesUsers, ValidatesRequests {
        login as traitLogin;
    }

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Sobrescribe el método validateLogin para usar el método validate() del controlador.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        // Usamos el método validate() proporcionado por el trait ValidatesRequests
        $this->validate($request, [
            $this->username() => 'required|string',
            'password'      => 'required|string',
        ]);
    }

    // Método login modificado para 2FA
    public function login(Request $request)
    {
        // Validar las credenciales
        $this->validateLogin($request);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return $this->sendLockoutResponse($request);
        }

        // Validar las credenciales sin iniciar sesión aún
        if (Auth::validate($this->credentials($request))) {
            // Obtener el usuario por email
            $user = \App\Models\User::where('email', $request->email)->first();

            // Generar un token numérico de 6 dígitos
            $token = random_int(100000, 999999);

            // Guardar el token (hasheado) y la fecha de expiración en el usuario
            $user->two_factor_token = Hash::make($token);
            $user->two_factor_expires_at = now()->addMinutes(10);
            $user->save();

            // Enviar el token por correo
            Mail::to($user->email)->send(new TwoFactorTokenMail($token));

            // Guardar el ID del usuario en la sesión para completar el 2FA
            $request->session()->put('pending_2fa', $user->id);

            // Incrementar intentos (como hace el trait)
            $this->incrementLoginAttempts($request);

            // Redirigir al formulario de verificación 2FA
            return redirect()->route('2fa');
        }

        // Si las credenciales son incorrectas
        $this->incrementLoginAttempts($request);
        return $this->sendFailedLoginResponse($request);
    }

    // Formulario de 2FA
    public function showTwoFactorForm()
    {
        // Si no hay usuario pendiente, redirige al login
        if (!session()->has('pending_2fa')) {
            return redirect()->route('login');
        }
        return view('auth.two-factor');
    }

    // Verificar el token ingresado y completar el login
    public function verifyTwoFactorToken(Request $request)
    {
        $this->validate($request, [
            'token' => 'required|string|size:6',
        ]);

        // Recuperar el ID del usuario pendiente de 2FA
        $userId = session('pending_2fa');
        if (!$userId) {
            return redirect()->route('login')->withErrors(['message' => 'Session expired. Please login again.']);
        }
        $user = \App\Models\User::find($userId);
        if (!$user) {
            return redirect()->route('login')->withErrors(['message' => 'User not found.']);
        }

        // Verificar que el token ingresado coincida y que no esté expirado
        if (Hash::check($request->token, $user->two_factor_token) && $user->two_factor_expires_at > now()) {
            // Limpiar los datos del token
            $user->two_factor_token = null;
            $user->two_factor_expires_at = null;
            $user->save();

            // Eliminar el flag de 2FA pendiente y loguear al usuario
            session()->forget('pending_2fa');
            Auth::login($user);

            return redirect()->intended($this->redirectPath());
        }

        return back()->withErrors(['token' => 'Invalid or expired token.']);
    }

    // Mostrar el formulario de login (personalizado)
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Método logout (sin cambios)
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
