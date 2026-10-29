<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión · HerramientaJB</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@400;500;600;700&family=Barlow+Condensed:wght@500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="fondo-rejilla min-h-screen">
    <div class="grid min-h-screen lg:grid-cols-2">
        {{-- Lado de marca --}}
        <section class="relative hidden flex-col justify-between overflow-hidden border-r border-slate-800 bg-slate-950 p-12 lg:flex">
            <div class="franja-peligro absolute inset-x-0 top-0 h-2"></div>

            <div class="flex items-center gap-3">
                <div class="grid size-11 place-items-center rounded-md bg-industrial text-slate-950">
                    <x-icono nombre="llave" tam="size-6" />
                </div>
                <p class="font-display text-2xl font-bold tracking-wide uppercase">Herramienta<span class="text-industrial">JB</span></p>
            </div>

            <div>
                <p class="font-mono text-xs tracking-[0.3em] text-industrial uppercase">Sistema de gestión</p>
                <h1 class="mt-4 font-display text-6xl leading-[0.95] font-bold tracking-tight text-slate-50 uppercase">
                    Control total<br>del taller,<br><span class="text-industrial">sin papeles.</span>
                </h1>
                <p class="mt-6 max-w-md text-slate-400">
                    Inventario de repuestos, hojas de vida de maquinaria, mantenimientos, cotizaciones y ventas en un solo lugar.
                </p>
            </div>

            <div class="flex items-center gap-6 font-mono text-xs text-slate-600">
                <span>SUBA · BOGOTÁ</span>
                <span class="h-px flex-1 bg-slate-800"></span>
                <span>TALLER ELECTROMECÁNICO</span>
            </div>
        </section>

        {{-- Formulario --}}
        <section class="flex items-center justify-center px-6 py-12">
            <div class="w-full max-w-sm">
                <div class="mb-8 lg:hidden">
                    <p class="font-display text-3xl font-bold tracking-wide uppercase">Herramienta<span class="text-industrial">JB</span></p>
                    <div class="franja-peligro mt-3 h-1.5 w-24 rounded"></div>
                </div>

                <h2 class="font-display text-3xl font-bold tracking-wide text-slate-50 uppercase">Iniciar sesión</h2>
                <p class="mt-1 text-sm text-slate-400">Ingresa con tu correo y contraseña del taller.</p>

                <form method="POST" action="{{ route('login.store') }}" class="mt-8 space-y-5" novalidate>
                    @csrf

                    <div>
                        <label for="correo" class="etiqueta">Correo</label>
                        <input id="correo" name="correo" type="email" value="{{ old('correo') }}" required autofocus autocomplete="username"
                               class="campo @error('correo') campo-error @enderror" placeholder="tecnico@herramientajb.com">
                        @error('correo') <p class="texto-error">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="password" class="etiqueta">Contraseña</label>
                        <input id="password" name="password" type="password" required autocomplete="current-password"
                               class="campo @error('password') campo-error @enderror" placeholder="••••••••">
                        @error('password') <p class="texto-error">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="btn btn-primario w-full py-2.5">Entrar al sistema</button>
                </form>

                <p class="mt-8 text-center text-xs text-slate-600">¿Olvidaste tu contraseña? Pídele al administrador que la cambie.</p>
            </div>
        </section>
    </div>
</body>
</html>
