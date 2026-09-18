<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Interfaces
use App\Interfaces\RolInterface;
use App\Interfaces\CategoriaInterface;
use App\Interfaces\ProveedorInterface;
use App\Interfaces\UsuarioInterface;
use App\Interfaces\HistorialActividadInterface;
use App\Interfaces\ProductoInterface;
use App\Interfaces\EntradaInterface;
use App\Interfaces\MovimientoInventarioInterface;
use App\Interfaces\ConfiguracionAlertaInterface;
use App\Interfaces\AlertaInventarioInterface;
use App\Interfaces\CatalogoBusquedaInterface;
use App\Interfaces\ProductoFavoritoInterface;
use App\Interfaces\CotizacionInterface;
use App\Interfaces\VentaInterface;
use App\Interfaces\MaquinaInterface;
use App\Interfaces\HojaVidaInterface;
use App\Interfaces\MantenimientoInterface;
use App\Interfaces\RegistroConectividadInterface;

// Repositorios
use App\Repositories\RolRepository;
use App\Repositories\CategoriaRepository;
use App\Repositories\ProveedorRepository;
use App\Repositories\UsuarioRepository;
use App\Repositories\HistorialActividadRepository;
use App\Repositories\ProductoRepository;
use App\Repositories\EntradaRepository;
use App\Repositories\MovimientoInventarioRepository;
use App\Repositories\ConfiguracionAlertaRepository;
use App\Repositories\AlertaInventarioRepository;
use App\Repositories\CatalogoBusquedaRepository;
use App\Repositories\ProductoFavoritoRepository;
use App\Repositories\CotizacionRepository;
use App\Repositories\VentaRepository;
use App\Repositories\MaquinaRepository;
use App\Repositories\HojaVidaRepository;
use App\Repositories\MantenimientoRepository;
use App\Repositories\RegistroConectividadRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // 01_roles
        $this->app->bind(RolInterface::class, RolRepository::class);

        // 02_categorias
        $this->app->bind(CategoriaInterface::class, CategoriaRepository::class);

        // 03_proveedores
        $this->app->bind(ProveedorInterface::class, ProveedorRepository::class);

        // 04_usuarios
        $this->app->bind(UsuarioInterface::class, UsuarioRepository::class);

        // 05_historial_actividades
        $this->app->bind(HistorialActividadInterface::class, HistorialActividadRepository::class);

        // 06_Productos
        $this->app->bind(ProductoInterface::class, ProductoRepository::class);

        // 07_entradas
        $this->app->bind(EntradaInterface::class, EntradaRepository::class);

        // 08_movimiento_inventario
        $this->app->bind(MovimientoInventarioInterface::class, MovimientoInventarioRepository::class);

        // 09_configuracion_alertas
        $this->app->bind(ConfiguracionAlertaInterface::class, ConfiguracionAlertaRepository::class);

        // 10_alertas_inventario
        $this->app->bind(AlertaInventarioInterface::class, AlertaInventarioRepository::class);

        // 11_catalogo_busquedas
        $this->app->bind(CatalogoBusquedaInterface::class, CatalogoBusquedaRepository::class);

        // 12_Productos_favoritos
        $this->app->bind(ProductoFavoritoInterface::class, ProductoFavoritoRepository::class);

        // 13_cotizaciones
        $this->app->bind(CotizacionInterface::class, CotizacionRepository::class);

        // 14_Ventas
        $this->app->bind(VentaInterface::class, VentaRepository::class);

        // 15_Maquinas
        $this->app->bind(MaquinaInterface::class, MaquinaRepository::class);

        // 16_Hoja_vidas
        $this->app->bind(HojaVidaInterface::class, HojaVidaRepository::class);

        // 17_Mantenimientos
        $this->app->bind(MantenimientoInterface::class, MantenimientoRepository::class);

        // 18_Registros_conectividad
        $this->app->bind(RegistroConectividadInterface::class, RegistroConectividadRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}