@extends('layouts.app')

@php $editando = $maquina->exists; @endphp

@section('titulo', $editando ? 'Editar máquina' : 'Registrar máquina')

@section('contenido')
    <x-encabezado :titulo="$editando ? 'Editar máquina' : 'Registrar máquina'"
                  :volver="$editando ? route('maquinas.show', $maquina) : route('maquinas.index')" />

    <form method="POST" action="{{ $editando ? route('maquinas.update', $maquina) : route('maquinas.store') }}" class="panel max-w-2xl space-y-5 p-6">
        @csrf
        @if ($editando) @method('PUT') @endif

        <div>
            <label for="nombre" class="etiqueta">Nombre del equipo *</label>
            <input id="nombre" name="nombre" value="{{ old('nombre', $maquina->nombre) }}" maxlength="100" required class="campo @error('nombre') campo-error @enderror" placeholder="Ej: Torno paralelo, Motor trifásico 5HP">
            @error('nombre') <p class="texto-error">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="referencia" class="etiqueta">Referencia / N.º de serie *</label>
                <input id="referencia" name="referencia" value="{{ old('referencia', $maquina->referencia) }}" maxlength="100" required class="campo font-mono @error('referencia') campo-error @enderror">
                @error('referencia') <p class="texto-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="fecha_compra" class="etiqueta">Fecha de compra *</label>
                <input id="fecha_compra" name="fecha_compra" type="date" value="{{ old('fecha_compra', $maquina->fecha_compra?->toDateString()) }}" max="{{ now()->toDateString() }}" required class="campo font-mono @error('fecha_compra') campo-error @enderror">
                @error('fecha_compra') <p class="texto-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="id_proveedor" class="etiqueta">Proveedor *</label>
            <select id="id_proveedor" name="id_proveedor" required class="campo @error('id_proveedor') campo-error @enderror">
                <option value="">Selecciona…</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id_proveedor }}" @selected(old('id_proveedor', $maquina->id_proveedor) == $proveedor->id_proveedor)>{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
            @error('id_proveedor') <p class="texto-error">{{ $message }}</p> @enderror
            @if ($proveedores->isEmpty())
                <p class="ayuda">No hay proveedores. <a href="{{ route('proveedores.create') }}" class="text-industrial underline">Crea uno primero</a>.</p>
            @endif
        </div>

        <div class="flex gap-2">
            <button class="btn btn-primario"><x-icono nombre="check" /> {{ $editando ? 'Guardar cambios' : 'Registrar máquina' }}</button>
            <a href="{{ $editando ? route('maquinas.show', $maquina) : route('maquinas.index') }}" class="btn btn-secundario">Cancelar</a>
        </div>
    </form>
@endsection
