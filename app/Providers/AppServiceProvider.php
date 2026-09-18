<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Interfaces
use App\Interfaces\UsuarioInterface;
use App\Interfaces\RolInterface;
use App\Interfaces\HistorialActividadInterface;
use App\Interfaces\CategoriaInterface;
use App\Interfaces\ProveedorInterface;
use App\Interfaces\ProductoInterface;


// Repositorios
use App\Repositories\UsuarioRepository;
use App\Repositories\RolRepository;
use App\Repositories\HistorialActividadRepository;
use App\Repositories\CategoriaRepository;
use App\Repositories\ProveedorRepository;
use App\Repositories\ProductoRepository;


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