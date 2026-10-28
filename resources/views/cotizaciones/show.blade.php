@extends('layouts.app')

@php $numero = 'COT-' . str_pad($cotizacion->id_cotizacion, 5, '0', STR_PAD_LEFT); @endphp

@section('titulo', $numero)

@section('contenido')
    <div class="print:hidden">
        <x-encabezado :titulo="'Cotización ' . $numero" :volver="route('cotizaciones.index')">
            <button type="button" onclick="window.print()" class="btn btn-secundario"><x-icono nombre="imprimir" /> Imprimir</button>
            <a href="{{ route('ventas.create', ['cotizacion' => $cotizacion->id_cotizacion]) }}" class="btn btn-primario"><x-icono nombre="venta" /> Convertir en venta</a>
        </x-encabezado>
    </div>

    @include('partials.comprobante', [
        'tipoDocumento' => 'Cotización',
        'numero' => $numero,
        'fecha' => $cotizacion->created_at,
        'cliente' => $cotizacion->cliente_telefono ? 'Tel. ' . $cotizacion->cliente_telefono : 'Cliente general',
        'lineas' => $cotizacion->productos_seleccionados ?? [],
        'total' => $cotizacion->total,
        'nota' => 'Precios sujetos a disponibilidad de inventario. Documento sin validez como factura.',
    ])
@endsection
