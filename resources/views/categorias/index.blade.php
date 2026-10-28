@extends('layouts.app')

@section('titulo', 'Categorías')

@section('contenido')
    <x-encabezado titulo="Categorías" subtitulo="Agrupa los repuestos por tipo: rodamientos, bobinados, eléctricos…" />

    <div class="grid gap-6 lg:grid-cols-3">
        <form method="POST" action="{{ route('categorias.store') }}" class="panel h-fit space-y-5 p-6">
            @csrf
            <h2 class="panel-titulo">Nueva categoría</h2>
            <div>
                <label for="nombre" class="etiqueta">Nombre *</label>
                <input id="nombre" name="nombre" value="{{ old('nombre') }}" maxlength="100" required class="campo @error('nombre') campo-error @enderror">
                @error('nombre') <p class="texto-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="descripcion" class="etiqueta">Descripción</label>
                <textarea id="descripcion" name="descripcion" rows="3" class="campo">{{ old('descripcion') }}</textarea>
            </div>
            <button class="btn btn-primario w-full"><x-icono nombre="mas" /> Agregar</button>
        </form>

        <div class="panel overflow-hidden lg:col-span-2">
            <div class="overflow-x-auto">
                <table class="tabla">
                    <thead><tr><th>Nombre</th><th>Descripción</th><th class="text-right">Productos</th><th class="text-right">Acciones</th></tr></thead>
                    <tbody>
                        @forelse ($categorias as $categoria)
                            <tr>
                                <td class="font-medium text-slate-100">{{ $categoria->nombre }}</td>
                                <td class="max-w-xs truncate text-slate-400">{{ $categoria->descripcion ?: '—' }}</td>
                                <td class="text-right font-mono">{{ $categoria->productos_count }}</td>
                                <td>
                                    <div class="flex justify-end gap-1.5">
                                        <a href="{{ route('categorias.edit', $categoria) }}" class="btn btn-secundario btn-chico" title="Editar"><x-icono nombre="editar" /></a>
                                        <form method="POST" action="{{ route('categorias.destroy', $categoria) }}" data-confirmar="¿Eliminar la categoría {{ $categoria->nombre }}?">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-peligro btn-chico" title="Eliminar"><x-icono nombre="eliminar" /></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4"><x-vacio mensaje="Aún no hay categorías." icono="categoria" /></td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $categorias->links('partials.paginacion') }}
        </div>
    </div>
@endsection
