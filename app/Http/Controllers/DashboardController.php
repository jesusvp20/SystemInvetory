<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProductos = DB::table('producto')->where('estado', 1)->count(); // Asumiendo que 1 es activo
        $totalProveedores = DB::table('proveedores')->where('estado', 1)->count(); // Asumiendo que 1 es activo
        $totalClientes = DB::table('clientes')->where('estado', 1)->count(); // Asumiendo que 1 es activo
        $totalVentas = DB::table('ventas')->count(); // Asumiendo que todas las ventas se cuentan

        return view('DashboradView')->with([
            'totalProductos' => $totalProductos,
            'totalProveedores' => $totalProveedores,
            'totalClientes' => $totalClientes,
            'totalVentas' => $totalVentas,
        ]);
    }
}
