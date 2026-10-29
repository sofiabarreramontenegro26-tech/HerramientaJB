@props(['mensaje' => 'No hay registros todavía.', 'icono' => 'producto'])

<div class="flex flex-col items-center justify-center px-6 py-14 text-center">
    <div class="mb-3 rounded-full border border-slate-800 bg-slate-900 p-3 text-slate-600">
        <x-icono :nombre="$icono" tam="size-6" />
    </div>
    <p class="text-sm text-slate-400">{{ $mensaje }}</p>
    @if (trim($slot) !== '')
        <div class="mt-4">{{ $slot }}</div>
    @endif
</div>
