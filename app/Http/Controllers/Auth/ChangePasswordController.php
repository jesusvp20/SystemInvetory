<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

/**
 * Controlador para cambio de contraseña
 * 
 * Fecha de creación: 2024-12-19
 * 
 * Cambios realizados:
 * - Creado controlador completo para cambio de contraseña de usuarios autenticados
 * 
 * Por qué:
 * - Permite a los usuarios cambiar su contraseña de forma segura
 * - Valida que la contraseña actual sea correcta antes de permitir el cambio
 * - Aplica reglas de seguridad para contraseñas nuevas
 */
class ChangePasswordController extends Controller
{
    /**
     * Mostrar el formulario de cambio de contraseña.
     */
    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }

    /**
     * Procesar el cambio de contraseña.
     */
    public function changePassword(Request $request)
    {
        // Validar los datos del formulario
        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)->mixedCase()->numbers()->symbols()],
        ], [
            'current_password.required' => 'La contraseña actual es requerida.',
            'password.required' => 'La nueva contraseña es requerida.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
        ]);

        $user = Auth::user();

        // Verificar que la contraseña actual sea correcta
        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['La contraseña actual es incorrecta.'],
            ]);
        }

        // Verificar que la nueva contraseña sea diferente a la actual
        if (Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => ['La nueva contraseña debe ser diferente a la contraseña actual.'],
            ]);
        }

        // Actualizar la contraseña
        $user->password = Hash::make($request->password);
        $user->save();

        // Regenerar la sesión para aplicar los cambios
        $request->session()->regenerate();

        return redirect()->route('dashboard.index')
            ->with('success', 'Contraseña cambiada exitosamente.');
    }
}

