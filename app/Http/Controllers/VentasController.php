<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    public function index()
    {
        $dato = DB::select("
            SELECT v.id_venta, v.fecha_venta, v.total, v.id_cliente, c.nombre AS cliente_nombre,
                   GROUP_CONCAT(p.nombre SEPARATOR ', ') AS productos_nombres
            FROM ventas v
            LEFT JOIN clientes c ON v.id_cliente = c.id
            LEFT JOIN detalle_ventas dv ON v.id_venta = dv.id_venta
            LEFT JOIN producto p ON dv.id_producto = p.IdProducto
            GROUP BY v.id_venta, v.fecha_venta, v.total, v.id_cliente, c.nombre
        ");

        $productos = DB::select("SELECT IdProducto, nombre, precio FROM producto");
        $clientes  = DB::select("SELECT id, nombre FROM clientes");

        return view("ventas")
            ->with("dato", $dato)
            ->with("productos", $productos)
            ->with("clientes", $clientes);
    }

    public function registrarCompra(Request $request)
    {
        try {
            // Insertar venta
            $ventaId = DB::table('ventas')->insertGetId([
                'id_cliente'  => $request->cliente,
                'fecha_venta' => now(),
                'total'       => $request->total,
            ]);

            // Insertar detalles
            $productos  = $request->productos;   // Array de productos
            $cantidades = $request->cantidades; // Array de cantidades

           foreach ($productos as $index => $productoId) {
    $producto = DB::table('producto')->where('IdProducto', $productoId)->first();

    DB::table('detalle_ventas')->insert([
        'id_venta'    => $ventaId,
        'id_producto' => $productoId,
        'cantidad'    => $cantidades[$index],
        'precio'      => $producto->precio, 
    ]);
}

            // Recuperar venta para mostrar
            $venta = DB::selectOne("
                SELECT v.id_venta, v.fecha_venta, v.total, v.id_cliente, c.nombre AS cliente_nombre,
                       GROUP_CONCAT(p.nombre SEPARATOR ', ') AS productos_nombres
                FROM ventas v
                INNER JOIN clientes c ON v.id_cliente = c.id
                INNER JOIN detalle_ventas dv ON v.id_venta = dv.id_venta
                INNER JOIN producto p ON dv.id_producto = p.IdProducto
                WHERE v.id_venta = ?
                GROUP BY v.id_venta, v.fecha_venta, v.total, v.id_cliente, c.nombre
            ", [$ventaId]);

            return response()->json(['success' => true, 'venta' => $venta]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al registrar la venta',
                'error'   => $e->getMessage()
            ]);
        }
    }

    public function update(Request $request)
    {
        try {
            $sql = DB::update("UPDATE ventas SET
                id_cliente = ?,
                fecha_venta = ?,
                total = ?
                WHERE id_venta = ?",
                [
                    $request['txtcliente'],
                    $request['txtfecha_venta'],
                    $request['txttotal'],
                    $request['txtid_venta']
                ]);

            if ($sql) {
                return back()->with("Correcto", "Venta actualizada correctamente");
            } else {
                return back()->with("Incorrecto", "Error al actualizar la venta");
            }
        } catch (\Exception $e) {
            return back()->with("Incorrecto", "Error al actualizar la venta: " . $e->getMessage());
        }
    }

    public function deleteShop($id)
    {
        try {

            DB::delete("DELETE FROM detalle_ventas WHERE id_venta = ?", [$id]);

            // ✅ Luego borrar la venta
            $deleted = DB::delete("DELETE FROM ventas WHERE id_venta = ?", [$id]);

            if ($deleted) {
                return back()->with("Correcto", "Venta eliminada correctamente");
            } else {
                return back()->with("Incorrecto", "Error al eliminar la venta o no encontrada");
            }
        } catch (\Exception $e) {
            return back()->with("Incorrecto", "Error: " . $e->getMessage());
        }
    }
}
