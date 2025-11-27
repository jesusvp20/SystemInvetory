<?php

use App\Http\Controllers\InventarioController;
use App\Http\Controllers\ventasHistorialController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminProveedoresController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductosActivosController;
use App\Http\Controllers\ProveedoresActivosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ClientesActivosController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\FacturasController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\Auth\RecuperarContrasenaController;

// Redirigir al dashboard según el estado de autenticación
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard.index');
    }
    return redirect()->route('login');
});

Auth::routes();

// Ruta de prueba para verificar conexión a BD
Route::get('/test-db', function () {
    try {
        $pdo = \DB::connection()->getPdo();
        $users = \DB::table('users')->count();
        return "Conexión OK! Usuarios en BD: " . $users;
    } catch (\Exception $e) {
        return "Error de conexión: " . $e->getMessage();
    }
});

// Rutas para recuperar contraseña (sin autenticación)
Route::get('/recuperar-contrasena', [RecuperarContrasenaController::class, 'mostrarFormularioEmail'])->name('recuperar.email');
Route::post('/recuperar-contrasena/verificar', [RecuperarContrasenaController::class, 'verificarEmail'])->name('recuperar.verificar');
Route::post('/recuperar-contrasena/actualizar', [RecuperarContrasenaController::class, 'actualizarContrasena'])->name('recuperar.actualizar');

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {


        Route::get("/DashboardAdmin", [DashboardController::class, "index"])->name("dashboard.index");

        // Rutas para gestionar el inventario
        Route::get("/inventario", [InventarioController::class, "index"])->name("inventario.index");
        Route::get("/Registrar", function() { return redirect()->route('inventario.index'); }); // Redireccionar GET a inventario
        Route::post("/Registrar", [InventarioController::class, "create"])->name("inventario.create");
        Route::put("/Actualizar", [InventarioController::class, "update"])->name("inventario.update");
        Route::get("/Eliminar-{id}", [InventarioController::class, "delete"])->name("inventario.delete");
        Route::get("/Buscar", [InventarioController::class, "search"])->name("inventario.buscar");
        Route::get('/inventario/ordenar', [InventarioController::class, 'ordenar'])->name('inventario.ordenar');
        Route::post('/Cambiar-status/{id}', [InventarioController::class, 'cambiarStatus'])->name('Cambiar.status');

        // Rutas para gestionar proveedores
        Route::get('/AdminProveedoresView', [AdminProveedoresController::class, 'index'])->name('AdminProveedores.index');
        Route::post("/RegistrarProveedores", [AdminProveedoresController::class, "create"])->name("AdminProveedores.create");
        Route::put("/actualizar", [AdminProveedoresController::class, "update"])->name('AdminProveedores.update');
        Route::get('/ProveedorEliminar-{id}', [AdminProveedoresController::class, 'delete'])->name('AdminProveedores.delete');
        Route::post('/cambiar-estado/{id}', [AdminProveedoresController::class, 'cambiarEstado'])->name('cambiar.estado');

        // Rutas para clientes
        Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
        Route::post("/RegistrarCliente", [ClientesController::class, "create"])->name("clientes.create");
        Route::put("/ActualizarCliente", [ClientesController::class, "update"])->name('clientes.update');
        Route::get("/ClienteEliminar-{id}", [ClientesController::class, "delete"])->name("cliente.delete");
        Route::get('/ordenarCliente', [ClientesController::class, 'OrdenarClientes'])->name('cliente.ordenar');

        // Rutas para ver clientes activos
        Route::get('/ClientesActivos', [ClientesActivosController::class, 'index'])->name('clientesActivos.index');
        Route::post('/cambiar-status/{id}', [ClientesController::class, 'CambiarEstadoCliente'])->name('cambiar.EstadoCliente');

        // Rutas de reportes
        Route::get('/ReporteView', [ReporteController::class, 'index'])->name('reporte.index');

        // Facturas
        Route::get('/facturas', [FacturasController::class, 'index'])->name('facturas.index');
        Route::post('/facturas', [FacturasController::class, 'store'])->name('facturas.store');
        Route::get('/facturas/{id}/pdf', [FacturasController::class, 'generarPDF'])->name('facturas.pdf');



        // Vista de los productos activos
        Route::get("/ProductosActivos", [ProductosActivosController::class, "index"])->name("ProductosActivos.index");

        // Vista de proveedores activos
        Route::get("/ProveedoresActivos", [ProveedoresActivosController::class, "index"])->name("ProveedoresActivos.index");

        // Rutas para clientes activos
        Route::get('/ClientesActivos', [ClientesActivosController::class, 'index'])->name('clientesActivos.index');

        // Ver reportes (si es necesario)
        Route::get('/ReporteView', [ReporteController::class, 'index'])->name('reporte.index');
        //ver ventas
        Route::get('/ventas', [VentasController::class, 'index'])->name('Ventas.index');

        // Registrar venta
        Route::post('/RegistrarVenta', [VentasController::class, 'registrarCompra'])->name('registrarCompra.create');
        //eliminar venta
        Route::get('ventas/delete/{id}', [VentasController::class, 'deleteShop'])->name('ventas.delete');
         //actualizar venta
         Route::put('ventas/update', [VentasController::class, 'update'])->name('ventas.update');
        //historial de busqueda
        route::get('/ventasHistorial',[ventasHistorialController::class, 'index'])->name('ventasHistorial.index');
        
        });
