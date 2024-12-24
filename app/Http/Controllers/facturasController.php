<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;

class facturasController extends Controller
{
    public function index()
    {
        $clientes = DB::table('clientes')->get();
        $productos = DB::table('producto')->get();

        return view('facturas', compact('clientes', 'productos'));
    }

    public function store(Request $request)
    {
        // Crear factura y obtener el ID
        $facturaId = DB::table('facturas')->insertGetId([
            'numero_factura' => 'FAC-' . time(),
            'fecha' => now(),
            'cliente_id' => $request->cliente_id,
            'total' => 0,
            'estado' => 'pendiente'
        ]);

        // Calcular el total e insertar detalles de factura
        $total = 0;
        $productos = $request->productos_id;
        $cantidades = $request->cantidad;
        $precios = $request->precio_unitario;

        foreach ($productos as $index => $productoId) {
            $cantidad = $cantidades[$index];
            $precio = $precios[$index];
            $subtotal = $cantidad * $precio;
            $total += $subtotal;

            DB::table('detallefactura')->insert([
                'factura_id' => $facturaId,
                'producto_id' => $productoId,
                'cantidad' => $cantidad,
                'precio_unitario' => $precio,
                'subtotal' => $subtotal
            ]);
        }

{}        DB::table('facturas')->where('id', $facturaId)->update(['total' => $total]);

        // Redirigir directamente a la descarga del PDF
        return redirect()->route('facturas.pdf', $facturaId);
    }

    public function generarPDF($id)
    {
        $factura = DB::table('facturas')->where('id', $id)->first();
        $detalles = DB::table('detallefactura')->where('factura_id', $id)->get();
        $cliente = DB::table('clientes')->where('id', $factura->cliente_id)->first();

        $pdf = Pdf::loadView('facturaPDF', compact('factura', 'detalles', 'cliente'));
        return $pdf->download('factura-' . $factura->numero_factura . '.pdf');
    }
}
