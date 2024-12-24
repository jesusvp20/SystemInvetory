<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProductos = DB::table('producto')->count();
        $totalProveedores = DB::table('proveedores')->count();
        $totalClientes = DB::table('clientes')->count();
        return view('DashboradView')->with([
            'totalProductos' => $totalProductos,
            'totalProveedores' => $totalProveedores,
             'totalClientes' => $totalClientes,
        ]);
    }
}
