<!doctype html>
<html lang="en">
    <head>
        <title>Proveedores Activos</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

        <link   href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"rel="stylesheet" crossorigin="anonymous"
 />

        <style>
            .status-circle {
                width: 12px;
                height: 12px;
                border-radius: 50%;
                display: inline-block;
                margin-right: 8px;
            }
            .status-active {
                background-color: #28a745;
            }
            .status-inactive {
                background-color: #6c757d;
            }
        </style>
    </head>

    <body>
        <nav class="navbar navbar-expand-lg" style="background-color: black;">
            <div class="container-fluid">
                <!-- Botón para abrir el menú lateral -->
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon" style="color: white; filter: invert(1);"></span>
                </button>

                <h1 class="text-white fw-bold d-none d-md-block">Proveedores Activos</h1>
                <span class="text-white fw-bold d-md-none">Proveedores</span>

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
            <h1 class="mb-3 fs-4 fs-md-1">Proveedores Activos</h1>
            <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="text-center">ID</th>
                        <th scope="col">Nombre Del Proveedor</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Estado</th>
                        <th scope="col" class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proveedores as $item)
                    <tr>
                        <td class="text-center">{{ $item->id }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->direccion }}</td>
                        <td>{{ $item->telefono }}</td>
                        <td>
                            <span class="status-circle {{ $item->estado ? 'status-active' : 'status-inactive' }}"></span>
                        </td>
                        <td>
                            <a href="{{ route('AdminProveedores.index', $item->id) }}" class="btn btn-sm btn-primary">
                             Administrar
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </div>
        </div>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
