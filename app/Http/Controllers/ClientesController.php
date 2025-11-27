<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

/**
 * Controlador de Clientes
 * 
 * Fecha de modificación: 2024-12-19
 * Cambio: Agregado filtro por user_id para aislamiento de datos
 * Por qué: Cada usuario debe ver solo sus propios clientes
 */
class clientesController extends Controller
{
    public function index(){
        $userId = Auth::id();
        $sql = DB::select("SELECT * FROM clientes WHERE user_id = ?", [$userId]);
        return view("clientes")->with('clientes', $sql);
    }

    public function create(Request $request){
        // Validaciones según esquema SQL
        $request->validate([
            'txtnombre' => 'required|string|max:250',
            'txtidentificacion' => 'required|integer|min:1|max:2147483647|unique:clientes,identificacion',
            'txtemail' => 'required|email|max:250',
            'txttelefono' => 'required|numeric|digits_between:7,15',
        ], [
            'txtnombre.required' => 'El nombre es requerido',
            'txtnombre.max' => 'El nombre no puede exceder 250 caracteres',
            'txtidentificacion.required' => 'La identificación es requerida',
            'txtidentificacion.integer' => 'La identificación debe ser un número entero',
            'txtidentificacion.unique' => 'Esta identificación ya está registrada',
            'txtemail.required' => 'El correo electrónico es requerido',
            'txtemail.email' => 'Ingrese un correo electrónico válido',
            'txtemail.max' => 'El correo no puede exceder 250 caracteres',
            'txttelefono.required' => 'El teléfono es requerido',
            'txttelefono.numeric' => 'El teléfono debe contener solo números',
            'txttelefono.digits_between' => 'El teléfono debe tener entre 7 y 15 dígitos',
        ]);

        $userId = Auth::id();
        
        $sql = DB::insert("INSERT INTO clientes (nombre, identificacion, email, telefono, user_id) VALUES (?,?,?,?,?)",[
           $request["txtnombre"],
           $request["txtidentificacion"],
           $request["txtemail"],
           $request["txttelefono"],
           $userId,
        ]);
        
        if($sql){
            return back()->with("Correcto","El cliente ha registrado correctamente");
        }else{
            return back()->with("Incorrecto","Error al registrar cliente");
        }
    }

    public function update(Request $request){
        // Validaciones según esquema SQL
        $request->validate([
            'txtnombre' => 'required|string|max:250',
            'txtidentificacion' => 'required|integer|min:1|max:2147483647|unique:clientes,identificacion,'.$request["txtid"],
            'txtemail' => 'required|email|max:250',
            'txttelefono' => 'required|numeric|digits_between:7,15',
        ], [
            'txtnombre.required' => 'El nombre es requerido',
            'txtnombre.max' => 'El nombre no puede exceder 250 caracteres',
            'txtidentificacion.required' => 'La identificación es requerida',
            'txtidentificacion.integer' => 'La identificación debe ser un número entero',
            'txtidentificacion.unique' => 'Esta identificación ya está registrada',
            'txtemail.required' => 'El correo electrónico es requerido',
            'txtemail.email' => 'Ingrese un correo electrónico válido',
            'txttelefono.required' => 'El teléfono es requerido',
            'txttelefono.digits_between' => 'El teléfono debe tener entre 7 y 15 dígitos',
        ]);

        $userId = Auth::id();
        
        $sql = DB::update("UPDATE clientes SET
            nombre = ?,
            identificacion = ?,
            email = ?,
            telefono = ?
            WHERE id = ? AND user_id = ?",
            [
                $request["txtnombre"],
                $request["txtidentificacion"],
                $request["txtemail"],
                $request["txttelefono"],
                $request["txtid"],
                $userId,
            ]
        );

        if ($sql) {
            return back()->with("Correcto", "Cliente ha sido actualizado correctamente");
        } else {
            return back()->with("Incorrecto", "Error al actualizar el cliente");
        }
    }

    public function delete($id){
        $userId = Auth::id();
        $sql = DB::delete("DELETE FROM clientes WHERE id = ? AND user_id = ?", [$id, $userId]);

        if ($sql) {
            return back()->with("Correcto", "Cliente ha sido retirado correctamente");
        } else {
            return back()->with("Incorrecto", "Error al retirar el cliente");
        }
    }

    public function OrdenarClientes(Request $request) {
        $ordenarPor = $request->input('ordenarPor', 'id');
        $userId = Auth::id();

        $tablaClientes = DB::table('clientes')->where('user_id', $userId);

        if ($ordenarPor === 'id') {
            $tablaClientes->orderBy('id', 'ASC');
        } elseif ($ordenarPor === 'nombre') {
            $tablaClientes->orderBy('nombre', 'ASC');
        } elseif ($ordenarPor === 'email') {
            $tablaClientes->orderBy('email', 'ASC');
        }

        $clientesOrdenados = $tablaClientes->get();

        return view('clientes')->with('clientes', $clientesOrdenados);
    }
    
    public function CambiarEstadoCliente($id){
        $userId = Auth::id();
        $sql = DB::table('clientes')
            ->where('id', $id)
            ->where('user_id', $userId)
            ->first();

        if($sql){
            $nuevoEstado = $sql->estado == 1 ? 0 : 1;
            DB::table('clientes')
                ->where('id', $id)
                ->where('user_id', $userId)
                ->update(['estado' => $nuevoEstado]);
            return back()->with('success', 'Estado cambiado exitosamente');
        }
        return back()->with('error', 'Cliente no encontrado');
    }
}

