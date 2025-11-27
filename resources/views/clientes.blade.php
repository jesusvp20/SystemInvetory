<!doctype html>
<html lang="en">
<head>
    <title>Administrar Clientes</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS v5.3.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link rel="stylesheet" href="{{ asset('estilos/clientes.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: black;">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="color: white; filter: invert(1);"></span>
            </button>

            <h1 class="text-white fw-bold d-none d-md-block">Clientes</h1>
            <span class="text-white fw-bold d-md-none">Clientes</span>

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

    <div class="container-fluid px-2 px-md-4 mt-4">
        <h1 class="mb-3 fs-4 fs-md-1">Administrar Clientes</h1>
        <div class="d-flex flex-column flex-md-row justify-content-between mb-3 gap-2">
            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
                <i class="bi bi-plus-lg"></i> <span class="d-none d-md-inline">Añadir Cliente</span><span class="d-md-none">Añadir</span>
            </button>

            <div class="dropdown">
                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-filter"></i> Ordenar
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="{{ route('cliente.ordenar', ['ordenarPor' => 'id']) }}">ID</a></li>
                    <li><a class="dropdown-item" href="{{ route('cliente.ordenar', ['ordenarPor' => 'nombre']) }}">Nombre</a></li>
                    <li><a class="dropdown-item" href="{{ route('cliente.ordenar', ['ordenarPor' => 'email']) }}">Correo Electrónico</a></li>
                </ul>
            </div>

        </div>

        <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Registrar Nuevo Cliente</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('clientes.create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nombre" class="form-label">Nombre Del Cliente</label>
                                <input type="text" class="form-control" name="txtnombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="identificacion" class="form-label">Número de Identificación</label>
                                <input type="number" class="form-control" name="txtidentificacion" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="number" class="form-control" name="txttelefono" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" name="txtemail" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Registrar Cliente</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="table-responsive">
        <table class="table table-striped table-hover table-sm">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col">Nombre Del Cliente</th>
                    <th scope="col">Número de Identificación</th>
                    <th scope="col">Correo Electrónico</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Estado</th>
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
                            <form action="{{ route('cambiar.EstadoCliente', $item->id) }}" method="POST" class="form-switch">
                                @csrf
                                <input type="hidden" name="estado" value="{{ $item->estado ? 0 : 1 }}">
                                <input type="checkbox" class="form-check-input" id="estado{{ $item->id }}"
                                       onchange="this.form.submit()" {{ $item->estado ? 'checked' : '' }}>
                                <label class="form-check-label" for="estado{{ $item->id }}">
                                    {{ $item->estado ? 'Activo' : 'Inactivo' }}
                                </label>
                            </form>
                        </td>
                        <td class="text-center">
                            <a href="" class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#modalActualizar{{ $item->id }}">Editar</a>
                            <a href="{{route('cliente.delete', $item->id)}}" class="btn btn-sm btn-danger" onclick="res()" >Eliminar</a>
                        </td>
                    </tr>
                    <div class="modal fade" id="modalActualizar{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Actualizar Datos Del Cliente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('clientes.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="txtid" value="{{ $item->id }}">
                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre Del Cliente</label>
                                            <input type="text" class="form-control" name="txtnombre" value="{{ $item->nombre }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="identificacion" class="form-label">Número de Identificación</label>
                                            <input type="number" class="form-control" name="txtidentificacion" value="{{ $item->identificacion }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="telefono" class="form-label">Teléfono</label>
                                            <input type="number" class="form-control" name="txttelefono" value="{{ $item->telefono }}" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" name="txtemail" value="{{ $item->email }}" required>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Actualizar Cliente</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                            </div>
                        </div>
                    </div>

                @endforeach
            </tbody>
        </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/clientes.js') }}"></script>
</body>
</html>
