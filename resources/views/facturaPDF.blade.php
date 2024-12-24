<!doctype html>
<html>
<head>
    <title>Factura</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>Factura #{{ $factura->numero_factura }}</h1>
    <p>Fecha: {{ $factura->fecha }}</p>
    <p>Cliente: {{ $cliente->nombre }}</p>

    <h3>Detalles de la Factura:</h3>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detalles as $detalle)
                <tr>
                    <td>{{ $detalle->producto_id }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>{{ $detalle->precio_unitario }}</td>
                    <td>{{ $detalle->subtotal }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <h3>Total: ${{ $factura->total }}</h3>
</body>
</html>
