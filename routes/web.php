<?php

use App\Http\Controllers\InventarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminProveedoresController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductosActivosController;
use App\Http\Controllers\ProveedoresActivosController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ClientesActivosController;
use App\Http\Controllers\ReporteController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('inventario.index');
    }
    return redirect()->route('login');
});

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get("/inventario", [InventarioController::class, "index"])->name("inventario.index");

    // Registrar un nuevo elemento en inventario
    Route::post("/Registrar", [InventarioController::class, "create"])->name("inventario.create");

    // Actualizar un elemento de inventario
    Route::put("/Actualizar", [InventarioController::class, "update"])->name("inventario.update");

    // Eliminar un elemento de inventario
    Route::get("/Eliminar-{id}", [InventarioController::class, "delete"])->name("inventario.delete");

    // Buscar elementos en el inventario
    Route::get("/Buscar", [InventarioController::class, "search"])->name("inventario.buscar");

    // Ordenar elementos en el inventario
    Route::get('/inventario/ordenar', [InventarioController::class, 'ordenar'])->name('inventario.ordenar');

    // Vista de proveedores
    Route::get('/AdminProveedoresView', [AdminProveedoresController::class, 'index'])->name('AdminProveedores.index');

    // Registrar proveedor
    Route::post("/RegistrarProveedores", [AdminProveedoresController::class, "create"])->name("AdminProveedores.create");

    // Actualizar un proveedor
    Route::put("/actualizar", [AdminProveedoresController::class, "update"])->name('AdminProveedores.update');

    // Eliminar proveedor
    Route::get('/ProveedorEliminar-{id}', [AdminProveedoresController::class, 'delete'])->name('AdminProveedores.delete');

    // Vista del dashboard
    Route::get("/DashboradView", [DashboardController::class, "index"])->name("dashboard.index");

    // Vista de los productos activos
    Route::get("/ProductosActivos", [ProductosActivosController::class, "index"])->name("ProductosActivos.index");

    // Vista de los proveedores activos
    Route::get("/ProveedoresActivos", [ProveedoresActivosController::class, "index"])->name("ProveedoresActivos.index");

    // Cambiar estado de proveedores
    Route::post('/cambiar-estado/{id}', [AdminProveedoresController::class, 'cambiarEstado'])->name('cambiar.estado');

    // Cambiar estado de productos
    Route::get('/cambiar-status/{id}', [InventarioController::class, 'CambiarStatus'])->name('cambiar.status');

    // Vista de clientes
    Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');

    // Registrar cliente
    Route::post("/RegistrarCliente", [ClientesController::class, "create"])->name("clientes.create");

    // Actualizar cliente
    Route::put("/ActualizarCliente", [ClientesController::class, "update"])->name('clientes.update');

    // Eliminar cliente
    Route::get("/ClienteEliminar-{id}", [ClientesController::class, "delete"])->name("cliente.delete");

    // Ordenar cliente
    Route::get('/ordenarCliente', [ClientesController::class, 'OrdenarClientes'])->name('cliente.ordenar');

    // Vista de clientes activos
    Route::get('/ClientesActivos', [ClientesActivosController::class, 'index'])->name('clientesActivos.index');

    // Cambiar estado de clientes activos
    Route::post('/cambiar-status/{id}', [ClientesController::class, 'CambiarEstadoCliente'])->name('cambiar.EstadoCliente');

    // Vista de reportes
    Route::get('/ReporteView', [ReporteController::class, 'index'])->name('reporte.index');
    Route::post('/subir-archivo/store', [ReporteController::class, 'store'])->name('reporte.archivo');
});
