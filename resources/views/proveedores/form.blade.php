@extends('layouts.app')

@php $editando = $proveedor->exists; @endphp

@section('titulo', $editando ? 'Editar proveedor' : 'Nuevo proveedor')

@section('contenido')
    <x-encabezado :titulo="$editando ? 'Editar proveedor' : 'Nuevo proveedor'" :volver="route('proveedores.index')" />

    <form method="POST" action="{{ $editando ? route('proveedores.update', $proveedor) : route('proveedores.store') }}" class="panel max-w-2xl space-y-5 p-6">
        @csrf
        @if ($editando) @method('PUT') @endif

        <div>
            <label for="nombre" class="etiqueta">Nombre o razón social *</label>
            <input id="nombre" name="nombre" value="{{ old('nombre', $proveedor->nombre) }}" maxlength="100" required class="campo @error('nombre') campo-error @enderror">
            @error('nombre') <p class="texto-error">{{ $message }}</p> @enderror
        </div>
        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="empresa" class="etiqueta">Empresa</label>
                <input id="empresa" name="empresa" value="{{ old('empresa', $proveedor->empresa) }}" maxlength="100" class="campo @error('empresa') campo-error @enderror">
                @error('empresa') <p class="texto-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="telefono" class="etiqueta">Teléfono</label>
                <input id="telefono" name="telefono" type="tel" value="{{ old('telefono', $proveedor->telefono) }}" maxlength="20" class="campo font-mono @error('telefono') campo-error @enderror" placeholder="300 123 4567">
                @error('telefono') <p class="texto-error">{{ $message }}</p> @enderror
            </div>
        </div>
        <div class="flex gap-2">
            <button class="btn btn-primario"><x-icono nombre="check" /> {{ $editando ? 'Guardar cambios' : 'Crear proveedor' }}</button>
            <a href="{{ route('proveedores.index') }}" class="btn btn-secundario">Cancelar</a>
        </div>
    </form>
@endsection
