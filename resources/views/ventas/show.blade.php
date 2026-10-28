@extends('layouts.app')

@php
    $numero = 'VEN-' . str_pad($venta->id_venta, 5, '0', STR_PAD_LEFT);

    // La tabla ventas no guarda el detalle; se reconstruye con las salidas
    // de inventario que tienen el motivo "Venta #ID".
    $detalle = $lineas->map(function ($movimiento) {
        $precio = (float) ($movimiento->producto?->precio_venta ?? 0);

        return [
            'nombre' => $movimiento->producto?->nombre ?? 'Producto eliminado',
            'marca' => $movimiento->producto?->marca,
            'cantidad' => $movimiento->cantidad,
            'precio_unitario' => $precio,
            'subtotal' => $precio * $movimiento->cantidad,
        ];
    })->all();
@endphp

@section('titulo', $numero)

@section('contenido')
    <div class="print:hidden">
        <x-encabezado :titulo="'Venta ' . $numero" :subtitulo="'Registrada por ' . ($venta->usuario?->nombre_completo ?? '—') . ' · Ganancia: $ ' . number_format($venta->ganancia_total, 0, ',', '.')" :volver="route('ventas.index')">
            <button type="button" onclick="window.print()" class="btn btn-secundario"><x-icono nombre="imprimir" /> Imprimir comprobante</button>
        </x-encabezado>
    </div>

    @include('partials.comprobante', [
        'tipoDocumento' => 'Comprobante de venta',
        'numero' => $numero,
        'fecha' => $venta->fecha,
        'cliente' => $venta->cliente,
        'lineas' => $detalle,
        'total' => $venta->total_venta,
        'nota' => 'Comprobante interno de venta. No reemplaza la factura electrónica DIAN.',
    ])
@endsection
