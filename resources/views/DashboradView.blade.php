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
            <button onclick="confirmLogout()" class="btn btn-danger btn-sm ms-auto">Salir</button>
            <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Gestionar Inventario</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('ProductosActivos.index')}}"><i class="bi bi-file-earmark-spreadsheet"></i> Ver productos activos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('ProveedoresActivos.index')}}"><i class="bi bi-person-vcard-fill"></i> Ver Proveedores activos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('clientesActivos.index')}}"><i class="bi bi-person-check-fill"></i>Ver clientes activos</a>
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
        <div class="row g-3 g-md-4">
            <div class="col-6 col-md-4">
                <div class="card h-100">
                    <img src="https://cdn-icons-png.freepik.com/256/12201/12201509.png?semt=ais_hybrid" class="card-img-top p-3" alt="Inventario">
                    <div class="card-body text-center">
                        <h6 class="card-title">Inventario</h6>
                        <p class="card-text d-none d-md-block">Gestiona tus productos.</p>
                        <p class="card-text"><strong>{{ $totalProductos }}</strong> <small>productos</small></p>
                        <a href="{{ route('inventario.index') }}" class="btn btn-primary btn-lg px-5 py-2"><i class="bi bi-arrow-right-circle me-1"></i> Ir</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="card h-100">
                    <img src="https://cdn-icons-png.flaticon.com/512/860/860800.png" class="card-img-top p-3" alt="Proveedores">
                    <div class="card-body text-center">
                        <h6 class="card-title">Proveedores</h6>
                        <p class="card-text d-none d-md-block">Gestiona proveedores.</p>
                        <p class="card-text"><strong>{{ $totalProveedores }}</strong> <small>proveedores</small></p>
                        <a href="{{ route('AdminProveedores.index') }}" class="btn btn-primary btn-lg px-5 py-2"><i class="bi bi-arrow-right-circle me-1"></i> Ir</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="card h-100">
                    <img src="https://cdn-icons-png.flaticon.com/512/174/174188.png" class="card-img-top p-3" alt="Clientes">
                    <div class="card-body text-center">
                        <h6 class="card-title">Clientes</h6>
                        <p class="card-text d-none d-md-block">Gestionar clientes.</p>
                        <p class="card-text"><strong>{{ $totalClientes }}</strong> <small>clientes</small></p>
                        <a href="{{route('clientes.index')}}" class="btn btn-primary btn-lg px-5 py-2"><i class="bi bi-arrow-right-circle me-1"></i> Ir</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="card h-100">
                    <img src="https://cdn-icons-png.flaticon.com/512/1364/1364841.png" class="card-img-top p-3" alt="Reportes">
                    <div class="card-body text-center">
                        <h6 class="card-title">Reportes</h6>
                        <p class="card-text d-none d-md-block">Genera reportes.</p>
                        <a href="{{route('reporte.index')}}" class="btn btn-primary btn-lg px-5 py-2"><i class="bi bi-eye me-1"></i> Ver</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="card h-100">
                    <img src="https://cdn-icons-png.flaticon.com/512/2557/2557649.png" class="card-img-top p-3" alt="Facturas">
                    <div class="card-body text-center">
                        <h6 class="card-title">Facturas</h6>
                        <p class="card-text d-none d-md-block">Genera facturas.</p>
                        <a href="{{route('facturas.index')}}" class="btn btn-primary btn-lg px-5 py-2"><i class="bi bi-file-text me-1"></i> Ver</a>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4">
                <div class="card h-100">
                    <img src="https://static.vecteezy.com/system/resources/previews/014/811/040/non_2x/sale-line-icon-vector.jpg" class="card-img-top p-3" alt="Ventas">
                    <div class="card-body text-center">
                        <h6 class="card-title">Ventas</h6>
                        <p class="card-text d-none d-md-block">Gestionar ventas.</p>
                        <p class="card-text"><strong>{{$totalVentas}}</strong> <small>ventas</small></p>
                        <a href="{{ route('Ventas.index') }}" class="btn btn-primary btn-lg px-5 py-2"><i class="bi bi-cart3 me-1"></i> Ir</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form id="logout-form" method="POST" action="/logout" style="display: none;">
        @csrf
    </form>

    <script>
        function confirmLogout() {
            if (confirm("¿Estás seguro de que deseas cerrar sesión?")) {
                document.getElementById('logout-form').submit();
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
