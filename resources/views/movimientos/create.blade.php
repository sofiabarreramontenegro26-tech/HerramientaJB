@extends('layouts.app')

@section('titulo', 'Registrar salida')

@section('contenido')
    <x-encabezado titulo="Registrar salida" subtitulo="Descuenta repuestos usados en reparaciones, daños o devoluciones." :volver="route('movimientos.index')" />

    <form method="POST" action="{{ route('movimientos.store') }}" class="panel max-w-2xl space-y-5 p-6">
        @csrf

        <div>
            <label for="id_producto" class="etiqueta">Producto *</label>
            <select id="id_producto" name="id_producto" required class="campo @error('id_producto') campo-error @enderror">
                <option value="">Selecciona…</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->id_producto }}" @selected(old('id_producto', $productoSeleccionado) == $producto->id_producto)>
                        {{ $producto->nombre }} — disponibles: {{ $producto->cantidad }}
                    </option>
                @endforeach
            </select>
            @error('id_producto') <p class="texto-error">{{ $message }}</p> @enderror
            @if ($productos->isEmpty())
                <p class="ayuda">No hay productos con stock disponible.</p>
            @endif
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

        <div>
            <label for="motivo" class="etiqueta">Motivo *</label>
            <input id="motivo" name="motivo" value="{{ old('motivo') }}" maxlength="255" required list="motivos-frecuentes" class="campo @error('motivo') campo-error @enderror" placeholder="Ej: Reparación motor máquina REF-001">
            <datalist id="motivos-frecuentes">
                <option value="Uso en reparación">
                <option value="Uso en mantenimiento preventivo">
                <option value="Pieza defectuosa">
                <option value="Devolución a proveedor">
            </datalist>
            @error('motivo') <p class="texto-error">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-2">
            <button class="btn btn-primario"><x-icono nombre="salida" /> Registrar salida</button>
            <a href="{{ route('movimientos.index') }}" class="btn btn-secundario">Cancelar</a>
        </div>
    </form>
@endsection
