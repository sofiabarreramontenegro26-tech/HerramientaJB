@extends('layouts.app')

@section('titulo', 'Movimientos')

@section('contenido')
    <x-encabezado titulo="Movimientos de inventario" subtitulo="Trazabilidad de todo lo que entra y sale del almacén.">
        <a href="{{ route('movimientos.create') }}" class="btn btn-primario"><x-icono nombre="salida" /> Registrar salida</a>
    </x-encabezado>

    <div class="mb-5 flex flex-wrap gap-2">
        @foreach (['' => 'Todos', 'ENTRADA' => 'Entradas', 'SALIDA' => 'Salidas'] as $valor => $texto)
            <a href="{{ route('movimientos.index', array_filter(['tipo' => $valor])) }}"
               @class(['btn btn-chico', 'btn-primario' => request('tipo', '') === $valor, 'btn-secundario' => request('tipo', '') !== $valor])>{{ $texto }}</a>
        @endforeach
    </div>

    <div class="panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="tabla">
                <thead><tr><th>Fecha</th><th>Tipo</th><th>Producto</th><th class="text-right">Cantidad</th><th>Motivo</th></tr></thead>
                <tbody>
                    @forelse ($movimientos as $movimiento)
                        <tr>
                            <td class="font-mono text-xs text-slate-400">{{ $movimiento->fecha->format('d/m/Y') }}</td>
                            <td><span @class(['chip', 'chip-verde' => $movimiento->esEntrada(), 'chip-rojo' => ! $movimiento->esEntrada()])>{{ $movimiento->tipo }}</span></td>
                            <td class="text-slate-100">{{ $movimiento->producto?->nombre }}</td>
                            <td @class(['text-right font-mono', 'text-emerald-400' => $movimiento->esEntrada(), 'text-red-400' => ! $movimiento->esEntrada()])>
                                {{ $movimiento->esEntrada() ? '+' : '−' }}{{ $movimiento->cantidad }}
                            </td>
                            <td class="text-slate-400">{{ $movimiento->motivo ?: '—' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5"><x-vacio mensaje="No hay movimientos." icono="movimientos" /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $movimientos->links('partials.paginacion') }}
    </div>
@endsection
