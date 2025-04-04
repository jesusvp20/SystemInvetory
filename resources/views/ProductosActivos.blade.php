<!doctype html>
<html lang="en">
    <head>
        <title>Productos Activos</title>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

        <!-- Bootstrap CSS -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            crossorigin="anonymous"
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

                <h1 class="text-white fw-bold">Productos Activos</h1>

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
            <h1 class="mb-4">Productos Activos en Stock</h1>
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad Disponible</th>
                        <th scope="col">Categoría</th>
                        <th scope="col">Proveedor</th>
                        <th scope="col">Código del Producto</th>
                        <th scope="col">Fecha de Creación</th>
                        <th scope="col">Fecha de Actualización</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($producto as $item)
                    <tr>
                        <td>{{ $item->IdProducto }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->descripcion }}</td>
                        <td>{{ $item->precio }}</td>
                        <td>{{ $item->cantidad_disponible }}</td>
                        <td>{{ $item->categoria }}</td>
                        <td>{{ $item->proveedor }}</td>
                        <td>{{ $item->codigoProducto }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->fecha_creacion)->format('d-m-Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($item->fecha_actualizacion)->format('d-m-Y') }}</td>
                        <td>
                            <span class="status-circle {{ $item->estado ? 'status-active' : 'status-inactive' }}"></span>
                        </td>
                        <td>
                            <a href="{{ route('inventario.index', $item->IdProducto) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-cogs"></i> Administrar
                            </a>





                            </tr>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
