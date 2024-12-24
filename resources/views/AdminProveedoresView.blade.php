<!doctype html>
<html lang="en">
<head>
    <title>Administrar Proveedores</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
</head>

<body>
    @if(session("Correcto"))
    <div class="alert alert-success">{{session("Correcto")}} </div>
    @endif

    @if(session("Incorrecto"))
    <div class="alert alert-danger">{{session("Incorrecto")}} </div>
    @endif

    <div class="container mt-4">
        <h1>Lista de Proveedores</h1>
        <script>
            function res() {
                return confirm("¿Estás seguro de eliminar este proveedor?");
            }
        </script>

        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalRegistrar">Ingresar Proveedores</button>
              
        <div class="modal fade" id="modalRegistrar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Registrar Nuevo Proveedor</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('inventario.create') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="nombre_producto" class="form-label">Nombre Del Proveedor</label>
                                <input type="text" class="form-control" id="nombtr" name="txtnombre" required>
                            </div>
                            <div class="mb-3">
                                <label for="descripcion" class="form-label">Descripción</label>
                                <input type="text" class="form-control" id="direccion" name="txtdireccion" required>
                            </div>
                            <div class="mb-3">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="number" step="0.01" class="form-control" id="telefono" name="txttelefono" required>
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

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col">Nombre Del Proveedor</th>
                    <th scope="col">Dirección</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col" class="text-center">Estado</th>
                    <th scope="col" class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos as $item)
                    <tr>
                        <td class="text-center">{{ $item->id }}</td>
                        <td>{{ $item->nombre }}</td>
                        <td>{{ $item->direccion }}</td>
                        <td>{{ $item->telefono }}</td>
                        <td class="text-center">
                            <form action="{{ route('cambiar.estado', $item->id) }}" method="POST" class="form-switch">
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
                            <a href="#" class="btn btn-primary btn-sm me-2" title="Editar" data-bs-toggle="modal" data-bs-target="#modalEditar{{ $item->id }}">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                            <a href="{{ route('AdminProveedores.delete', $item->id) }}" onclick="return res()" class="btn btn-danger btn-sm" title="Eliminar">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <div class="modal fade" id="modalEditar{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Proveedor</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('AdminProveedores.update', $item->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <input type="hidden" name="txtid" value="{{ $item->id }}">

                                        <div class="mb-3">
                                            <label for="nombre" class="form-label">Nombre Del Proveedor</label>
                                            <input type="text" class="form-control" id="nombre" name="txtnombre" value="{{ $item->nombre }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="direccion" class="form-label">Dirección</label>
                                            <input type="text" class="form-control" id="direccion" name="txtdireccion" value="{{ $item->direccion }}" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="telefono" class="form-label">Teléfono</label>
                                            <input type="text" class="form-control" id="telefono" name="txttelefono" value="{{ $item->telefono }}" required>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
