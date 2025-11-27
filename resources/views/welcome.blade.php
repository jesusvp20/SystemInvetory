<!doctype html>
<html lang="en">

<head>
    <title>Gestionar inventario</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('estilos/inventario.css') }}">
</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: black;">
        <div class="container-fluid">
            <!-- Botón para abrir el menú lateral -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="color: white; filter: invert(1);"></span>
            </button>

            <h1 class="text-white fw-bold d-none d-md-block">Control De inventario</h1>
            <span class="text-white fw-bold d-md-none">Inventario</span>

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
        <h1 class="text-center p-2 p-md-3 fs-4 fs-md-1">Control De Productos</h1>
        @if(session("Correcto"))
        <div class="alert alert-success">{{session("Correcto")}} </div>
        @endif

        @if(session("Incorrecto"))
        <div class="alert alert-danger">{{session("Incorrecto")}} </div>
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

        <button type="button" class="btn btn-success btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modalRegistrar">
            <i class="bi bi-plus-lg d-md-none"></i>
            <span class="d-none d-md-inline">Registrar Productos</span>
            <span class="d-md-none">Agregar</span>
        </button>

        <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Nuevo Producto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('inventario.create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nombre_producto" class="form-label">Nombre Del Producto</label>
                                <input type="text" class="form-control" id="nombre_producto" name="txtname" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="txtdescripcion" required>
                            </div>
                            <div class="mb-3">
                                <label for="precio" class="form-label">Precio</label>
                                <input type="text" class="form-control" id="precio" name="txtprecio" placeholder="Ej: 1.500.000" required>
                            </div>
                            <div class="mb-3">
                                <label for="cantidad_disponible" class="form-label">Cantidad Disponible</label>
                                <input type="number" class="form-control" id="cantidad_disponible" name="txtcantidad_disponible" required>
                            </div>
                            <div class="mb-3">
                                <label for="cantidad_disponible" class="form-label">Categoria Del Producto </label>
                                <input type="text" class="form-control" id="cantidad_disponible" name="txtcategoria" required>
                            </div>
                            <div class="mb-3">
                                <label for="proveedorSelect" class="form-label">Proveedor Del Producto</label>
                                <select class="form-select form-select-sm" name="txtproveedor" id="proveedorSelect" required>
                                    <option value="">Seleccione un proveedor</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>



                            <div class="mb-3">
                                <label for="codigoProducto" class="form-label">Código Del Producto</label>
                                <input type="text" class="form-control" id="codigoProducto" name="txtcodigoProducto" required>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Registrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column flex-md-row justify-content-end align-items-stretch align-items-md-center mb-3 gap-2">
            <form class="d-flex" role="search" action="{{ route('inventario.buscar') }}" method="GET">
                <input class="form-control form-control-sm me-2" name="buscar" type="search" placeholder="Buscar..." aria-label="Search">
                <button class="btn btn-outline-success btn-sm" type="submit"><i class="bi bi-search"></i></button>
            </form>
            <div class="dropdown">
                <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownOrdenar" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-filter"></i> Ordenar
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownOrdenar">
                    <li><a class="dropdown-item" href="{{ route('inventario.ordenar', ['campo' => 'nombre', 'direccion' => 'asc']) }}">Nombre (A-Z)</a></li>
                    <li><a class="dropdown-item" href="{{ route('inventario.ordenar', ['campo' => 'nombre', 'direccion' => 'desc']) }}">Nombre (Z-A)</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('inventario.ordenar', ['campo' => 'precio', 'direccion' => 'asc']) }}">Precio (Menor a Mayor)</a></li>
                    <li><a class="dropdown-item" href="{{ route('inventario.ordenar', ['campo' => 'precio', 'direccion' => 'desc']) }}">Precio (Mayor a Menor)</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('inventario.ordenar', ['campo' => 'categoria', 'direccion' => 'asc']) }}">Categoría (A-Z)</a></li>
                    <li><a class="dropdown-item" href="{{ route('inventario.ordenar', ['campo' => 'categoria', 'direccion' => 'desc']) }}">Categoría (Z-A)</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('inventario.ordenar', ['campo' => 'cantidad_disponible', 'direccion' => 'asc']) }}">Cantidad (Menor a Mayor)</a></li>
                    <li><a class="dropdown-item" href="{{ route('inventario.ordenar', ['campo' => 'cantidad_disponible', 'direccion' => 'desc']) }}">Cantidad (Mayor a Menor)</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="{{ route('inventario.ordenar', ['campo' => 'fecha_creacion', 'direccion' => 'desc']) }}">Más Recientes</a></li>
                    <li><a class="dropdown-item" href="{{ route('inventario.ordenar', ['campo' => 'fecha_creacion', 'direccion' => 'asc']) }}">Más Antiguos</a></li>
                </ul>
            </div>
        </div>

