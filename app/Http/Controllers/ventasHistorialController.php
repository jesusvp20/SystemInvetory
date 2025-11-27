<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class ventasHistorialController extends Controller
{
    public function index()
    {
        $dato = DB::select("
        SELECT v.id_venta, v.fecha_venta, v.total, v.id_cliente, c.nombre AS cliente_nombre,
               STRING_AGG(p.nombre, ', ') AS productos_nombres
        FROM ventas v
        INNER JOIN clientes c ON v.id_cliente = c.id
        INNER JOIN detalle_ventas dv ON v.id_venta = dv.id_venta
        INNER JOIN producto p ON dv.id_producto = p.IdProducto
        GROUP BY v.id_venta, v.fecha_venta, v.total, v.id_cliente, c.nombre
    ");
    $productos = DB::select("SELECT IdProducto, nombre, precio FROM producto");
    $clientes = DB::select("SELECT id, nombre FROM clientes");

        return view("ventasHistorial")->with("dato", $dato)->with("productos", $productos)->with("clientes", $clientes);
    }
}

