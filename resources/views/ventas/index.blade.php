@extends('layouts.app')

@section('titulo', 'Ventas')

@section('contenido')
    <x-encabezado titulo="Ventas" subtitulo="Cada venta descuenta del inventario los productos vendidos.">
        <a href="{{ route('ventas.create') }}" class="btn btn-primario"><x-icono nombre="mas" /> Nueva venta</a>
    </x-encabezado>

    <div class="panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="tabla">
                <thead><tr><th>N.º</th><th>Fecha</th><th>Cliente</th><th>Vendedor</th><th class="text-right">Total</th><th class="text-right">Ganancia</th><th></th></tr></thead>
                <tbody>
                    @forelse ($ventas as $venta)
                        <tr>
                            <td class="font-mono text-industrial">VEN-{{ str_pad($venta->id_venta, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="font-mono text-xs text-slate-400">{{ $venta->fecha->format('d/m/Y') }}</td>
                            <td class="text-slate-100">{{ $venta->cliente }}</td>
                            <td class="text-slate-400">{{ $venta->usuario?->nombre_completo }}</td>
                            <td class="text-right font-mono text-slate-100">$ {{ number_format($venta->total_venta, 0, ',', '.') }}</td>
                            <td class="text-right font-mono text-emerald-400">$ {{ number_format($venta->ganancia_total, 0, ',', '.') }}</td>
                            <td class="text-right"><a href="{{ route('ventas.show', $venta) }}" class="btn btn-secundario btn-chico" title="Ver comprobante"><x-icono nombre="ver" /></a></td>
                        </tr>
                    @empty
                        <tr><td colspan="7"><x-vacio mensaje="Aún no hay ventas registradas." icono="venta" /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $ventas->links('partials.paginacion') }}
    </div>
@endsection