<div class="table-responsive">
<table class="table table-hover table-modern table-sm">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Categoría</th>
            <th scope="col">Proveedor</th>
            <th scope="col">Código</th>
            <th scope="col">Creación</th>
            <th scope="col">Actualización</th>
            <th scope="col">Estado</th>
            <th scope="col" class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($datos as $item)
        <tr>
            <td>{{$item->IdProducto}}</td>
            <td>{{ $item->nombre }}</td>
            <td>{{ $item->descripcion }}</td>
            <td>{{ $item->precio }}</td>
            <td>{{ $item->cantidad_disponible }}</td>
            <td>{{ $item->categoria }}</td>
            <td>{{ $item->proveedor_nombre ?? 'Sin proveedor' }}</td>
            <td>{{ $item->codigoProducto }}</td>
            <td>{{ \Carbon\Carbon::parse($item->fecha_creacion)->format('d-m-Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($item->fecha_actualizacion)->format('d-m-Y') }}</td>

            <td class="text-center">
                <form action="{{ route('Cambiar.status', $item->IdProducto) }}" method="POST" class="form-switch">
                    @csrf
                    <input type="hidden" name="estado" value="{{ $item->estado ? 0 : 1 }}">
                    <input type="checkbox" class="form-check-input" IdProducto="estado{{ $item->IdProducto }}"
                           onchange="this.form.submit()" {{ $item->estado ? 'checked' : '' }}>
                    <label class="form-check-label" for="estado{{ $item->IdProducto }}">
                        {{ $item->estado ? 'Activo' : 'Inactivo' }}
                    </label>
                </form>

            </td>
            <td  class="text-center">
                <div class="d-flex justify-content-around">
                    <a href="#" class="btn btn-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->IdProducto }}">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <a href="{{ route('inventario.delete', $item->IdProducto) }}" onclick="return confirmarEliminar()" class="btn btn-danger btn-sm">
                        <i class="bi bi-trash"></i>
                    </a>
                </div>
            </td>
        </tr>

        <!-- Modal Actualizar -->
        <div class="modal fade" id="modalEditar{{ $item->IdProducto }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modificar Datos Del Producto</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('inventario.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="txtIdProducto" value="{{ $item->IdProducto }}">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nombre Del Producto</label>
                                <input type="text" class="form-control" name="txtname" value="{{ $item->nombre }}" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Descripción</label>
                                <input type="text" class="form-control" name="txtdescripcion" value="{{ $item->descripcion }}" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Precio</label>
                                <input type="text" class="form-control" name="txtprecio" value="{{ number_format($item->precio, 0, ',', '.') }}" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Cantidad Disponible</label>
                                <input type="number" class="form-control" name="txtcantidad_disponible" value="{{ $item->cantidad_disponible }}" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Categoria Del Producto</label>
                                <input type="text" class="form-control" name="txtcategoria" value="{{ $item->categoria }}" />
                            </div>
                            <div class="mb-3">
                                <label for="proveedorSelect" class="form-label">Proveedor Del Producto</label>
                                <select class="form-select form-select-sm" name="txtproveedor" id="proveedorSelect" required>
                                    <option value="">Seleccione un proveedor</option>
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Código Del Producto</label>
                                <input type="text" class="form-control" name="txtcodigoProducto" value="{{ $item->codigoProducto }}" readonly>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                <button type="submit" class="btn btn-primary">Actualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </tbody>
</table>
</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="{{ asset('js/inventario.js') }}"></script>

</body>

</html>
