@if (session('exito'))
    <div data-mensaje role="status" class="mb-5 flex items-start gap-3 rounded-md border border-emerald-500/30 bg-emerald-500/10 px-4 py-3 text-sm text-emerald-200">
        <x-icono nombre="check" tam="size-5" class="text-emerald-400" />
        <p class="flex-1">{{ session('exito') }}</p>
        <button type="button" data-cerrar class="text-emerald-400/70 hover:text-emerald-200" aria-label="Cerrar">
            <x-icono nombre="cerrar" />
        </button>
    </div>
@endif

@if (session('error'))
    <div data-mensaje role="alert" class="mb-5 flex items-start gap-3 rounded-md border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-200">
        <x-icono nombre="alerta" tam="size-5" class="text-red-400" />
        <p class="flex-1">{{ session('error') }}</p>
        <button type="button" data-cerrar class="text-red-400/70 hover:text-red-200" aria-label="Cerrar">
            <x-icono nombre="cerrar" />
        </button>
    </div>
@endif

@if ($errors->any())
    <div role="alert" class="mb-5 rounded-md border border-red-500/30 bg-red-500/10 px-4 py-3 text-sm text-red-200">
        <p class="flex items-center gap-2 font-semibold">
            <x-icono nombre="alerta" class="text-red-400" /> Revisa los datos del formulario:
        </p>
        <ul class="mt-2 list-inside list-disc space-y-0.5 text-red-300/90">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
