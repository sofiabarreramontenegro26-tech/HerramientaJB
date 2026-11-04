<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña - HerramientaJB</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#0b0f17] text-gray-100 min-h-screen flex items-center justify-center">
    <div class="max-w-md w-full bg-[#131a26] border border-gray-800 rounded-xl p-8 shadow-2xl">
        <div class="flex items-center gap-3 mb-6">
            <div class="bg-yellow-500 p-2 rounded-lg text-black font-bold">🛠️</div>
            <h2 class="text-xl font-bold tracking-wider">HERRAMIENTA<span class="text-yellow-500">JB</span></h2>
        </div>

        <h3 class="text-2xl font-bold mb-2">Recuperar Contraseña</h3>
        <p class="text-gray-400 text-sm mb-6">Ingresa tu correo registrado para recibir las instrucciones de recuperación.</p>

        @if (session('status'))
            <div class="bg-green-500/10 border border-green-500 text-green-400 p-3 rounded-lg mb-4 text-sm">
                <p>{{ session('status') }}</p>
                
                @if (session('resetUrl'))
                    <div class="mt-3 pt-3 border-t border-green-500/30">
                        <p class="text-xs text-gray-300 mb-2">Simulación de correo (Entorno Local):</p>
                        <a href="{{ session('resetUrl') }}" class="block w-full bg-yellow-500 hover:bg-yellow-400 text-black text-center font-bold py-2 px-3 rounded text-xs transition-colors truncate">
                            👉 Ir al enlace de recuperación
                        </a>
                    </div>
                @endif
            </div>
        @endif

        @if ($errors->any())
            <div class="bg-red-500/10 border border-red-500 text-red-400 p-3 rounded-lg mb-4 text-sm">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-xs uppercase tracking-wider text-gray-400 mb-1">Correo Electrónico</label>
                <input type="email" name="correo" required placeholder="tecnico@herramientajb.com" class="w-full bg-[#0b0f17] border border-gray-800 rounded-lg px-4 py-2.5 text-white focus:border-yellow-500 focus:outline-none">
            </div>

            <button type="submit" class="w-full bg-yellow-500 hover:bg-yellow-400 text-black font-bold py-2.5 rounded-lg transition-colors mt-2">
                Enviar instrucciones
            </button>
        </form>

        <div class="mt-4 text-center">
            <a href="/login" class="text-xs text-gray-400 hover:text-yellow-500 transition-colors">Volver al inicio de sesión</a>
        </div>
    </div>
</body>
</html>