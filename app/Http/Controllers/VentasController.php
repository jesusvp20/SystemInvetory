<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

/**
 * Controlador de Ventas
 * 
 * Fecha de modificación: 2024-12-19
 * Cambio: Agregado filtro por user_id para aislamiento de datos
 * Por qué: Cada usuario debe ver solo sus propias ventas
 */
class VentasController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        $dato = DB::select('
            SELECT v.id_venta, v.fecha_venta, v.total, v.id_cliente, c.nombre AS cliente_nombre,
                   STRING_AGG(p.nombre, \', \') AS productos_nombres
            FROM ventas v
            LEFT JOIN clientes c ON v.id_cliente = c.id
            LEFT JOIN detalle_ventas dv ON v.id_venta = dv.id_venta
            LEFT JOIN producto p ON dv.id_producto = p."IdProducto"
            WHERE v.user_id = ?
            GROUP BY v.id_venta, v.fecha_venta, v.total, v.id_cliente, c.nombre
        ', [$userId]);

        $productos = DB::select("SELECT \"IdProducto\", nombre, precio FROM producto WHERE user_id = ?", [$userId]);
        $clientes  = DB::select("SELECT id, nombre FROM clientes WHERE user_id = ?", [$userId]);

        return view("ventas")
            ->with("dato", $dato)
            ->with("productos", $productos)
            ->with("clientes", $clientes);
    }

    public function registrarCompra(Request $request)
    {
        // Validaciones según esquema SQL
        $request->validate([
            'cliente' => 'required|integer|exists:clientes,id',
            'total' => 'required|numeric|min:0|max:10000000',
            'productos' => 'required|array|min:1',
            'cantidades' => 'required|array|min:1',
        ], [
            'cliente.required' => 'Debe seleccionar un cliente',
            'cliente.exists' => 'El cliente seleccionado no existe',
            'total.required' => 'El total es requerido',
            'total.max' => 'El total no puede exceder 10.000.000',
            'productos.required' => 'Debe seleccionar al menos un producto',
            'cantidades.required' => 'Debe especificar las cantidades',
        ]);

        try {
            $userId = Auth::id();
            
            // Limpiar formato de precio
            $total = str_replace('.', '', $request->total);
            $total = str_replace(',', '.', $total);
            
            // Insertar venta con user_id
            $ventaId = DB::table('ventas')->insertGetId([
                'id_cliente'  => $request->cliente,
                'fecha_venta' => now(),
                'total'       => $total,
                'user_id'     => $userId,
            ]);

            // Insertar detalles
            $productos  = $request->productos;
            $cantidades = $request->cantidades;

            foreach ($productos as $index => $productoId) {
                $producto = DB::table('producto')
                    ->whereRaw('"IdProducto" = ?', [$productoId])
                    ->where('user_id', $userId)
                    ->first();

                if ($producto) {
                    DB::table('detalle_ventas')->insert([
                        'id_venta'    => $ventaId,
                        'id_producto' => $productoId,
                        'cantidad'    => $cantidades[$index],
                        'precio'      => $producto->precio, 
                    ]);
                }
            }

            // Recuperar venta para mostrar
            $venta = DB::selectOne('
                SELECT v.id_venta, v.fecha_venta, v.total, v.id_cliente, c.nombre AS cliente_nombre,
                       STRING_AGG(p.nombre, \', \') AS productos_nombres
                FROM ventas v
                INNER JOIN clientes c ON v.id_cliente = c.id
                INNER JOIN detalle_ventas dv ON v.id_venta = dv.id_venta
                INNER JOIN producto p ON dv.id_producto = p."IdProducto"
                WHERE v.id_venta = ? AND v.user_id = ?
                GROUP BY v.id_venta, v.fecha_venta, v.total, v.id_cliente, c.nombre
            ', [$ventaId, $userId]);

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
        // Validaciones según esquema SQL
        $request->validate([
            'txtcliente' => 'required|integer|exists:clientes,id',
            'txtfecha_venta' => 'required|date',
            'txttotal' => 'required|numeric|min:0|max:10000000',
        ], [
            'txtcliente.required' => 'Debe seleccionar un cliente',
            'txtfecha_venta.required' => 'La fecha es requerida',
            'txttotal.required' => 'El total es requerido',
            'txttotal.max' => 'El total no puede exceder 10.000.000',
        ]);

        try {
            $userId = Auth::id();
            
            // Limpiar formato de precio
            $total = str_replace('.', '', $request['txttotal']);
            $total = str_replace(',', '.', $total);
            
            $sql = DB::update("UPDATE ventas SET
                id_cliente = ?,
                fecha_venta = ?,
                total = ?
                WHERE id_venta = ? AND user_id = ?",
                [
                    $request['txtcliente'],
                    $request['txtfecha_venta'],
                    $total,
                    $request['txtid_venta'],
                    $userId
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
            $userId = Auth::id();
            
            // Verificar que la venta pertenece al usuario
            $venta = DB::table('ventas')
                ->where('id_venta', $id)
                ->where('user_id', $userId)
                ->first();
                
            if (!$venta) {
                return back()->with("Incorrecto", "Venta no encontrada");
            }

            DB::delete("DELETE FROM detalle_ventas WHERE id_venta = ?", [$id]);
            $deleted = DB::delete("DELETE FROM ventas WHERE id_venta = ? AND user_id = ?", [$id, $userId]);

            if ($deleted) {
                return back()->with("Correcto", "Venta eliminada correctamente");
            } else {
                return back()->with("Incorrecto", "Error al eliminar la venta");
            }
        } catch (\Exception $e) {
            return back()->with("Incorrecto", "Error: " . $e->getMessage());
        }
    }
}
