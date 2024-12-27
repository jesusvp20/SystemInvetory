<!doctype html>
<html lang="en">
<head>
    <title>Clientes Activos</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .status-circle {
            display: inline-block;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            margin-right: 5px;
        }
        .status-active { background-color: #28a745; }
        .status-inactive { background-color: #dc3545; }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: black;">
        <div class="container-fluid">
            <!-- Botón para abrir el menú lateral -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="color: white; filter: invert(1);"></span>
            </button>

            <h1 class="text-white fw-bold">Registro De Clientes</h1>

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
<div class="container my-4">
    <h2 class="text-center mb-4">Lista de Clientes</h2>
    <table class="table table-striped table-hover align-middle shadow">
        <thead class="table-dark">
            <tr>
                <th scope="col" class="text-center">ID</th>
                <th scope="col">Nombre del Cliente</th>
                <th scope="col">Número de Identificación</th>
                <th scope="col">Correo Electrónico</th>
                <th scope="col">Teléfono</th>
                <th scope="col" class="text-center">Estado</th>
                <th scope="col" class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($clientes as $item)
                <tr>
                    <td class="text-center">{{ $item->id }}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->identificacion }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->telefono }}</td>
                    <td class="text-center">
                        <span class="status-circle {{ $item->estado ? 'status-active' : 'status-inactive' }}"></span>
                        {{ $item->estado ? 'Activo' : 'Inactivo' }}
                    </td>
                    <td class="text-center">
                        <a href="{{route('clientes.index')}}" class="btn btn-sm btn-primary">
                            <i class="bi bi-gear"></i> Administrar
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
