<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador de Proveedores
 * 
 * Fecha de modificación: 2024-12-19
 * Cambio: Agregado filtro por user_id para aislamiento de datos
 * Por qué: Cada usuario debe ver solo sus propios proveedores
 */
class AdminProveedoresController extends Controller
{
    public function index(){
        $userId = Auth::id();
        $datos = DB::select("SELECT * FROM proveedores WHERE user_id = ?", [$userId]);
        return view("AdminProveedoresView")->with("datos", $datos);
    }

    public function create(Request $request){
        // Validaciones según esquema SQL
        $request->validate([
            'txtnombre' => 'required|string|max:250',
            'txtdireccion' => 'required|string|max:250',
            'txttelefono' => 'required|string|max:250',
        ], [
            'txtnombre.required' => 'El nombre del proveedor es requerido',
            'txtnombre.max' => 'El nombre no puede exceder 250 caracteres',
            'txtdireccion.required' => 'La dirección es requerida',
            'txtdireccion.max' => 'La dirección no puede exceder 250 caracteres',
            'txttelefono.required' => 'El teléfono es requerido',
            'txttelefono.max' => 'El teléfono no puede exceder 250 caracteres',
        ]);

        $userId = Auth::id();
        
        $sql = DB::insert("INSERT INTO proveedores (nombre, direccion, telefono, user_id) VALUES (?, ?, ?, ?)", [
            $request['txtnombre'],
            $request['txtdireccion'],
            $request['txttelefono'],
            $userId,
        ]);

        if ($sql == true){
            return back()->with("Correcto","Proveedor registrado correctamente");
        }else{
            return back()->with("Incorrecto","Error al registrar");
        }
    }

    public function update(Request $request){
        // Validaciones según esquema SQL
        $request->validate([
            'txtnombre' => 'required|string|max:250',
            'txtdireccion' => 'required|string|max:250',
            'txttelefono' => 'required|string|max:250',
        ], [
            'txtnombre.required' => 'El nombre del proveedor es requerido',
            'txtnombre.max' => 'El nombre no puede exceder 250 caracteres',
            'txtdireccion.required' => 'La dirección es requerida',
            'txtdireccion.max' => 'La dirección no puede exceder 250 caracteres',
            'txttelefono.required' => 'El teléfono es requerido',
            'txttelefono.max' => 'El teléfono no puede exceder 250 caracteres',
        ]);

        $userId = Auth::id();
        
        $sql = DB::update("UPDATE proveedores SET
            nombre = ?,
            direccion = ?,
            telefono = ?
            WHERE id = ? AND user_id = ?",
            [
                $request['txtnombre'],
                $request['txtdireccion'],
                $request['txttelefono'],
                $request['txtid'],
                $userId
            ]);

        if ($sql == true){
            return back()->with("Correcto","Proveedor ha sido actualizado correctamente");
        } else {
            return back()->with("Incorrecto","Error al actualizar el proveedor");
        }
    }
    
    public function delete($id){
        $userId = Auth::id();
        $sql = DB::delete("DELETE FROM proveedores WHERE id = ? AND user_id = ?", [$id, $userId]);

        if ($sql == true){
            return back()->with("Correcto","Proveedor ha sido retirado correctamente");
        } else {
            return back()->with("Incorrecto","Error al retirar el proveedor");
        }
    }

    public function cambiarEstado($id) {
        $userId = Auth::id();
        $proveedor = DB::table('proveedores')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if ($proveedor) {
            $nuevoEstado = $proveedor->estado == 1 ? 0 : 1;

            DB::table('proveedores')
                ->where('id', $id)
                ->where('user_id', $userId)
                ->update(['estado' => $nuevoEstado]);

            return back()->with('success', 'Estado cambiado exitosamente');
        }

        return back()->with('error', 'Proveedor no encontrado');
    }
}




