<!doctype html>
<html lang="en">

<head>
    <title>Tabla Moderna</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        .table-modern {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .table-modern thead {
            background-color: #343a40;
            color: white;
        }

        .table-modern tbody tr:nth-child(odd) {
            background-color: #f8f9fa;
        }

        .table-modern tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        .table-modern tbody tr:hover {
            background-color: #e9ecef;
        }

        /* Botón de Editar */
        .btn-primary {
            background-color: #007bff;
            /* Color azul por defecto */
            color: white;
            /* Color del texto */
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-primary:hover {
            background-color: white;
            color: #007bff;
        }

        .btn-danger {
            background-color: #dc3545;
            /* Color rojo por defecto */
            color: white;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .btn-danger:hover {
            background-color: white;
            color: #dc3545;
        }
    </style>
</head>

<body>
    <div class="container mt-5">

        <h1 class="text-center p-3">Control De Productos</h1>
        @if(session("Correcto"))
        <div class="alert alert-success">{{session("Correcto")}} </div>
        @endif

        @if(session("Incorrecto"))
        <div class="alert alert-danger">{{session("Incorrecto")}} </div>
        @endif

        <script>
            var res = function() {
                var not = confirm("¿Estas seguro de eliminar?")
                return not;
            }
        </script>

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Registrar Productos</button>

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
                                <input type="number" step="0.01" class="form-control" id="precio" name="txtprecio" required>
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

        <div class="d-flex justify-content-end mb-3">
    <form class="d-flex" role="search" action="{{ route('inventario.buscar') }}" method="GET">
        <input class="form-control me-2" name="buscar" type="search" placeholder="Buscar producto..." aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Buscar</button>
    </form>
</div>

<table class="table table-hover table-modern">
    <thead>
        <tr>
            <th scope="col">IdProducto</th>
            <th scope="col">Nombre Del Producto</th>
            <th scope="col">Descripción</th>
            <th scope="col">Precio</th>
            <th scope="col">Cantidad Disponible</th>
            <th scope="col">
                <span style="display: inline-block; cursor: pointer;" onclick="ordenar('categoria')">
                    Categoria
                    <span style="color: black;">▲</span>
                    <span style="color: black;">▼</span>
                </span>
            </th>
            <th scope="col">
                <span style="display: inline-block; cursor: pointer;" onclick="ordenar('nombre')">
                    Nombre Del Producto
                    <span style="color: black;">▲</span>
                    <span style="color: black;">▼</span>
                </span>
            </th>
            <th scope="col">Código Del Producto</th>
            <th scope="col">Fecha De Creación</th>
            <th scope="col">Fecha De Actualización</th>
            <th scope ="col">Estado </th>
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
            <td>{{ $item->proveedor }}</td>
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
                    <a href="{{ route('inventario.delete', $item->IdProducto) }}" onclick="return res()" class="btn btn-danger btn-sm">
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
                                <input type="number" step="0.01" class="form-control" name="txtprecio" value="{{ $item->precio }}" />
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
                                <input type="text" class="form-control" name="txtcodigoProducto" value="{{ $item->codigoProducto }}" / readonly>
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

<script>
    function ordenar(campo) {
        let direccion = 'asc';
        window.location.href = `{{ route('inventario.ordenar') }}?campo=${campo}&direccion=${direccion}`;
    }
</script>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
