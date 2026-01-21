<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Ventas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('estilos/ventas.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/loading_effects.css') }}">
</head>
<body>

 <nav class="navbar navbar-expand-lg" style="background-color: black;">
        <div class="container-fluid">
            <!-- Botón para abrir el menú lateral -->
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon" style="color: white; filter: invert(1);"></span>
            </button>

            <h1 class="text-white fw-bold d-none d-md-block">Gestión de Ventas</h1>
            <span class="text-white fw-bold d-md-none">Ventas</span>

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

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-3 gap-2">
        <h2 class="fs-4 fs-md-2 mb-2 mb-md-0">Ventas</h2>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#registrarVentaModal">
            <i class="bi bi-cart4"></i> <span class="d-none d-md-inline">Registrar Venta</span><span class="d-md-none">Nueva</span>
        </button>
    </div>

    <div class="table-responsive">
    <table class="table table-bordered table-sm">
        <thead>
            <tr>
                <th>Número de Venta</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Cliente</th>
                <th>Productos</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="ventas-table-body">
            @foreach($dato as $item)
                <tr id="venta-{{ $item->id_venta }}">
                    <td>{{ $item->id_venta }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->fecha_venta)->format('d-m-Y') }}</td>
                    <td>{{ $item->total }}</td>
                    <td>{{ $item->cliente_nombre }}</td>
                    <td>{{ $item->productos_nombres }}</td>
                    <td>
                        <a href="{{ route('ventas.delete', $item->id_venta) }}" onclick="return Delete()" class="btn btn-danger btn-sm">
                            <i class="bi bi-journal-x"></i> Eliminar
                        </a>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#actualizarVentaModal" 
                                onclick="cargarDatosVenta({{ $item->id_venta }}, '{{ $item->fecha_venta }}', {{ $item->total }}, {{ $item->id_cliente }})">
                            <i class="bi bi-pencil-square"></i> Editar
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>

<!-- Modal Registrar Venta -->
<div class="modal fade" id="registrarVentaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="venta-form" action="{{ route('registrarCompra.create') }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Registrar Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cliente" class="form-label">Cliente</label>
                        <select class="form-select" id="cliente" name="cliente" required>
                            <option selected disabled>Selecciona un cliente</option>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div id="productos-container">
                        <div class="producto-item">
                            <div class="mb-3">
                                <label for="producto-1" class="form-label">Producto</label>
                                <select class="form-select" name="productos[]" id="producto-1" required>
                                    <option selected disabled>Selecciona un producto</option>
                                    @foreach($productos as $producto)
                                        <option value="{{ $producto->IdProducto }}" data-precio="{{ $producto->precio }}">
                                            {{ $producto->nombre }} - ${{ number_format($producto->precio,2) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="cantidad-1" class="form-label">Cantidad</label>
                                <input type="number" class="form-control" name="cantidades[]" id="cantidad-1" value="1" min="1" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="total" class="form-label">Total</label>
                        <input type="text" class="form-control" id="total" name="total" value="0.00" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Venta</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Actualizar Venta -->
<div class="modal fade" id="actualizarVentaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="actualizar-form" action="{{ route('ventas.update') }}" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="update-id-venta" name="txtid_venta">
                <div class="modal-header">
                    <h5 class="modal-title">Actualizar Venta</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="update-cliente" class="form-label">Cliente</label>
                        <select class="form-select" id="update-cliente" name="txtcliente" required>
                            @foreach($clientes as $cliente)
                                <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="update-fecha-venta" class="form-label">Fecha</label>
                        <input type="date" class="form-control" id="update-fecha-venta" name="txtfecha_venta" required>
                    </div>
                    <div class="mb-3">
                        <label for="update-total" class="form-label">Total</label>
                        <input type="text" class="form-control" id="update-total" name="txttotal" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Guardar Cambios</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function cargarDatosVenta(id_venta, fecha_venta, total, id_cliente){
    document.getElementById('update-id-venta').value = id_venta;
    document.getElementById('update-fecha-venta').value = fecha_venta;
    document.getElementById('update-total').value = total;
    document.getElementById('update-cliente').value = id_cliente;
}

document.getElementById('productos-container').addEventListener('change', actualizarTotal);
document.getElementById('productos-container').addEventListener('input', actualizarTotal);

function actualizarTotal() {
    let total = 0;
    document.querySelectorAll('.producto-item').forEach(item => {
        const productoSelect = item.querySelector('select[name="productos[]"]');
        const cantidadInput = item.querySelector('input[name="cantidades[]"]');
        const precio = parseFloat(productoSelect.options[productoSelect.selectedIndex].getAttribute('data-precio')) || 0;
        const cantidad = parseInt(cantidadInput.value, 10) || 0;
        total += precio * cantidad;
    });
    document.getElementById('total').value = total.toFixed(2);
}

function Delete() {
    return confirm('¿Estás seguro de eliminar esta venta?');
}

function resetForm() {
    document.getElementById('venta-form').reset();
    document.getElementById('total').value = "0.00";
}

document.getElementById('venta-form').addEventListener('submit', async function(e){
    e.preventDefault();
    const form = e.target;
    const formData = new FormData(form);
    const url = form.action;
    const submitBtn = form.querySelector('button[type="submit"]');
    
    // Si loaderUtils existe (del layout), lo usamos
    const loader = window.loaderUtils || { show: () => {}, hide: () => {} };
    loader.show(submitBtn);

    try{
        const response = await fetch(url, { method:'POST', body: formData, headers:{'X-Requested-With':'XMLHttpRequest'} });
        const data = await response.json();
        if(data.success){
            const venta = data.venta;
            const tbody = document.getElementById('ventas-table-body');
            const row = document.createElement('tr');
            row.id = `venta-${venta.id_venta}`;
            row.innerHTML = `
                <td>${venta.id_venta}</td>
                <td>${venta.fecha_venta}</td>
                <td>${venta.total}</td>
                <td>${venta.cliente_nombre}</td>
                <td>${venta.productos_nombres}</td>
                <td>
                    <a href="/ventas/delete/${venta.id_venta}" onclick="return Delete()" class="btn btn-danger btn-sm">
                        <i class="bi bi-journal-x"></i> Eliminar
                    </a>
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#actualizarVentaModal" 
                        onclick="cargarDatosVenta(${venta.id_venta}, '${venta.fecha_venta}', ${venta.total}, ${venta.id_cliente})">
                        <i class="bi bi-pencil-square"></i> Editar
                    </button>
                </td>
            `;
            tbody.appendChild(row);
            bootstrap.Modal.getInstance(document.getElementById('registrarVentaModal')).hide();
            resetForm();
            alert('Venta registrada correctamente');
        } else {
            alert((data.message || 'Error al registrar la venta') + (data.error ? ('\nDetalle: ' + data.error) : ''));
        }
    } catch(error){
        console.error('Error al registrar la venta:', error);
        alert('Hubo un error al registrar la venta. Intenta nuevamente.');
    } finally {
        loader.hide(submitBtn);
    }
});
</script>
<script src="{{ asset('js/ventas.js') }}"></script>
</body>
</html>
