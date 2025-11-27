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
     * Fecha: 2024-12-19
     * Cambio: Agregada regeneración de sesión para prevenir session fixation y asegurar aislamiento de datos
     * Por qué: Previene que un usuario vea datos de sesiones anteriores y mejora la seguridad
     */
    public function login(Request $request)
    {
        // Validar las credenciales de inicio de sesión
        $this->validateLogin($request);

        // Intentar iniciar sesión con las credenciales proporcionadas
        if (Auth::attempt($request->only('email', 'password'))) {
            // Regenerar el ID de sesión para prevenir session fixation attacks
            // Esto asegura que cada usuario tenga su propia sesión aislada
            $request->session()->regenerate();
            
            // Limpiar cualquier dato de sesión previo que pueda existir
            $request->session()->forget(['previous_user_data', 'temp_data']);
            
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
     * Fecha: 2024-12-19
     * Cambio: Mejorado para invalidar completamente la sesión y limpiar todos los datos
     * Por qué: Asegura que ningún dato de sesión persista después del logout
     */
    public function logout(Request $request)
    {
        // Invalidar completamente la sesión
        Auth::logout();
        
        // Invalidar la sesión actual y regenerar el token CSRF
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/login');
    }
}
