@props(['titulo', 'subtitulo' => null, 'volver' => null])

<div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
    <div>
        @if ($volver)
            <a href="{{ $volver }}" class="mb-2 inline-flex items-center gap-1.5 text-xs font-semibold tracking-wider text-slate-500 uppercase hover:text-industrial">
                <x-icono nombre="volver" tam="size-3.5" /> Volver
            </a>
        @endif
        <h1 class="font-display text-3xl font-bold tracking-wide text-slate-50 uppercase">{{ $titulo }}</h1>
        @if ($subtitulo)
            <p class="mt-1 text-sm text-slate-400">{{ $subtitulo }}</p>
        @endif
    </div>

    @if (trim($slot) !== '')
        <div class="flex flex-wrap items-center gap-2">
            {{ $slot }}
        </div>
    @endif
</div>
