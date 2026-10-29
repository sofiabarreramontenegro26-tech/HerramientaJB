@extends('layouts.app')

@section('titulo', 'Proveedores')

@section('contenido')
    <x-encabezado titulo="Proveedores" subtitulo="Empresas y personas que suministran repuestos y maquinaria.">
        <a href="{{ route('proveedores.create') }}" class="btn btn-primario"><x-icono nombre="mas" /> Nuevo proveedor</a>
    </x-encabezado>

    <form method="GET" class="mb-5 flex max-w-md gap-2">
        <input name="buscar" value="{{ request('buscar') }}" class="campo" placeholder="Buscar por nombre o empresa">
        <button class="btn btn-secundario"><x-icono nombre="buscar" /></button>
    </form>

    <div class="panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="tabla">
                <thead><tr><th>Nombre</th><th>Empresa</th><th>Teléfono</th><th class="text-right">Productos</th><th class="text-right">Máquinas</th><th class="text-right">Acciones</th></tr></thead>
                <tbody>
                    @forelse ($proveedores as $proveedor)
                        <tr>
                            <td class="font-medium text-slate-100">{{ $proveedor->nombre }}</td>
                            <td class="text-slate-400">{{ $proveedor->empresa ?: '—' }}</td>
                            <td class="font-mono text-slate-400">{{ $proveedor->telefono ?: '—' }}</td>
                            <td class="text-right font-mono">{{ $proveedor->productos_count }}</td>
                            <td class="text-right font-mono">{{ $proveedor->maquinas_count }}</td>
                            <td>
                                <div class="flex justify-end gap-1.5">
                                    <a href="{{ route('proveedores.edit', $proveedor) }}" class="btn btn-secundario btn-chico" title="Editar"><x-icono nombre="editar" /></a>
                                    <form method="POST" action="{{ route('proveedores.destroy', $proveedor) }}" data-confirmar="¿Eliminar el proveedor {{ $proveedor->nombre }}?">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-peligro btn-chico" title="Eliminar"><x-icono nombre="eliminar" /></button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6"><x-vacio mensaje="No hay proveedores registrados." icono="proveedor" /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $proveedores->links('partials.paginacion') }}
    </div>
@endsection
