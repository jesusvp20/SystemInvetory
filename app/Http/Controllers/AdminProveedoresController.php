<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AdminProveedoresController extends Controller
{
    //Listar
    public function index(){
        $datos =DB::select(query: "select * from proveedores");
        return view("AdminProveedoresView")->with("datos", $datos);
      }

      public function create(Request $request){

        $sql = DB::insert("INSERT INTO proveedores (nombre, direccion, telefono) VALUES (?, ?, ?)", [
            $request['txtnombre'],
            $request['txtdireccion'],
            $request['txttelefono'],
        ]);

    if ($sql ==true){
        return back()->with("Correcto","Producto registrado correctamente");
    }else{
        return back()->with("Incorrecto ","Error al registrar");
    }
      }


      public function update(Request $request){
        $sql = DB::update("UPDATE proveedores SET
            nombre = ?,
            direccion = ?,
            telefono = ?
            WHERE id = ?",
            [
                $request['txtnombre'],
                $request['txtdireccion'],
                $request['txttelefono'],
                $request['txtid']
            ]);

        if ($sql == true){
            return back()->with("Correcto","Producto ha sido actualizado correctamente");
        } else {
            return back()->with("Incorrecto","Error al actualizar el producto");
        }
    }
    public function delete($id){
        $sql = DB::delete("DELETE FROM proveedores WHERE id = ?", bindings: [$id]);


       if ($sql == true){
        return back()->with("Correcto","Proveedor ha sido retirado correctamente");
    } else {
        return back()->with("Incorrecto","Error al retirar el proveedor");
    }
    }


    public function cambiarEstado($id) {
        $proveedor = DB::table('proveedores')->where('id', $id)->first();

        if ($proveedor) {
            $nuevoEstado = $proveedor->estado == 1 ? 0 : 1;

            DB::table('proveedores')->where('id', $id)->update(['estado' => $nuevoEstado]);

            return back()->with('success', 'Estado cambiado exitosamente');
        }

        return back()->with('error', 'Proveedor no encontrado');
    }


    }




