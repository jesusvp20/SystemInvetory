<!doctype html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="{{ asset('estilos/dashboard.css') }}" />
</head>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand d-none d-sm-block" href="#">Dashboard Principal</a>
            <a class="navbar-brand d-sm-none" href="#">Dashboard</a>
            <button data-bs-toggle="modal" data-bs-target="#logoutModal" class="btn btn-danger btn-sm ms-auto"><i class="bi bi-box-arrow-right me-1"></i> Cerrar sesión</button>
            <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Gestionar Inventario</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('ProductosActivos.index')}}"><i class="bi bi-box-seam"></i> Ver productos activos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('ProveedoresActivos.index')}}"><i class="bi bi-truck"></i> Ver Proveedores activos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('clientesActivos.index')}}"><i class="bi bi-people"></i> Ver clientes activos</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('ventasHistorial.index')}}" class="nav-link">
                                <i class="bi bi-clock-history"></i>   Ver historial de compras
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-4 px-3 px-md-4">
        <div class="row mb-4">
            <div class="col">
                <h1 class="h2">Bienvenido, {{ Auth::user()->name }}!</h1>
                <p>Aquí tienes un resumen de tu sistema de inventario.</p>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="card card-productos h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-box-seam card-icon me-3"></i>
                        <div>
                            <div class="contador">{{ $totalProductos }}</div>
                            <div class="text-uppercase">Productos</div>
                        </div>
                        <a href="{{ route('inventario.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card card-proveedores h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-truck card-icon me-3"></i>
                        <div>
                            <div class="contador">{{ $totalProveedores }}</div>
                            <div class="text-uppercase">Proveedores</div>
                        </div>
                        <a href="{{ route('AdminProveedores.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card card-clientes h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-people card-icon me-3"></i>
                        <div>
                            <div class="contador">{{ $totalClientes }}</div>
                            <div class="text-uppercase">Clientes</div>
                        </div>
                        <a href="{{route('clientes.index')}}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card card-ventas h-100">
                    <div class="card-body d-flex align-items-center">
                        <i class="bi bi-cash-coin card-icon me-3"></i>
                        <div>
                            <div class="contador">{{$totalVentas}}</div>
                            <div class="text-uppercase">Ventas</div>
                        </div>
                        <a href="{{ route('Ventas.index') }}" class="stretched-link"></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4 mt-2">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header">
                        Resumen General
                    </div>
                    <div class="card-body">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">Accesos Directos</div>
                    <div class="list-group list-group-flush">
                        <a href="{{route('reporte.index')}}" class="list-group-item list-group-item-action"><i class="bi bi-file-earmark-bar-graph me-2"></i> Reportes</a>
                        <a href="{{route('facturas.index')}}" class="list-group-item list-group-item-action"><i class="bi bi-file-text me-2"></i> Facturas</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="logoutModalLabel">Confirmar Cierre de Sesión</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            ¿Estás seguro de que deseas cerrar sesión?
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <form id="logout-form" method="POST" action="/logout">
                @csrf
                <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Productos', 'Proveedores', 'Clientes', 'Ventas'],
                datasets: [{
                    label: 'Total de Registros',
                    data: [{{ $totalProductos }}, {{ $totalProveedores }}, {{ $totalClientes }}, {{ $totalVentas }}],
                    backgroundColor: [
                        'rgba(102, 126, 234, 0.8)',
                        'rgba(240, 147, 251, 0.8)',
                        'rgba(79, 172, 254, 0.8)',
                        'rgba(67, 233, 123, 0.8)'
                    ],
                    borderColor: [
                        '#667eea',
                        '#f093fb',
                        '#4facfe',
                        '#43e97b'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
