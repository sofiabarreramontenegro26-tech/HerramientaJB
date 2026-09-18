<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\HistorialActividadController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ProductoFavoritoController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\MaquinaController;
use App\Http\Controllers\HojaVidaController;
use App\Http\Controllers\MantenimientoController;
use App\Http\Controllers\RegistroConectividadController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\MovimientoInventarioController;
use App\Http\Controllers\ConfiguracionAlertaController;
use App\Http\Controllers\AlertaInventarioController;
use App\Http\Controllers\CatalogoBusquedaController;

Route::apiResource('usuarios', UsuarioController::class);
Route::apiResource('roles', RolController::class);
Route::apiResource('productos', ProductoController::class);
Route::apiResource('historial-actividades', HistorialActividadController::class);
Route::apiResource('categorias', CategoriaController::class);
Route::apiResource('proveedores', ProveedorController::class);
Route::apiResource('productos-favoritos', ProductoFavoritoController::class);
Route::apiResource('cotizaciones', CotizacionController::class);
Route::apiResource('ventas', VentaController::class);
Route::apiResource('maquinas', MaquinaController::class);
Route::apiResource('hojas-vida', HojaVidaController::class);
Route::apiResource('mantenimientos', MantenimientoController::class);
Route::apiResource('registros-conectividad', RegistroConectividadController::class);
Route::apiResource('entradas', EntradaController::class);
Route::apiResource('movimientos-inventario', MovimientoInventarioController::class);
Route::apiResource('configuracion-alertas', ConfiguracionAlertaController::class);
Route::apiResource('alertas-inventario', AlertaInventarioController::class);
Route::apiResource('catalogo-busquedas', CatalogoBusquedaController::class);

Route::put('/roles/{rol}', [RolController::class, 'update']);
Route::patch('/roles/{rol}', [RolController::class, 'update']);

Route::put('/usuarios/{usuario}', [UsuarioController::class, 'update']);
Route::patch('/usuarios/{usuario}', [UsuarioController::class, 'update']);

Route::put('/historial-actividades/{historial_actividad}', [HistorialActividadController::class, 'update']);
Route::patch('/historial-actividades/{historial_actividad}', [HistorialActividadController::class, 'update']);

Route::put('/categorias/{categoria}', [CategoriaController::class, 'update']);
Route::patch('/categorias/{categoria}', [CategoriaController::class, 'update']);

Route::put('/proveedores/{proveedor}', [ProveedorController::class, 'update']);
Route::patch('/proveedores/{proveedor}', [ProveedorController::class, 'update']);

Route::put('/productos/{producto}', [ProductoController::class, 'update']);
Route::patch('/productos/{producto}', [ProductoController::class, 'update']);

Route::put('/entradas/{entrada}', [EntradaController::class, 'update']);
Route::patch('/entradas/{entrada}', [EntradaController::class, 'update']);

Route::put('/movimientos-inventario/{movimiento-inventario}', [MovimientoInventarioController::class, 'update']);
Route::patch('/movimientos-inventario/{movimiento-inventario}', [MovimientoInventarioController::class, 'update']);

Route::put('/configuracion-alertas/{configuracion-alerta}', [ConfiguracionAlertaController::class, 'update']);
Route::patch('/configuracion-alertas/{configuracion-alerta}', [ConfiguracionAlertaController::class, 'update']);

Route::put('/alertas-inventario/{alerta-inventario}', [AlertaInventarioController::class, 'update']);
Route::patch('/alertas-inventario/{alerta-inventario}', [AlertaInventarioController::class, 'update']);

Route::put('/catalogo-busquedas/{catalogo-busqueda}', [CatalogoBusquedaController::class, 'update']);
Route::patch('/catalogo-busquedas/{catalogo-busqueda}', [CatalogoBusquedaController::class, 'update']);




