<!doctype html>
<html lang="en">
<head>
    <title>Factura</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-4">
    <h1 class="mb-4 text-center">Factura de Compra</h1>

    <form action="{{ route('facturas.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="cliente_id" class="form-label">Cliente</label>
            <select class="form-select" name="cliente_id" id="cliente_id" required>
                <option value="">Seleccione un cliente</option>
                @foreach ($clientes as $cliente)
                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div id="productos-container">
            <div class="mb-3">
                <label for="productos_id" class="form-label">Producto</label>
                <select class="form-select" name="productos_id[]" required>
                    <option value="">Seleccione un producto</option>
                    @foreach ($productos as $producto)
                        <option value="{{ $producto->IdProducto }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>

                <label for="cantidad" class="form-label mt-2">Cantidad</label>
                <input type="number" name="cantidad[]" class="form-control" min="1" required>

                <label for="precio_unitario" class="form-label mt-2">Precio Unitario</label>
                <input type="number" step="0.01" name="precio_unitario[]" class="form-control" required>
            </div>
        </div>

        <button type="button" class="btn btn-secondary mb-3" onclick="agregarProducto()">Agregar Producto</button>
        <button type="submit" class="btn btn-primary">Generar Factura</button>
    </form>
</div>

<script>
    function agregarProducto() {
        const container = document.getElementById('productos-container');
        const productTemplate = container.children[0].cloneNode(true);
        container.appendChild(productTemplate);
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
