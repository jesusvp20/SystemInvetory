<!doctype html>
<html lang="en">
<head>
    <title>Dashboard</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous" />
    <style>
        .card {
            margin: 10px 0;
            transition: transform 0.2s;
            height: 100%;
            width: 100%;
            margin: 5px;
            padding: 50px;
            border-radius: 10px;
        }
        .card:hover {
            transform: scale(1.05);

        }
    </style>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Dashboard Principal</a>
            <button onclick="confirmLogout()" class="btn btn-danger ms-auto">Cerrar Sesión</button>
            <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Gestionar Inventario</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('ProductosActivos.index')}}">Ver productos activos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('ProveedoresActivos.index')}}">Ver Proveedores activos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Ver clientes activos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container mt-5 pt-5">
        <div class="row" >
            <div class="col-md-4">
                <div class="card">
                    <img src="https://cdn-icons-png.freepik.com/256/12201/12201509.png?semt=ais_hybrid" class="card-img-top" alt="Inventario">
                    <div class="card-body text-center">
                        <h5 class="card-title">Administrar Inventario</h5>
                        <p class="card-text">Gestiona tus productos de manera eficiente.</p>
                        <p class="card-text"><strong>Total Productos: {{ $totalProductos }}</strong></p>
                        <a href="{{ route('inventario.index') }}" class="btn btn-primary">Ir a Inventario</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 "  class="row mt-4" height="50%" wigth="50%">
                <div class="card">
                    <img src="https://cdn-icons-png.flaticon.com/512/860/860800.png" class="card-img-top" alt="Proveedores">
                    <div class="card-body text-center">
                        <h5 class="card-title">Administrar Proveedores</h5>
                        <p class="card-text">Gestiona la información de tus proveedores.</p>
                        <p class="card-text"><strong>Total Proveedores: {{ $totalProveedores }}</strong></p>
                        <a href="{{ route('AdminProveedores.index') }}" class="btn btn-primary">Ir a Proveedores</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://cdn-icons-png.flaticon.com/512/174/174188.png" class="card-img-top" alt="Clientes">
                    <div class="card-body text-center">
                        <h5 class="card-title">Clientes</h5>
                        <p class="card-text">Gestionar clientes</p>
                        <p class="card-text"><strong>Total De Clientes: {{ $totalClientes }}</strong></p>
                        <a href="{{route('clientes.index')}}" class="btn btn-primary">Ir a Clientes</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4" height="50%" wigth="50%">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://cdn-icons-png.flaticon.com/512/1364/1364841.png" class="card-img-top" alt="Reportes">
                    <div class="card-body text-center">
                        <h5 class="card-title">Reportes</h5>
                        <p class="card-text">Genera reportes del inventario y ventas.</p>
                        <a href="{{route('reporte.index')}}" class="btn btn-primary">Ver Reportes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://cdn-icons-png.flaticon.com/512/2557/2557649.png" class="card-img-top" alt="Facturas">
                    <div class="card-body text-center">
                        <h5 class="card-title">Facturas</h5>
                        <p class="card-text">Genera facturas.</p>
                        <a href="{{route('facturas.index')}}" class="btn btn-primary">Ver Facturas</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://static.vecteezy.com/system/resources/previews/014/811/040/non_2x/sale-line-icon-vector.jpg" class="card-img-top" alt="Ventas">
                    <div class="card-body text-center">
                        <h5 class="card-title">Ventas</h5>
                        <p class="card-text">Gestionar ventas.</p>
                        <p class="card-text" ><strong> Total de ventas: {{$totalVentas}}</strong> </p>
                        <a href="{{ route('Ventas.index') }}" class="btn btn-primary">a Ventas</a>
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
</body>
</html>
