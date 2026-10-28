@extends('layouts.app')

@section('titulo', 'Editar categoría')

@section('contenido')
    <x-encabezado titulo="Editar categoría" :subtitulo="$categoria->nombre" :volver="route('categorias.index')" />

    <form method="POST" action="{{ route('categorias.update', $categoria) }}" class="panel max-w-xl space-y-5 p-6">
        @csrf @method('PUT')
        <div>
            <label for="nombre" class="etiqueta">Nombre *</label>
            <input id="nombre" name="nombre" value="{{ old('nombre', $categoria->nombre) }}" maxlength="100" required class="campo @error('nombre') campo-error @enderror">
            @error('nombre') <p class="texto-error">{{ $message }}</p> @enderror
        </div>
        <div>
            <label for="descripcion" class="etiqueta">Descripción</label>
            <textarea id="descripcion" name="descripcion" rows="3" class="campo">{{ old('descripcion', $categoria->descripcion) }}</textarea>
        </div>
        <div class="flex gap-2">
            <button class="btn btn-primario"><x-icono nombre="check" /> Guardar cambios</button>
            <a href="{{ route('categorias.index') }}" class="btn btn-secundario">Cancelar</a>
        </div>
    </form>
@endsection
