<!doctype html>
<html lang="en">
<head>
    <title>Reporte de Ventas</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: black;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="color: white; filter: invert(1);"></span>
            </button>
            <h1 class="text-white fw-bold">Historial de Ventas</h1>
            <div class="offcanvas offcanvas-start text-bg-light" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title text-dark" id="offcanvasDarkNavbarLabel">Opciones</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
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
        <h1 class="mb-4">reporte de Ventas</h1>
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Fecha de Venta</th>
                    <th>Total</th>
                    <th>Cliente</th>
                    <th>Productos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dato as $venta)
                <tr>
                    <td>{{ $venta->id_venta }}</td>
                    <td>{{ \Carbon\Carbon::parse($venta->fecha_venta)->format('d-m-Y') }}</td>
                    <td>{{ $venta->total }}</td>
                    <td>{{ $venta->cliente_nombre }}</td>
                    <td>{{ $venta->productos_nombres }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3 class="mt-5">Ventas por Producto</h3>
        <canvas id="ventasChart" width="400" height="200"></canvas>
    </div>

    <script>
        // Datos de ventas y productos enviados desde el controlador
        var productos = @json($productos);

        // Extraer nombres y precios de productos
        var nombresProductos = productos.map(function(producto) {
            return producto.nombre;
        });
        var preciosProductos = productos.map(function(producto) {
            return producto.precio;
        });

        // Crear el gráfico con Chart.js
        var ctx = document.getElementById('ventasChart').getContext('2d');
        var ventasChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: nombresProductos,
                datasets: [{
                    label: 'Precios de Productos',
                    data: preciosProductos,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
