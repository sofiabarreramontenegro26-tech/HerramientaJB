@extends('layouts.app')

@php $editando = $usuario->exists; @endphp

@section('titulo', $editando ? 'Editar usuario' : 'Nuevo usuario')

@section('contenido')
    <x-encabezado :titulo="$editando ? 'Editar usuario' : 'Nuevo usuario'" :volver="route('usuarios.index')" />

    <form method="POST" action="{{ $editando ? route('usuarios.update', $usuario) : route('usuarios.store') }}" class="panel max-w-2xl space-y-5 p-6">
        @csrf
        @if ($editando) @method('PUT') @endif

        <div>
            <label for="nombre_completo" class="etiqueta">Nombre completo *</label>
            <input id="nombre_completo" name="nombre_completo" value="{{ old('nombre_completo', $usuario->nombre_completo) }}" maxlength="100" required class="campo @error('nombre_completo') campo-error @enderror">
            @error('nombre_completo') <p class="texto-error">{{ $message }}</p> @enderror
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="correo" class="etiqueta">Correo *</label>
                <input id="correo" name="correo" type="email" value="{{ old('correo', $usuario->correo) }}" maxlength="100" required autocomplete="off" class="campo @error('correo') campo-error @enderror">
                @error('correo') <p class="texto-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="id_rol" class="etiqueta">Rol *</label>
                <select id="id_rol" name="id_rol" required class="campo @error('id_rol') campo-error @enderror">
                    <option value="">Selecciona…</option>
                    @foreach ($roles as $rol)
                        <option value="{{ $rol->id_rol }}" @selected(old('id_rol', $usuario->id_rol) == $rol->id_rol)>{{ $rol->nombre }}</option>
                    @endforeach
                </select>
                @error('id_rol') <p class="texto-error">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="grid gap-5 sm:grid-cols-2">
            <div>
                <label for="password" class="etiqueta">{{ $editando ? 'Nueva contraseña' : 'Contraseña *' }}</label>
                <input id="password" name="password" type="password" autocomplete="new-password" @required(! $editando) class="campo @error('password') campo-error @enderror">
                <p class="ayuda">{{ $editando ? 'Déjala vacía para no cambiarla. ' : '' }}Mínimo 8 caracteres, con letras y números.</p>
                @error('password') <p class="texto-error">{{ $message }}</p> @enderror
            </div>
            <div>
                <label for="password_confirmation" class="etiqueta">Confirmar contraseña</label>
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" @required(! $editando) class="campo">
            </div>
        </div>

        <div class="flex gap-2">
            <button class="btn btn-primario"><x-icono nombre="check" /> {{ $editando ? 'Guardar cambios' : 'Crear usuario' }}</button>
            <a href="{{ route('usuarios.index') }}" class="btn btn-secundario">Cancelar</a>
        </div>
    </form>
@endsection
