@extends('layouts.app')

@section('titulo', 'Registrar entrada')

@section('contenido')
    <x-encabezado titulo="Registrar entrada" subtitulo="La cantidad se suma automáticamente al stock del producto." :volver="route('entradas.index')" />

    <form method="POST" action="{{ route('entradas.store') }}" class="panel max-w-2xl space-y-5 p-6">
        @csrf

        <div>
            <label for="id_producto" class="etiqueta">Producto *</label>
            <select id="id_producto" name="id_producto" required class="campo @error('id_producto') campo-error @enderror">
                <option value="">Selecciona…</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id_producto }}" @selected(old('id_producto', $productoSeleccionado) == $producto->id_producto)>
                        {{ $producto->nombre }} — stock actual: {{ $producto->cantidad }}
                    </option>
                @endforeach
            </select>
            @error('id_producto') <p class="texto-error">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="id_proveedor" class="etiqueta">Proveedor *</label>
            <select id="id_proveedor" name="id_proveedor" required class="campo @error('id_proveedor') campo-error @enderror">
                <option value="">Selecciona…</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id_proveedor }}" @selected(old('id_proveedor') == $proveedor->id_proveedor)>{{ $proveedor->nombre }}</option>
                @endforeach
            </select>
            @error('id_proveedor') <p class="texto-error">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="cantidad" class="etiqueta">Cantidad *</label>
                <input id="cantidad" name="cantidad" type="number" min="1" value="{{ old('cantidad', 1) }}" required class="campo font-mono @error('cantidad') campo-error @enderror">
                @error('cantidad') <p class="texto-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="fecha" class="etiqueta">Fecha *</label>
                <input id="fecha" name="fecha" type="date" value="{{ old('fecha', now()->toDateString()) }}" max="{{ now()->toDateString() }}" required class="campo font-mono @error('fecha') campo-error @enderror">
                @error('fecha') <p class="texto-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="flex gap-2">
            <button class="btn btn-primario"><x-icono nombre="entrada" /> Registrar entrada</button>
            <a href="{{ route('entradas.index') }}" class="btn btn-secundario">Cancelar</a>
        </div>
    </form>
@endsection
