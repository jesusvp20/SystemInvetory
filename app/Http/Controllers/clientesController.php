<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class clientesController extends Controller
{
    public function index(){
     $sql = DB::select("SELECT * FROM clientes");
        return view("clientes")->with('clientes', $sql);
    }

    public function create(Request $request){
        $sql = DB::insert("INSERT INTO clientes (nombre, identificacion,	email, telefono)values (?,?,?,?)",[
           $request["txtnombre"],
           $request["txtidentificacion"],
           $request["txtemail"],
           $request["txttelefono"],

        ]);
            if($sql){
                return back()->with("Correcto","El cliente ha registrado correctamente");
            }else{
                return back()->with("Incorrecto ","Error al registrar cliente");
            }
            }

            public function update(Request $request){
                $sql = DB::update("UPDATE clientes SET
                    nombre = ?,
                    identificacion = ?,
                    email = ?,
                    telefono = ?
                    WHERE id = ?",
                    [
                        $request["txtnombre"],
                        $request["txtidentificacion"],
                        $request["txtemail"],
                        $request["txttelefono"],
                        $request["txtid"],
                    ]
                );

                if ($sql) {
                    return back()->with("Correcto", "Cliente ha sido actualizado correctamente");
                } else {
                    return back()->with("Incorrecto", "Error al actualizar el cliente");
                }
            }


      public function delete($id){
      $sql = DB::delete("delete from  clientes where id =?",[$id]);

      if ($sql) {
        return back()->with("Correcto", "Cliente ha sido retirado correctamente");
    } else {
        return back()->with("Incorrecto", "Error al retirar el cliente");
    }

      }

      public function OrdenarClientes(Request $request) {
        $ordenarPor = $request->input('ordenarPor', 'id');

        $tablaClientes = DB::table('clientes');

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
    public function CambiarEstadoCliente ($id){
        $sql = DB::table('clientes')->where('id',$id)  ->first();

        if($sql){
           $nuevoEstado = $sql->estado == 1 ? 0 : 1;
DB::table('clientes')->where('id', $id)->update(['estado' => $nuevoEstado]);
     return back()->with('success', 'Estado cambiado exitosamente');
        }
        return back()->with('error', 'Cliente no encontrado');

    }
    }

