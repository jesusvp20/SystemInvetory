<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

/**
 * Controlador del Dashboard
 * 
 * Fecha de modificación: 2024-12-19
 * Cambio: Agregado filtro por user_id para aislamiento de datos
 * Por qué: Cada usuario debe ver solo sus propios totales
 */
class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        
        // Contar solo los datos del usuario autenticado
        $totalProductos = DB::table('producto')
            ->where('estado', true)
            ->where('user_id', $userId)
            ->count();
            
        $totalProveedores = DB::table('proveedores')
            ->where('estado', true)
            ->where('user_id', $userId)
            ->count();
            
        $totalClientes = DB::table('clientes')
            ->where('estado', true)
            ->where('user_id', $userId)
            ->count();
            
        $totalVentas = DB::table('ventas')
            ->where('user_id', $userId)
            ->count();

        return view('DashboardView')->with([
            'totalProductos' => $totalProductos,
            'totalProveedores' => $totalProveedores,
            'totalClientes' => $totalClientes,
            'totalVentas' => $totalVentas,
        ]);
    }
}
