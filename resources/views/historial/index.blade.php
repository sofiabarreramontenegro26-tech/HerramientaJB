@extends('layouts.app')

@section('titulo', 'Historial')

@section('contenido')
    <x-encabezado titulo="Historial de actividades" subtitulo="Registro de quién hizo qué y cuándo dentro del sistema." />

    <form method="GET" class="mb-5 flex max-w-md gap-2">
        <select name="usuario" class="campo" onchange="this.form.submit()">
            <option value="">Todos los usuarios</option>
            @foreach ($usuarios as $usuario)
                <option value="{{ $usuario->id_usuario }}" @selected(request('usuario') == $usuario->id_usuario)>{{ $usuario->nombre_completo }}</option>
            @endforeach
        </select>
    </form>

    <div class="panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="tabla">
                <thead><tr><th>Fecha y hora</th><th>Usuario</th><th>Acción</th></tr></thead>
                <tbody>
                    @forelse ($historial as $registro)
                        <tr>
                            <td class="font-mono text-xs whitespace-nowrap text-slate-400">{{ $registro->created_at?->format('d/m/Y H:i') }}</td>
                            <td class="whitespace-nowrap text-slate-200">{{ $registro->usuario?->nombre_completo ?? '—' }}</td>
                            <td class="text-slate-300">{{ $registro->accion }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="3"><x-vacio mensaje="Aún no hay actividad registrada." icono="historial" /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $historial->links('partials.paginacion') }}
    </div>
@endsection
