<!doctype html>
<html lang="en">
<head>
    <title>Subir Archivo</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container mt-4">
        <h1 class="mb-4">Productos en Stock</h1>
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
                </tr>
                @endforeach
            </tbody>
        </table>

        <h3 class="mt-5">Cantidad de Productos Disponibles</h3>
        <canvas id="productosChart" width="400" height="200"></canvas>
    </div>

    <script>
        // Obtener los datos de PHP
        var productos = @json($producto);

        var nombres = productos.map(function(producto) {
            return producto.nombre;
        });
        var cantidades = productos.map(function(producto) {
            return producto.cantidad_disponible;
        });

        // Configurar el gráfico
        var ctx = document.getElementById('productosChart').getContext('2d');
        var productosChart = new Chart(ctx, {
            type: 'bar', // Tipo de gráfico: 'bar' para barras
            data: {
                labels: nombres, // Etiquetas en el eje X
                datasets: [{
                    label: 'Cantidad Disponible',
                    data: cantidades, // Datos del eje Y
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Color de las barras
                    borderColor: 'rgba(75, 192, 192, 1)', // Color del borde
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true // Comenzar el eje Y desde cero
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
