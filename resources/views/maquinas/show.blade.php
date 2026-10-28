@extends('layouts.app')

@section('titulo', $maquina->nombre)

@section('contenido')
    @php $esAdmin = auth()->user()->esAdministrador(); @endphp

    <x-encabezado :titulo="$maquina->nombre" :subtitulo="'Ref. ' . $maquina->referencia . ' · Proveedor: ' . ($maquina->proveedor?->nombre ?? '—')" :volver="route('maquinas.index')">
        @if ($esAdmin)
            <a href="{{ route('maquinas.edit', $maquina) }}" class="btn btn-secundario"><x-icono nombre="editar" /> Editar</a>
            <form method="POST" action="{{ route('maquinas.destroy', $maquina) }}" data-confirmar="¿Eliminar la máquina {{ $maquina->nombre }} y todo su historial?">
                @csrf @method('DELETE')
                <button class="btn btn-peligro"><x-icono nombre="eliminar" /> Eliminar</button>
            </form>
        @endif
        <a href="{{ route('mantenimientos.create', ['maquina' => $maquina->id_maquina]) }}" class="btn btn-primario"><x-icono nombre="mas" /> Registrar mantenimiento</a>
    </x-encabezado>

    <div class="grid gap-6 lg:grid-cols-3">
        {{-- Hoja de vida --}}
        <section class="panel h-fit overflow-hidden">
            <div class="franja-peligro h-1"></div>
            <div class="flex items-center justify-between border-b border-slate-800 px-5 py-4">
                <h2 class="panel-titulo">Hoja de vida</h2>
                <a href="{{ route('hojas-vida.edit', $maquina) }}" class="btn btn-secundario btn-chico">
                    <x-icono nombre="editar" /> {{ $maquina->hojaVida ? 'Editar' : 'Completar' }}
                </a>
            </div>

            <dl class="divide-y divide-slate-800 text-sm">
                <div class="flex justify-between px-5 py-3"><dt class="text-slate-500">Fecha de compra</dt><dd class="font-mono text-slate-200">{{ $maquina->fecha_compra->format('d/m/Y') }}</dd></div>
                <div class="flex justify-between px-5 py-3"><dt class="text-slate-500">Ingreso a servicio</dt><dd class="font-mono text-slate-200">{{ $maquina->hojaVida?->fecha_ingreso?->format('d/m/Y') ?? '—' }}</dd></div>
                <div class="flex justify-between px-5 py-3"><dt class="text-slate-500">Mantenimientos</dt><dd class="font-mono text-slate-200">{{ $mantenimientos->count() }}</dd></div>
                <div class="px-5 py-3">
                    <dt class="text-slate-500">Especificaciones técnicas</dt>
                    <dd class="mt-2 text-sm whitespace-pre-line text-slate-300">{{ $maquina->hojaVida?->especificaciones_tecnicas ?: 'Sin especificaciones registradas (voltaje, potencia, consumo…).' }}</dd>
                </div>
            </dl>
        </section>

        {{-- Historial de mantenimientos --}}
        <section class="lg:col-span-2">
            <h2 class="panel-titulo mb-4">Historial de mantenimientos</h2>

            @forelse ($mantenimientos as $mantenimiento)
                <div class="relative border-l-2 border-slate-800 pb-6 pl-6 last:pb-0">
                    <span @class([
                        'absolute top-1 -left-[7px] size-3 rounded-full ring-4 ring-acero',
                        'bg-sky-400' => $mantenimiento->tipo_mantenimiento === 'preventivo',
                        'bg-red-500' => $mantenimiento->tipo_mantenimiento === 'correctivo',
                    ])></span>
                    <div class="panel p-4">
                        <div class="flex flex-wrap items-center gap-2">
                            <span @class(['chip', 'chip-azul' => $mantenimiento->tipo_mantenimiento === 'preventivo', 'chip-rojo' => $mantenimiento->tipo_mantenimiento === 'correctivo'])>{{ $mantenimiento->tipo_mantenimiento }}</span>
                            <span class="font-mono text-xs text-slate-400">{{ $mantenimiento->fecha->format('d/m/Y') }}</span>
                            <span class="text-xs text-slate-500">· {{ $mantenimiento->tecnico_responsable ?: 'Sin técnico' }}</span>
                            <div class="ml-auto flex gap-1.5">
                                <a href="{{ route('mantenimientos.edit', $mantenimiento) }}" class="btn btn-secundario btn-chico" title="Editar"><x-icono nombre="editar" /></a>
                                @if ($esAdmin)
                                    <form method="POST" action="{{ route('mantenimientos.destroy', $mantenimiento) }}" data-confirmar="¿Eliminar este mantenimiento?">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-peligro btn-chico" title="Eliminar"><x-icono nombre="eliminar" /></button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <p class="mt-3 text-sm whitespace-pre-line text-slate-300">{{ $mantenimiento->descripcion }}</p>
                    </div>
                </div>
            @empty
                <div class="panel"><x-vacio mensaje="Esta máquina aún no tiene mantenimientos." icono="llave" /></div>
            @endforelse
        </section>
    </div>
@endsection
