<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

/**
 * Controlador para recuperar contraseña (sin email)
 * 
 * Fecha: 2024-12-19
 * Cambio: Sistema simple de recuperación de contraseña
 * Por qué: Permite recuperar contraseña sin necesidad de configurar SMTP
 */
class RecuperarContrasenaController extends Controller
{
    /**
     * Mostrar formulario para ingresar email
     */
    public function mostrarFormularioEmail()
    {
        return view('auth.recuperar-contrasena');
    }

    /**
     * Verificar si el email existe y mostrar formulario de nueva contraseña
     */
    public function verificarEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ], [
            'email.required' => 'El correo electrónico es requerido.',
            'email.email' => 'Ingrese un correo electrónico válido.',
        ]);

        // Verificar si el email existe
        $usuario = DB::table('users')->where('email', $request->email)->first();

        if (!$usuario) {
            return back()->withErrors(['email' => 'No existe una cuenta con este correo electrónico.']);
        }

        // Mostrar formulario para nueva contraseña
        return view('auth.nueva-contrasena', ['email' => $request->email]);
    }

    /**
     * Actualizar la contraseña
     */
    public function actualizarContrasena(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed',
        ], [
            'email.required' => 'El correo electrónico es requerido.',
            'password.required' => 'La contraseña es requerida.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
        ]);

        // Verificar que el email existe
        $usuario = DB::table('users')->where('email', $request->email)->first();

        if (!$usuario) {
            return back()->withErrors(['email' => 'No existe una cuenta con este correo electrónico.']);
        }

        // Actualizar contraseña
        DB::table('users')
            ->where('email', $request->email)
            ->update(['password' => Hash::make($request->password)]);

        return redirect()->route('login')
            ->with('success', 'Contraseña actualizada correctamente. Ya puedes iniciar sesión.');
    }
}

