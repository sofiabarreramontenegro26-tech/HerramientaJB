@extends('layouts.app')

@section('titulo', 'Alertas')

@section('contenido')
    <x-encabezado titulo="Alertas de inventario" subtitulo="Se crean solas cuando un producto llega a su stock mínimo.">
        <form method="POST" action="{{ route('alertas.leer-todas') }}">
            @csrf @method('PATCH')
            <button class="btn btn-secundario"><x-icono nombre="check" /> Marcar todas como leídas</button>
        </form>
    </x-encabezado>

    <div class="panel divide-y divide-slate-800 overflow-hidden">
        @forelse ($alertas as $alerta)
            <div @class(['flex flex-col gap-3 px-5 py-4 sm:flex-row sm:items-center', 'bg-red-500/5' => ! $alerta->leido])>
                <div @class(['grid size-9 place-items-center rounded-md', 'bg-red-500/15 text-red-400' => ! $alerta->leido, 'bg-slate-800 text-slate-500' => $alerta->leido])>
                    <x-icono nombre="alerta" />
                </div>
                <div class="min-w-0 flex-1">
                    <p @class(['text-sm', 'font-semibold text-slate-100' => ! $alerta->leido, 'text-slate-400' => $alerta->leido])>{{ $alerta->mensaje }}</p>
                    <p class="mt-0.5 font-mono text-xs text-slate-500">{{ $alerta->created_at?->format('d/m/Y H:i') }}
                        @if ($alerta->producto) · stock actual: {{ $alerta->producto->cantidad }} @endif
                    </p>
                </div>
                <div class="flex gap-2">
                    @if (auth()->user()->esAdministrador() && $alerta->producto)
                        <a href="{{ route('entradas.create', ['producto' => $alerta->id_producto]) }}" class="btn btn-secundario btn-chico"><x-icono nombre="entrada" /> Reponer</a>
                    @endif
                    @unless ($alerta->leido)
                        <form method="POST" action="{{ route('alertas.leer', $alerta) }}">
                            @csrf @method('PATCH')
                            <button class="btn btn-secundario btn-chico"><x-icono nombre="check" /> Leída</button>
                        </form>
                    @endunless
                </div>
            </div>
        @empty
            <x-vacio mensaje="No hay alertas. El inventario está en orden." icono="campana" />
        @endforelse
        {{ $alertas->links('partials.paginacion') }}
    </div>
@endsection
