<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Acceso restringido · HerramientaJB</title>
    @vite(['resources/css/app.css'])
</head>
<body class="fondo-rejilla grid min-h-screen place-items-center px-6">
    <div class="panel w-full max-w-md overflow-hidden text-center">
        <div class="franja-peligro h-2"></div>
        <div class="p-8">
            <p class="font-mono text-5xl font-semibold text-industrial">403</p>
            <h1 class="mt-3 font-display text-2xl font-bold tracking-wide uppercase">Zona restringida</h1>
            <p class="mt-2 text-sm text-slate-400">{{ $exception->getMessage() ?: 'No tienes permiso para entrar a esta sección.' }}</p>
            <a href="{{ url('/') }}" class="btn btn-primario mt-6">Volver al panel</a>
        </div>
    </div>
</body>
</html>
