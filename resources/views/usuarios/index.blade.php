@extends('layouts.app')

@section('titulo', 'Usuarios')

@section('contenido')
    <x-encabezado titulo="Usuarios" subtitulo="Personas con acceso al sistema y su rol.">
        <a href="{{ route('usuarios.create') }}" class="btn btn-primario"><x-icono nombre="mas" /> Nuevo usuario</a>
    </x-encabezado>

    <div class="panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="tabla">
                <thead><tr><th>Nombre</th><th>Correo</th><th>Rol</th><th>Creado</th><th class="text-right">Acciones</th></tr></thead>
                <tbody>
                    @forelse ($usuarios as $usuario)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="grid size-8 place-items-center rounded-md bg-slate-800 font-display text-xs font-bold text-industrial">{{ $usuario->getIniciales() }}</div>
                                    <span class="font-medium text-slate-100">{{ $usuario->nombre_completo }}</span>
                                    @if ($usuario->is(auth()->user())) <span class="chip chip-gris">Tú</span> @endif
                                </div>
                            </td>
                            <td class="text-slate-400">{{ $usuario->correo }}</td>
                            <td>
                                @if ($usuario->esAdministrador())
                                    <span class="chip chip-amarillo">{{ $usuario->rol->nombre }}</span>
                                @elseif ($usuario->rol)
                                    <span class="chip chip-azul">{{ $usuario->rol->nombre }}</span>
                                @else
                                    <span class="chip chip-rojo">Sin rol</span>
                                @endif
                            </td>
                            <td class="font-mono text-xs text-slate-500">{{ $usuario->created_at?->format('d/m/Y') }}</td>
                            <td>
                                <div class="flex justify-end gap-1.5">
                                    <a href="{{ route('usuarios.edit', $usuario) }}" class="btn btn-secundario btn-chico" title="Editar"><x-icono nombre="editar" /></a>
                                    @unless ($usuario->is(auth()->user()))
                                        <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" data-confirmar="¿Eliminar al usuario {{ $usuario->nombre_completo }}?">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-peligro btn-chico" title="Eliminar"><x-icono nombre="eliminar" /></button>
                                        </form>
                                    @endunless
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="5"><x-vacio mensaje="No hay usuarios." icono="usuarios" /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $usuarios->links('partials.paginacion') }}
    </div>
@endsection
