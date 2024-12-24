<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Mostrar el formulario de inicio de sesión.
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Procesar el inicio de sesión.
     */
    public function login(Request $request)
    {
        // Validar las credenciales de inicio de sesión
        $this->validateLogin($request);

        // Intentar iniciar sesión con las credenciales proporcionadas
        if (Auth::attempt($request->only('email', 'password'))) {
            // Redirigir al usuario a la página principal o dashboard
            return redirect()->route('dashboard.index');
        }

        // Si las credenciales son incorrectas, mostrar un mensaje de error
        return redirect()->back()->withErrors(['email' => 'Credenciales incorrectas.']);
    }

    /**
     * Validar el formulario de inicio de sesión.
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string'],
        ]);
    }

    /**
     * Cerrar sesión.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
