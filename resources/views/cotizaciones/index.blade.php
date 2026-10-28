@extends('layouts.app')

@section('titulo', 'Cotizaciones')

@section('contenido')
    <x-encabezado titulo="Cotizaciones" subtitulo="Presupuestos preliminares para clientes. No descuentan inventario.">
        <a href="{{ route('cotizaciones.create') }}" class="btn btn-primario"><x-icono nombre="mas" /> Nueva cotización</a>
    </x-encabezado>

    <div class="panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="tabla">
                <thead><tr><th>N.º</th><th>Fecha</th><th>Teléfono cliente</th><th class="text-right">Ítems</th><th class="text-right">Total</th><th class="text-right">Acciones</th></tr></thead>
                <tbody>
                    @forelse ($cotizaciones as $cotizacion)
                        <tr>
                            <td class="font-mono text-industrial">COT-{{ str_pad($cotizacion->id_cotizacion, 5, '0', STR_PAD_LEFT) }}</td>
                            <td class="font-mono text-xs text-slate-400">{{ $cotizacion->created_at?->format('d/m/Y') }}</td>
                            <td class="font-mono text-slate-300">{{ $cotizacion->cliente_telefono ?: '—' }}</td>
                            <td class="text-right font-mono">{{ count($cotizacion->productos_seleccionados ?? []) }}</td>
                            <td class="text-right font-mono text-slate-100">$ {{ number_format($cotizacion->total, 0, ',', '.') }}</td>
                            <td>
                                <div class="flex justify-end gap-1.5">
                                    <a href="{{ route('cotizaciones.show', $cotizacion) }}" class="btn btn-secundario btn-chico" title="Ver"><x-icono nombre="ver" /></a>
                                    <form method="POST" action="{{ route('cotizaciones.destroy', $cotizacion) }}" data-confirmar="¿Eliminar esta cotización?">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-peligro btn-chico" title="Eliminar"><x-icono nombre="eliminar" /></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-vacio mensaje="Aún no hay cotizaciones." icono="cotizacion" /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $cotizaciones->links('partials.paginacion') }}
    </div>
@endsection
