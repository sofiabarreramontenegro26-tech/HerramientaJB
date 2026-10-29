@extends('layouts.app')

@section('titulo', 'Máquinas')

@section('contenido')
    @php $esAdmin = auth()->user()->esAdministrador(); @endphp

    <x-encabezado titulo="Máquinas" subtitulo="Equipos del taller con su hoja de vida e historial de mantenimientos.">
        @if ($esAdmin)
            <a href="{{ route('maquinas.create') }}" class="btn btn-primario"><x-icono nombre="mas" /> Registrar máquina</a>
        @endif
    </x-encabezado>

    <form method="GET" class="mb-5 flex max-w-md gap-2">
        <input name="buscar" value="{{ request('buscar') }}" class="campo" placeholder="Buscar por nombre o referencia">
        <button class="btn btn-secundario"><x-icono nombre="buscar" /></button>
    </form>

    @if ($maquinas->isEmpty())
        <div class="panel"><x-vacio mensaje="No hay máquinas registradas." icono="maquina" /></div>
    @else
        <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
            @foreach ($maquinas as $maquina)
                <a href="{{ route('maquinas.show', $maquina) }}" class="panel group block overflow-hidden transition-colors hover:border-industrial/60">
                    <div class="flex items-start justify-between gap-3 p-5">
                        <div class="min-w-0">
                            <p class="font-mono text-xs text-industrial">{{ $maquina->referencia }}</p>
                            <h2 class="mt-1 truncate font-display text-xl font-semibold tracking-wide text-slate-50 uppercase">{{ $maquina->nombre }}</h2>
                            <p class="mt-1 truncate text-sm text-slate-500">{{ $maquina->proveedor?->nombre }}</p>
                        </div>
                        <div class="grid size-11 place-items-center rounded-md border border-slate-800 bg-slate-950 text-slate-500 group-hover:text-industrial">
                            <x-icono nombre="maquina" tam="size-6" />
                        </div>
                    </div>
                    <div class="grid grid-cols-2 border-t border-slate-800 text-xs">
                        <div class="border-r border-slate-800 px-5 py-3">
                            <p class="tracking-wider text-slate-500 uppercase">Mantenimientos</p>
                            <p class="mt-0.5 font-mono text-base text-slate-200">{{ $maquina->mantenimientos_count }}</p>
                        </div>
                        <div class="px-5 py-3">
                            <p class="tracking-wider text-slate-500 uppercase">Último</p>
                            <p class="mt-0.5 font-mono text-base text-slate-200">{{ $maquina->ultimoMantenimiento?->fecha?->format('d/m/Y') ?? '—' }}</p>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        @if ($maquinas->hasPages())
            <div class="panel mt-4">{{ $maquinas->links('partials.paginacion') }}</div>
        @endif
    @endif
@endsection
