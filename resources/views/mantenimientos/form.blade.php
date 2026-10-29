@extends('layouts.app')

@php $editando = $mantenimiento->exists; @endphp

@section('titulo', $editando ? 'Editar mantenimiento' : 'Nuevo mantenimiento')

@section('contenido')
    <x-encabezado :titulo="$editando ? 'Editar mantenimiento' : 'Nuevo mantenimiento'"
                  :volver="$mantenimiento->id_maquina ? route('maquinas.show', $mantenimiento->id_maquina) : route('mantenimientos.index')" />

    <form method="POST" action="{{ $editando ? route('mantenimientos.update', $mantenimiento) : route('mantenimientos.store') }}" class="panel max-w-3xl space-y-5 p-6">
        @csrf
        @if ($editando) @method('PUT') @endif

        <div>
            <label for="id_maquina" class="etiqueta">Máquina *</label>
            <select id="id_maquina" name="id_maquina" required class="campo @error('id_maquina') campo-error @enderror">
                <option value="">Selecciona…</option>
                @foreach ($maquinas as $maquina)
                    <option value="{{ $maquina->id_maquina }}" @selected(old('id_maquina', $mantenimiento->id_maquina) == $maquina->id_maquina)>{{ $maquina->nombre }} — {{ $maquina->referencia }}</option>
                @endforeach
            </select>
            @error('id_maquina') <p class="texto-error">{{ $message }}</p> @enderror
        </div>

        <fieldset>
            <legend class="etiqueta">Tipo de mantenimiento *</legend>
            <div class="grid gap-3 sm:grid-cols-2">
                @foreach (['preventivo' => 'Revisión programada para evitar fallas.', 'correctivo' => 'Reparación de una falla encontrada.'] as $tipo => $ayuda)
                    <label class="flex cursor-pointer items-start gap-3 rounded-md border border-slate-700 bg-slate-950/50 p-4 has-[:checked]:border-industrial has-[:checked]:bg-industrial/5">
                        <input type="radio" name="tipo_mantenimiento" value="{{ $tipo }}" @checked(old('tipo_mantenimiento', $mantenimiento->tipo_mantenimiento) === $tipo) class="mt-1 accent-industrial">
                        <span>
                            <span class="block font-semibold text-slate-100 capitalize">{{ $tipo }}</span>
                            <span class="text-xs text-slate-500">{{ $ayuda }}</span>
                        </span>
                    </label>
                @endforeach
            </div>
            @error('tipo_mantenimiento') <p class="texto-error">{{ $message }}</p> @enderror
        </fieldset>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="fecha" class="etiqueta">Fecha *</label>
                <input id="fecha" name="fecha" type="date" value="{{ old('fecha', $mantenimiento->fecha?->toDateString()) }}" max="{{ now()->toDateString() }}" required class="campo font-mono @error('fecha') campo-error @enderror">
                @error('fecha') <p class="texto-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="tecnico_responsable" class="etiqueta">Técnico responsable</label>
                <input id="tecnico_responsable" name="tecnico_responsable" value="{{ old('tecnico_responsable', $mantenimiento->tecnico_responsable) }}" maxlength="100" class="campo @error('tecnico_responsable') campo-error @enderror">
                @error('tecnico_responsable') <p class="texto-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div>
            <label for="descripcion" class="etiqueta">Descripción del trabajo *</label>
            <textarea id="descripcion" name="descripcion" rows="6" required class="campo @error('descripcion') campo-error @enderror"
                      placeholder="Fallas encontradas, reparaciones hechas y repuestos usados.">{{ old('descripcion', $mantenimiento->descripcion) }}</textarea>
            <p class="ayuda">Si usaste repuestos del inventario, regístralos también en <a href="{{ route('movimientos.create') }}" class="text-industrial underline" target="_blank">Registrar salida</a>.</p>
            @error('descripcion') <p class="texto-error">{{ $message }}</p> @enderror
        </div>

        <div class="flex gap-2">
            <button class="btn btn-primario"><x-icono nombre="check" /> {{ $editando ? 'Guardar cambios' : 'Registrar mantenimiento' }}</button>
            <a href="{{ $mantenimiento->id_maquina ? route('maquinas.show', $mantenimiento->id_maquina) : route('mantenimientos.index') }}" class="btn btn-secundario">Cancelar</a>
        </div>
    </form>
@endsection
