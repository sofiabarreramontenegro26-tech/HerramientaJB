@php
    $usuario = auth()->user();
    $esAdmin = $usuario->esAdministrador();
    $alertasPendientes = \App\Models\AlertaInventario::noLeidas()->count();

    $menu = [
        'General' => [
            ['ruta' => 'dashboard', 'activo' => 'dashboard', 'texto' => 'Panel', 'icono' => 'tablero', 'admin' => false],
        ],
        'Inventario' => [
            ['ruta' => 'productos.index', 'activo' => 'productos.*', 'texto' => 'Productos', 'icono' => 'producto', 'admin' => false],
            ['ruta' => 'categorias.index', 'activo' => 'categorias.*', 'texto' => 'Categorías', 'icono' => 'categoria', 'admin' => true],
            ['ruta' => 'proveedores.index', 'activo' => 'proveedores.*', 'texto' => 'Proveedores', 'icono' => 'proveedor', 'admin' => true],
            ['ruta' => 'entradas.index', 'activo' => 'entradas.*', 'texto' => 'Entradas', 'icono' => 'entrada', 'admin' => true],
            ['ruta' => 'movimientos.index', 'activo' => 'movimientos.*', 'texto' => 'Movimientos', 'icono' => 'movimientos', 'admin' => false],
            ['ruta' => 'alertas.index', 'activo' => 'alertas.*', 'texto' => 'Alertas', 'icono' => 'campana', 'admin' => false, 'contador' => $alertasPendientes],
        ],
        'Taller' => [
            ['ruta' => 'maquinas.index', 'activo' => ['maquinas.*', 'hojas-vida.*'], 'texto' => 'Máquinas', 'icono' => 'maquina', 'admin' => false],
            ['ruta' => 'mantenimientos.index', 'activo' => 'mantenimientos.*', 'texto' => 'Mantenimientos', 'icono' => 'llave', 'admin' => false],
        ],
        'Costeo y facturación' => [
            ['ruta' => 'cotizaciones.index', 'activo' => 'cotizaciones.*', 'texto' => 'Cotizaciones', 'icono' => 'cotizacion', 'admin' => true],
            ['ruta' => 'ventas.index', 'activo' => 'ventas.*', 'texto' => 'Ventas', 'icono' => 'venta', 'admin' => true],
        ],
        'Administración' => [
            ['ruta' => 'usuarios.index', 'activo' => 'usuarios.*', 'texto' => 'Usuarios', 'icono' => 'usuarios', 'admin' => true],
            ['ruta' => 'historial.index', 'activo' => 'historial.*', 'texto' => 'Historial', 'icono' => 'historial', 'admin' => true],
        ],
    ];
@endphp
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('titulo', 'Panel') · HerramientaJB</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&family=Barlow+Condensed:wght@500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen">
    {{-- Fondo oscuro del menú en celulares --}}
    <div id="menu-fondo" class="fixed inset-0 z-30 hidden bg-black/60 lg:hidden print:hidden"></div>

    {{-- Menú lateral --}}
    <aside id="menu-lateral" class="fixed inset-y-0 left-0 z-40 flex w-64 -translate-x-full flex-col border-r border-slate-800 bg-slate-950 transition-transform lg:translate-x-0 print:hidden">
        <div class="franja-peligro h-1.5 w-full"></div>

        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-5 py-5">
            <div class="grid size-10 place-items-center rounded-md bg-industrial text-slate-950">
                <x-icono nombre="llave" tam="size-5" />
            </div>
            <div class="leading-tight">
                <p class="font-display text-xl font-bold tracking-wide text-slate-50 uppercase">Herramienta<span class="text-industrial">JB</span></p>
                <p class="text-[11px] tracking-wider text-slate-500 uppercase">Taller electromecánico</p>
            </div>
        </a>

        <nav class="flex-1 overflow-y-auto px-3 pb-6">
            @foreach ($menu as $seccion => $enlaces)
                @php $visibles = array_filter($enlaces, fn ($e) => ! $e['admin'] || $esAdmin); @endphp
                @continue(empty($visibles))

                <p class="nav-seccion">{{ $seccion }}</p>
                <div class="space-y-0.5">
                    @foreach ($visibles as $enlace)
                        <a href="{{ route($enlace['ruta']) }}" @class(['nav-link', 'nav-link-activo' => request()->routeIs($enlace['activo'])])>
                            <x-icono :nombre="$enlace['icono']" />
                            <span class="flex-1">{{ $enlace['texto'] }}</span>
                            @if (! empty($enlace['contador']))
                                <span class="rounded bg-red-500 px-1.5 py-0.5 font-mono text-[10px] font-bold text-white">{{ $enlace['contador'] }}</span>
                            @endif
                        </a>
                    @endforeach
                </div>
            @endforeach
        </nav>

        <div class="border-t border-slate-800 p-4">
            <div class="flex items-center gap-3">
                <div class="grid size-9 place-items-center rounded-md bg-slate-800 font-display text-sm font-bold text-industrial">
                    {{ $usuario->getIniciales() }}
                </div>
                <div class="min-w-0 flex-1">
                    <p class="truncate text-sm font-semibold text-slate-200">{{ $usuario->nombre_completo }}</p>
                    <p class="text-xs text-slate-500">{{ $usuario->rol?->nombre }}</p>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="rounded-md p-2 text-slate-500 hover:bg-slate-800 hover:text-red-400" title="Cerrar sesión" aria-label="Cerrar sesión">
                        <x-icono nombre="salir" />
                    </button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Contenido --}}
    <div class="lg:pl-64 print:pl-0">
        <header class="sticky top-0 z-20 flex items-center gap-3 border-b border-slate-800 bg-acero/90 px-4 py-3 backdrop-blur lg:hidden print:hidden">
            <button type="button" data-abrir-menu class="rounded-md p-2 text-slate-300 hover:bg-slate-800" aria-label="Abrir menú">
                <x-icono nombre="menu" tam="size-5" />
            </button>
            <p class="font-display text-lg font-bold tracking-wide uppercase">Herramienta<span class="text-industrial">JB</span></p>
        </header>

        <main class="fondo-rejilla min-h-screen px-4 py-6 sm:px-6 lg:px-10 lg:py-8 print:bg-none print:p-0">
            <div class="mx-auto max-w-7xl">
                @include('partials.mensajes')
                @yield('contenido')
            </div>
        </main>
    </div>
</body>
</html>
