@extends('layouts.app')

@section('titulo', 'Hoja de vida')

@section('contenido')
    <x-encabezado titulo="Hoja de vida" :subtitulo="$maquina->nombre . ' · Ref. ' . $maquina->referencia" :volver="route('maquinas.show', $maquina)" />

    <form method="POST" action="{{ route('hojas-vida.update', $maquina) }}" class="panel max-w-2xl space-y-5 p-6">
        @csrf @method('PUT')

        <div class="max-w-xs">
            <label for="fecha_ingreso" class="etiqueta">Fecha de ingreso a servicio *</label>
            <input id="fecha_ingreso" name="fecha_ingreso" type="date" value="{{ old('fecha_ingreso', $hojaVida->fecha_ingreso?->toDateString()) }}" max="{{ now()->toDateString() }}" required class="campo font-mono @error('fecha_ingreso') campo-error @enderror">
            @error('fecha_ingreso') <p class="texto-error">{{ $message }}</p> @enderror
        </div>

        <div>
            <label for="especificaciones_tecnicas" class="etiqueta">Especificaciones técnicas</label>
            <textarea id="especificaciones_tecnicas" name="especificaciones_tecnicas" rows="8" class="campo font-mono @error('especificaciones_tecnicas') campo-error @enderror"
                      placeholder="Voltaje: 220 V&#10;Potencia: 5 HP&#10;Consumo: 3.7 kW&#10;RPM: 1750">{{ old('especificaciones_tecnicas', $hojaVida->especificaciones_tecnicas) }}</textarea>
            @error('especificaciones_tecnicas') <p class="texto-error">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-2">
            <button class="btn btn-primario"><x-icono nombre="check" /> Guardar hoja de vida</button>
            <a href="{{ route('maquinas.show', $maquina) }}" class="btn btn-secundario">Cancelar</a>
        </div>
    </form>
@endsection
