@props(['etiqueta', 'valor', 'icono', 'tono' => 'normal', 'enlace' => null])

@php
    $colores = [
        'normal' => 'text-slate-50',
        'amarillo' => 'text-industrial',
        'rojo' => 'text-red-400',
        'verde' => 'text-emerald-400',
    ];
    $etiquetaHtml = $enlace ? 'a' : 'div';
@endphp

<{{ $etiquetaHtml }} @if ($enlace) href="{{ $enlace }}" @endif class="panel group relative block overflow-hidden p-5 transition-colors {{ $enlace ? 'hover:border-slate-600' : '' }}">
    <div class="flex items-start justify-between">
        <p class="text-xs font-semibold tracking-wider text-slate-500 uppercase">{{ $etiqueta }}</p>
        <x-icono :nombre="$icono" tam="size-5" class="text-slate-600 group-hover:text-industrial" />
    </div>
    <p class="mt-3 font-mono text-3xl font-semibold tabular-nums {{ $colores[$tono] ?? $colores['normal'] }}">{{ $valor }}</p>
    @if (trim($slot) !== '')
        <p class="mt-1 text-xs text-slate-500">{{ $slot }}</p>
    @endif
</{{ $etiquetaHtml }}>
