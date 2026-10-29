@extends('layouts.app')

@section('titulo', 'Entradas')

@section('contenido')
    <x-encabezado titulo="Entradas de mercancía" subtitulo="Compras a proveedores que suman stock al inventario.">
        <a href="{{ route('entradas.create') }}" class="btn btn-primario"><x-icono nombre="entrada" /> Registrar entrada</a>
    </x-encabezado>

    <div class="panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="tabla">
                <thead><tr><th>#</th><th>Fecha</th><th>Producto</th><th>Proveedor</th><th class="text-right">Cantidad</th></tr></thead>
                <tbody>
                    @forelse ($entradas as $entrada)
                        <tr>
                            <td class="font-mono text-xs text-slate-500">{{ $entrada->id_entrada }}</td>
                            <td class="font-mono text-xs text-slate-400">{{ $entrada->fecha->format('d/m/Y') }}</td>
                            <td class="text-slate-100">{{ $entrada->producto?->nombre }}</td>
                            <td class="text-slate-400">{{ $entrada->proveedor?->nombre }}</td>
                            <td class="text-right font-mono text-emerald-400">+{{ $entrada->cantidad }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5"><x-vacio mensaje="Aún no se han registrado entradas." icono="entrada" /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $entradas->links('partials.paginacion') }}
    </div>
@endsection
