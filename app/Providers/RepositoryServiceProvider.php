<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\RolInterface;
use App\Interfaces\UsuarioInterface;
use App\Repositories\HistorialActividadRepository;
use App\Repositories\CategoriaRepository;
use App\Interfaces\ProveedorInterface;
use App\Repositories\ProductoRepository;

use App\Repositories\RolRepository;
use App\Repositories\UsuarioRepository;
use App\Interfaces\HistorialActividadInterface;
use App\Interfaces\CategoriaInterface;
use App\Repositories\ProveedorRepository;
use App\Interfaces\ProductoInterface;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(RolInterface::class, RolRepository::class);
        $this->app->bind(UsuarioInterface::class, UsuarioRepository::class);
        $this->app->bind(HistorialActividadInterface::class, HistorialActividadRepository::class);
        $this->app->bind(CategoriaInterface::class, CategoriaRepository::class);
        $this->app->bind(ProveedorInterface::class, ProveedorRepository::class);
        $this->app->bind(ProductoInterface::class, ProductoRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}