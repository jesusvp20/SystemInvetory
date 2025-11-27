<!doctype html>
<html lang="en">
<head>
    <title>Factura</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('estilos/facturas.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: black;">
        <div class="container-fluid">
            <!-- Botón para abrir el menú lateral -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="color: white; filter: invert(1);"></span>
            </button>

            <h1 class="text-white fw-bold">Facturas </h1>

            <div class="offcanvas offcanvas-start text-bg-light" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-dark" id="offcanvasDarkNavbarLabel">Opciones de Inventario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <!-- Botón para ir al Dashboard -->
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('dashboard.index') }}">
                                <i class="bi bi-house-fill"></i> Ir al Dashboard
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
<div class="container mt-4">
    @if(session("Correcto"))
        <div class="alert alert-success">{{ session("Correcto") }}</div>
    @endif
    @if(session("Incorrecto"))
        <div class="alert alert-danger">{{ session("Incorrecto") }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

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
<script src="{{ asset('js/facturas.js') }}"></script>
</body>
</html>
