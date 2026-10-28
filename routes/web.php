<?php

use App\Http\Controllers\Web\AlertaController;
use App\Http\Controllers\Web\Auth\LoginController;
use App\Http\Controllers\Web\CategoriaController;
use App\Http\Controllers\Web\CotizacionController;
use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\EntradaController;
use App\Http\Controllers\Web\HistorialController;
use App\Http\Controllers\Web\HojaVidaController;
use App\Http\Controllers\Web\MantenimientoController;
use App\Http\Controllers\Web\MaquinaController;
use App\Http\Controllers\Web\MovimientoController;
use App\Http\Controllers\Web\ProductoController;
use App\Http\Controllers\Web\ProveedorController;
use App\Http\Controllers\Web\UsuarioController;
use App\Http\Controllers\Web\VentaController;
use App\Http\Middleware\VerificarRol;
use App\Models\Rol;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Acceso público (solo para quien NO ha iniciado sesión)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->middleware('throttle:5,1')->name('login.store');
});

/*
|--------------------------------------------------------------------------
| Rutas con sesión iniciada
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

    /*
    |----------------------------------------------------------------------
    | Solo ADMINISTRADOR
    | Van primero para que /maquinas/create no se confunda con /maquinas/{id}.
    |----------------------------------------------------------------------
    */
    Route::middleware(VerificarRol::class . ':' . Rol::ADMINISTRADOR)->group(function () {
        Route::resource('productos', ProductoController::class)
            ->except(['index', 'show'])
            ->parameters(['productos' => 'producto']);

        Route::resource('categorias', CategoriaController::class)
            ->except(['create', 'show'])
            ->parameters(['categorias' => 'categoria']);

        Route::resource('proveedores', ProveedorController::class)
            ->except(['show'])
            ->parameters(['proveedores' => 'proveedor']);

        Route::get('/entradas', [EntradaController::class, 'index'])->name('entradas.index');
        Route::get('/entradas/create', [EntradaController::class, 'create'])->name('entradas.create');
        Route::post('/entradas', [EntradaController::class, 'store'])->name('entradas.store');

        Route::resource('cotizaciones', CotizacionController::class)
            ->except(['edit', 'update'])
            ->parameters(['cotizaciones' => 'cotizacion']);

        Route::resource('ventas', VentaController::class)
            ->only(['index', 'create', 'store', 'show'])
            ->parameters(['ventas' => 'venta']);

        Route::resource('maquinas', MaquinaController::class)
            ->only(['create', 'store', 'edit', 'update', 'destroy'])
            ->parameters(['maquinas' => 'maquina']);

        Route::delete('/mantenimientos/{mantenimiento}', [MantenimientoController::class, 'destroy'])->name('mantenimientos.destroy');

        Route::resource('usuarios', UsuarioController::class)
            ->except(['show'])
            ->parameters(['usuarios' => 'usuario']);

        Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');
    });

    /*
    |----------------------------------------------------------------------
    | ADMINISTRADOR y TÉCNICO
    |----------------------------------------------------------------------
    */
    Route::middleware(VerificarRol::class . ':' . Rol::ADMINISTRADOR . ',' . Rol::TECNICO)->group(function () {
        Route::get('/', DashboardController::class)->name('dashboard');

        Route::get('/productos', [ProductoController::class, 'index'])->name('productos.index');

        Route::get('/movimientos', [MovimientoController::class, 'index'])->name('movimientos.index');
        Route::get('/movimientos/salida', [MovimientoController::class, 'create'])->name('movimientos.create');
        Route::post('/movimientos/salida', [MovimientoController::class, 'store'])->name('movimientos.store');

        Route::get('/alertas', [AlertaController::class, 'index'])->name('alertas.index');
        Route::patch('/alertas/leer-todas', [AlertaController::class, 'marcarTodas'])->name('alertas.leer-todas');
        Route::patch('/alertas/{alerta}/leer', [AlertaController::class, 'marcarLeida'])->name('alertas.leer');

        Route::get('/maquinas', [MaquinaController::class, 'index'])->name('maquinas.index');
        Route::get('/maquinas/{maquina}', [MaquinaController::class, 'show'])->whereNumber('maquina')->name('maquinas.show');

        Route::get('/maquinas/{maquina}/hoja-vida', [HojaVidaController::class, 'edit'])->name('hojas-vida.edit');
        Route::put('/maquinas/{maquina}/hoja-vida', [HojaVidaController::class, 'update'])->name('hojas-vida.update');

        Route::resource('mantenimientos', MantenimientoController::class)
            ->only(['index', 'create', 'store', 'edit', 'update'])
            ->parameters(['mantenimientos' => 'mantenimiento']);
    });
});
