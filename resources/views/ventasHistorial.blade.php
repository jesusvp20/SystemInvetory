<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historial de Ventas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg" style="background-color: black;">
        <div class="container-fluid">
            <!-- Botón para abrir el menú lateral -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="color: white; filter: invert(1);"></span>
            </button>

            <h1 class="text-white fw-bold d-none d-md-block">Registros de Ventas</h1>
            <span class="text-white fw-bold d-md-none">Historial</span>

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
<div class="container-fluid px-2 px-md-4 mt-4">
        <h1 class="text-center mb-3 fs-4 fs-md-1">Historial de Ventas</h1>

        <div class="row mb-3 g-2">
            <div class="col-6 col-md-4">
                <input type="text" id="searchCliente" class="form-control form-control-sm" placeholder="Buscar cliente...">
            </div>
            <div class="col-6 col-md-4">
                <input type="date" id="searchFecha" class="form-control form-control-sm">
            </div>
            <div class="col-12 col-md-4">
                <button class="btn btn-primary btn-sm w-100 w-md-auto" id="btnBuscar">
                    <i class="bi bi-search"></i> Buscar
                </button>
            </div>
        </div>

        <div class="table-responsive">
        <table class="table table-striped table-bordered table-sm">
            <thead class="table-dark">
                <tr>
                    <th># Venta</th>
                    <th>Fecha</th>
                    <th>Cliente</th>
                    <th>Productos</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="ventasTable">
                @foreach($dato as $venta)
                    <tr>
                        <td>{{ $venta->id_venta }}</td>
                        <td>{{ $venta->fecha_venta }}</td>
                        <td>{{ $venta->cliente_nombre }}</td>
                        <td>{{ $venta->productos_nombres }}</td>
                        <td>${{ number_format($venta->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById("btnBuscar").addEventListener("click", function () {
            const searchCliente = document.getElementById("searchCliente").value.toLowerCase();
            const searchFecha = document.getElementById("searchFecha").value;

            const rows = document.querySelectorAll("#ventasTable tr");
            let VentaEncontrada = false;

            rows.forEach(row => {
                const cliente = row.cells[2].textContent.toLowerCase();
                const fecha = row.cells[1].textContent;

                const matchesCliente = !searchCliente || cliente.includes(searchCliente);
                const matchesFecha = !searchFecha || fecha.includes(searchFecha);

                if (matchesCliente && matchesFecha) {
                    row.style.display = "";
                    VentaEncontrada = true;
                } else {
                    row.style.display = "none";
                }
            });

            if (!VentaEncontrada) {
                alert("No se encontró ningún registro.");
            }
        });
    </script>
</body>
</html>
