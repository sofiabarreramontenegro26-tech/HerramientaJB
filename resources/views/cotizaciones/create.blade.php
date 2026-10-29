@extends('layouts.app')

@section('titulo', 'Nueva cotización')

@section('contenido')
    <x-encabezado titulo="Nueva cotización" subtitulo="Arma el presupuesto. El total se calcula con los precios de venta registrados." :volver="route('cotizaciones.index')" />

    <form method="POST" action="{{ route('cotizaciones.store') }}" class="space-y-6">
        @csrf

        <div class="panel max-w-md p-6">
            <label for="cliente_telefono" class="etiqueta">Teléfono del cliente</label>
            <input id="cliente_telefono" name="cliente_telefono" type="tel" maxlength="20" value="{{ old('cliente_telefono') }}" class="campo font-mono @error('cliente_telefono') campo-error @enderror" placeholder="300 123 4567">
            @error('cliente_telefono') <p class="texto-error">{{ $message }}</p> @enderror
        </div>

        @include('partials.lineas-productos', ['productos' => $productos, 'items' => [], 'validarStock' => false])

        <div class="flex gap-2">
            <button class="btn btn-primario"><x-icono nombre="check" /> Guardar cotización</button>
            <a href="{{ route('cotizaciones.index') }}" class="btn btn-secundario">Cancelar</a>
        </div>
    </form>
@endsection
