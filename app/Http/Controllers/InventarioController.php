<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Laravel\Ui\Presets\React;

class InventarioController extends Controller
{
    public function index(){
      $datos =DB::select("select * from producto");
      $proveedores = DB:: select("Select id, nombre FROM proveedores");
      return view("welcome")->with("datos", $datos)->with("proveedores",$proveedores);
    }

  public function create(Request $request){

    $sql = DB::insert("INSERT INTO producto (nombre, descripcion, precio, cantidad_disponible,categoria,proveedor ,codigoProducto, fecha_creacion, fecha_actualizacion)
     VALUES (?, ?, ?, ? ,?,?, ?, NOW(), NOW())", [
        $request['txtname'],
        $request['txtdescripcion'],
        $request['txtprecio'],
        $request['txtcantidad_disponible'],
        $request['txtcategoria'],
        $request['txtproveedor'],
        $request['txtcodigoProducto'],

    ]);

if ($sql ==true){
    return back()->with("Correcto","Producto registrado correctamente");
}else{
    return back()->with("Incorrecto ","Error al registrar");
}
  }

  public function update(Request $request){
    $sql = DB::update("UPDATE producto SET
        nombre = ?,
        descripcion = ?,
        precio = ?,
        proveedor = ?,
        cantidad_disponible = ?,
        categoria = ?,
        fecha_actualizacion = NOW()
        WHERE IdProducto = ?",
        [
            $request['txtname'],
            $request['txtdescripcion'],
            $request['txtprecio'],
            $request['txtproveedor'],
            $request['txtcantidad_disponible'],
            $request['txtcategoria'],
            $request['txtIdProducto']
        ]);

    if ($sql == true){
        return back()->with("Correcto","Producto ha sido actualizado correctamente");
    } else {
        return back()->with("Incorrecto","Error al actualizar el producto");
    }
}

public function delete($id){
    $sql = DB::delete("DELETE FROM producto WHERE IdProducto = ?", [$id]);


   if ($sql == true){
    return back()->with("Correcto","Producto ha sido eliminado correctamente");
} else {
    return back()->with("Incorrecto","Error al eliminar el producto");
}
}

public function search(Request $request){
    $query = $request->input('buscar');


    $productos = DB::select("SELECT * FROM producto WHERE codigoProducto LIKE ? OR nombre LIKE ?", [
        '%' . $query . '%',
        '%' . $query . '%'
    ]);


    return view('welcome')->with('datos', $productos);
}



public function ordenar(Request $request)
{
    $campo = $request->input('campo', 'IdProducto');
    $direccion = $request->input('direccion', 'asc');

    // Construir la consulta SQL
    $productosOrdenados = DB::table('producto')->orderBy($campo, $direccion)->get();

    // Retornar la vista con los datos ordenados y el estado de ordenación
    return view('welcome')->with([
        'datos' => $productosOrdenados,
        'campo' => $campo,
        'direccion' => $direccion,
    ]);
}

public function cambiarStatus($IdProducto) {
    $sql = DB::table('producto')->where('IdProducto', operator: $IdProducto)->first();

    if ($sql) {
        $nuevoEstado = $sql->estado == 1 ? 0 : 1;

        DB::table('producto')->where('IdProducto', $IdProducto)->update(['estado' => $nuevoEstado]);

        return back()->with('success', 'Estado cambiado exitosamente');
    }

    return back()->with('error', 'el cambio del producto no se cambio');
}


}
