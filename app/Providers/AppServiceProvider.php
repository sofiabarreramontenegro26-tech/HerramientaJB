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



class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UsuarioInterface::class, UsuarioRepository::class);
        $this->app->bind(RolInterface::class, RolRepository::class);
        $this->app->bind(HistorialActividadInterface::class, HistorialActividadRepository::class);
        $this->app->bind(CategoriaInterface::class, CategoriaRepository::class);
        $this->app->bind(ProveedorInterface::class, ProveedorRepository::class);
        $this->app->bind(ProductoInterface::class, ProductoRepository::class);
        $this->app->bind(EntradaInterface::class, EntradaRepository::class);
    }

    public function boot(): void
    {
        //
    }
}