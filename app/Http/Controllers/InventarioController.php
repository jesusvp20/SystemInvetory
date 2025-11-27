<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador de Inventario
 * 
 * Fecha de modificación: 2024-12-19
 * Cambio: Agregado filtro por user_id para aislamiento de datos
 * Por qué: Cada usuario debe ver solo sus propios productos
 */
class InventarioController extends Controller
{
    public function index(){
      // Filtrar productos por el usuario autenticado
      $userId = Auth::id();
      $datos = DB::select("
          SELECT p.*, pr.nombre AS proveedor_nombre 
          FROM producto p 
          LEFT JOIN proveedores pr ON CAST(p.proveedor AS INTEGER) = pr.id 
          WHERE p.user_id = ?
      ", [$userId]);
      $proveedores = DB::select("SELECT id, nombre FROM proveedores WHERE user_id = ?", [$userId]);
      return view("welcome")->with("datos", $datos)->with("proveedores", $proveedores);
    }

  public function create(Request $request){
    // Validaciones según esquema SQL
    $request->validate([
        'txtname' => 'required|string|max:250',
        'txtdescripcion' => 'required|string',
        'txtprecio' => 'required|numeric|min:0|max:10000000',
        'txtcantidad_disponible' => 'required|integer|min:0|max:2147483647',
        'txtcategoria' => 'required|string|max:50',
        'txtproveedor' => 'required',
        'txtcodigoProducto' => 'required|string|max:50|unique:producto,"codigoProducto"',
    ], [
        'txtname.required' => 'El nombre del producto es requerido',
        'txtname.max' => 'El nombre no puede exceder 250 caracteres',
        'txtdescripcion.required' => 'La descripción es requerida',
        'txtprecio.required' => 'El precio es requerido',
        'txtprecio.numeric' => 'El precio debe ser un número válido',
        'txtprecio.max' => 'El precio no puede exceder 10.000.000',
        'txtcantidad_disponible.required' => 'La cantidad es requerida',
        'txtcantidad_disponible.integer' => 'La cantidad debe ser un número entero',
        'txtcantidad_disponible.min' => 'La cantidad no puede ser negativa',
        'txtcategoria.required' => 'La categoría es requerida',
        'txtcategoria.max' => 'La categoría no puede exceder 50 caracteres',
        'txtproveedor.required' => 'Debe seleccionar un proveedor',
        'txtcodigoProducto.required' => 'El código del producto es requerido',
        'txtcodigoProducto.max' => 'El código no puede exceder 50 caracteres',
        'txtcodigoProducto.unique' => 'Este código de producto ya existe',
    ]);

    $userId = Auth::id();
    
    // Limpiar formato de precio (quitar puntos de miles)
    $precio = str_replace('.', '', $request['txtprecio']);
    $precio = str_replace(',', '.', $precio);
    
    $sql = DB::insert("INSERT INTO producto (nombre, descripcion, precio, cantidad_disponible, categoria, proveedor, \"codigoProducto\", fecha_creacion, fecha_actualizacion, user_id)
     VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?)", [
        $request['txtname'],
        $request['txtdescripcion'],
        $precio,
        $request['txtcantidad_disponible'],
        $request['txtcategoria'],
        $request['txtproveedor'],
        $request['txtcodigoProducto'],
        $userId,
    ]);

