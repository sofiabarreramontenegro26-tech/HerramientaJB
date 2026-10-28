@extends('layouts.app')

@section('titulo', 'Nueva venta')

@section('contenido')
    <x-encabezado titulo="Nueva venta" subtitulo="Al guardar se descuenta el stock de cada producto. Si alguno no alcanza, no se guarda nada." :volver="route('ventas.index')" />

    <form method="POST" action="{{ route('ventas.store') }}" class="space-y-6">
        @csrf

        <div class="panel grid gap-5 p-6 sm:grid-cols-2">
            <div>
                <label for="cliente" class="etiqueta">Cliente *</label>
                <input id="cliente" name="cliente" value="{{ old('cliente') }}" maxlength="255" required class="campo @error('cliente') campo-error @enderror" placeholder="Nombre del cliente o empresa">
                @error('cliente') <p class="texto-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="fecha" class="etiqueta">Fecha *</label>
                <input id="fecha" name="fecha" type="date" value="{{ old('fecha', now()->toDateString()) }}" max="{{ now()->toDateString() }}" required class="campo font-mono @error('fecha') campo-error @enderror">
                @error('fecha') <p class="texto-error">{{ $message }}</p> @enderror
            </div>
        </div>

        @include('partials.lineas-productos', ['productos' => $productos, 'items' => $itemsIniciales, 'validarStock' => true])

        <div class="flex gap-2">
            <button class="btn btn-primario"><x-icono nombre="check" /> Registrar venta</button>
            <a href="{{ route('ventas.index') }}" class="btn btn-secundario">Cancelar</a>
        </div>
    </form>
@endsection
