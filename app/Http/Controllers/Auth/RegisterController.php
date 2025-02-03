<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request; // Asegúrate de importar Request
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Donde redirigir al usuario después del registro.
     * Lo cambiaremos para redirigir al login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Crea una nueva instancia del controlador.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Valida la solicitud de registro.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Crea un nuevo usuario después de una validación exitosa.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
            // Asegúrate de asignar un rol por defecto, por ejemplo:
            // 'role' => 'user',
        ]);
    }

    /**
     * Este método se llama después de que el usuario se registra.
     * Lo sobrescribimos para que, en lugar de iniciar sesión automáticamente,
     * se redirija al formulario de login.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $user
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function registered(Request $request, $user)
    {
        // En caso de que el trait haya iniciado sesión automáticamente, lo cerramos.
        // O simplemente evitamos iniciar sesión de forma automática.
        auth()->logout();

        // Redirige a la página de login con un mensaje de éxito.
        return redirect('/login')->with('status', 'Registration successful. Please log in.');
    }
}