    if ($sql == true){
        return back()->with("Correcto","Producto registrado correctamente");
    }else{
        return back()->with("Incorrecto","Error al registrar");
    }
  }

  public function update(Request $request){
    // Validaciones según esquema SQL
    $request->validate([
        'txtname' => 'required|string|max:250',
        'txtdescripcion' => 'required|string',
        'txtprecio' => 'required|numeric|min:0|max:10000000',
        'txtcantidad_disponible' => 'required|integer|min:0|max:2147483647',
        'txtcategoria' => 'required|string|max:50',
        'txtproveedor' => 'required',
    ], [
        'txtname.required' => 'El nombre del producto es requerido',
        'txtname.max' => 'El nombre no puede exceder 250 caracteres',
        'txtprecio.required' => 'El precio es requerido',
        'txtprecio.max' => 'El precio no puede exceder 10.000.000',
        'txtcantidad_disponible.required' => 'La cantidad es requerida',
        'txtcantidad_disponible.integer' => 'La cantidad debe ser un número entero',
        'txtcategoria.max' => 'La categoría no puede exceder 50 caracteres',
    ]);

    $userId = Auth::id();
    
    // Limpiar formato de precio
    $precio = str_replace('.', '', $request['txtprecio']);
    $precio = str_replace(',', '.', $precio);
    
    $sql = DB::update('UPDATE producto SET
        nombre = ?,
        descripcion = ?,
        precio = ?,
        proveedor = ?,
        cantidad_disponible = ?,
        categoria = ?,
        fecha_actualizacion = NOW()
        WHERE "IdProducto" = ? AND user_id = ?',
        [
            $request['txtname'],
            $request['txtdescripcion'],
            $precio,
            $request['txtproveedor'],
            $request['txtcantidad_disponible'],
            $request['txtcategoria'],
            $request['txtIdProducto'],
            $userId
        ]);

    if ($sql == true){
        return back()->with("Correcto","Producto ha sido actualizado correctamente");
    } else {
        return back()->with("Incorrecto","Error al actualizar el producto");
    }
}

public function delete($id){
    $userId = Auth::id();
    
    // Solo eliminar si el producto pertenece al usuario
    $sql = DB::delete('DELETE FROM producto WHERE "IdProducto" = ? AND user_id = ?', [$id, $userId]);

   if ($sql == true){
    return back()->with("Correcto","Producto ha sido eliminado correctamente");
} else {
    return back()->with("Incorrecto","Error al eliminar el producto");
}
}

public function search(Request $request){
    $query = $request->input('buscar');
    $userId = Auth::id();

    // Buscar solo en productos del usuario con nombre del proveedor
    $productos = DB::select('
        SELECT p.*, pr.nombre AS proveedor_nombre 
        FROM producto p 
        LEFT JOIN proveedores pr ON CAST(p.proveedor AS INTEGER) = pr.id 
        WHERE p.user_id = ? AND (p."codigoProducto" LIKE ? OR p.nombre LIKE ?)
    ', [
        $userId,
        '%' . $query . '%',
        '%' . $query . '%'
    ]);
    
    $proveedores = DB::select("SELECT id, nombre FROM proveedores WHERE user_id = ?", [$userId]);

    return view('welcome')->with('datos', $productos)->with('proveedores', $proveedores);
}

public function ordenar(Request $request)
{
    $campo = $request->input('campo', '"IdProducto"');
    $direccion = $request->input('direccion', 'asc');
    $userId = Auth::id();

    // Campos permitidos para evitar SQL injection
    $camposPermitidos = ['"IdProducto"', 'nombre', 'precio', 'categoria', 'cantidad_disponible', 'fecha_creacion'];
    if (!in_array($campo, $camposPermitidos)) {
        $campo = '"IdProducto"';
    }
    $direccion = strtolower($direccion) === 'desc' ? 'DESC' : 'ASC';

    // Ordenar solo productos del usuario con nombre del proveedor
    $productosOrdenados = DB::select("
        SELECT p.*, pr.nombre AS proveedor_nombre 
        FROM producto p 
        LEFT JOIN proveedores pr ON CAST(p.proveedor AS INTEGER) = pr.id 
        WHERE p.user_id = ?
        ORDER BY p.{$campo} {$direccion}
    ", [$userId]);
    
    $proveedores = DB::select("SELECT id, nombre FROM proveedores WHERE user_id = ?", [$userId]);

    return view('welcome')->with([
        'datos' => $productosOrdenados,
        'proveedores' => $proveedores,
        'campo' => $campo,
        'direccion' => $direccion,
    ]);
}

public function cambiarStatus($id)
{
    $userId = Auth::id();
    
    // Solo cambiar estado si el producto pertenece al usuario
    $producto = DB::table('producto')
        ->whereRaw('"IdProducto" = ?', [$id])
        ->where('user_id', $userId)
        ->first();

    if ($producto) {
        $nuevoEstado = $producto->estado == 1 ? 0 : 1;

        DB::table('producto')
            ->whereRaw('"IdProducto" = ?', [$id])
            ->where('user_id', $userId)
            ->update(['estado' => $nuevoEstado]);

        return back()->with('success', 'Estado cambiado exitosamente');
    }

    return back()->with('error', 'No se pudo cambiar el estado del producto');
}



}
