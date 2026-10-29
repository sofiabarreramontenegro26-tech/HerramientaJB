@extends('layouts.app')

@section('titulo', 'Mantenimientos')

@section('contenido')
    <x-encabezado titulo="Mantenimientos" subtitulo="Intervenciones preventivas y correctivas de todas las máquinas.">
        <a href="{{ route('mantenimientos.create') }}" class="btn btn-primario"><x-icono nombre="mas" /> Nuevo mantenimiento</a>
    </x-encabezado>

    <div class="mb-5 flex flex-wrap gap-2">
        @foreach (['' => 'Todos', 'preventivo' => 'Preventivos', 'correctivo' => 'Correctivos'] as $valor => $texto)
            <a href="{{ route('mantenimientos.index', array_filter(['tipo' => $valor])) }}"
               @class(['btn btn-chico', 'btn-primario' => request('tipo', '') === $valor, 'btn-secundario' => request('tipo', '') !== $valor])>{{ $texto }}</a>
        @endforeach
    </div>

    <div class="panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="tabla">
                <thead><tr><th>Fecha</th><th>Máquina</th><th>Tipo</th><th>Descripción</th><th>Técnico</th><th class="text-right">Acciones</th></tr></thead>
                <tbody>
                    @forelse ($mantenimientos as $mantenimiento)
                        <tr>
                            <td class="font-mono text-xs text-slate-400">{{ $mantenimiento->fecha->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('maquinas.show', $mantenimiento->id_maquina) }}" class="font-medium text-slate-100 hover:text-industrial">{{ $mantenimiento->maquina?->nombre }}</a>
                                <p class="font-mono text-xs text-slate-500">{{ $mantenimiento->maquina?->referencia }}</p>
                            </td>
                            <td><span @class(['chip', 'chip-azul' => $mantenimiento->tipo_mantenimiento === 'preventivo', 'chip-rojo' => $mantenimiento->tipo_mantenimiento === 'correctivo'])>{{ $mantenimiento->tipo_mantenimiento }}</span></td>
                            <td class="max-w-sm truncate text-slate-400">{{ $mantenimiento->descripcion }}</td>
                            <td class="text-slate-400">{{ $mantenimiento->tecnico_responsable ?: '—' }}</td>
                            <td class="text-right"><a href="{{ route('mantenimientos.edit', $mantenimiento) }}" class="btn btn-secundario btn-chico" title="Editar"><x-icono nombre="editar" /></a></td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-vacio mensaje="No hay mantenimientos registrados." icono="llave" /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $mantenimientos->links('partials.paginacion') }}
    </div>
@endsection
