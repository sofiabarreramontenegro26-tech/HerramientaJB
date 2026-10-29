@extends('layouts.app')

@section('titulo', 'Panel')

@section('contenido')
    <x-encabezado titulo="Panel de control" :subtitulo="'Hola, ' . auth()->user()->nombre_completo . '. Así va el taller hoy, ' . now()->format('d/m/Y') . '.'">
        <a href="{{ route('movimientos.create') }}" class="btn btn-secundario"><x-icono nombre="salida" /> Registrar salida</a>
        <a href="{{ route('mantenimientos.create') }}" class="btn btn-primario"><x-icono nombre="mas" /> Nuevo mantenimiento</a>
    </x-encabezado>

    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">
        <x-dato etiqueta="Productos" :valor="$totalProductos" icono="producto" :enlace="route('productos.index')">en inventario</x-dato>
        <x-dato etiqueta="Stock bajo" :valor="$totalStockBajo" icono="alerta" :tono="$totalStockBajo > 0 ? 'rojo' : 'verde'" :enlace="route('productos.index', ['stock_bajo' => 1])">productos por reponer</x-dato>
        <x-dato etiqueta="Alertas" :valor="$alertasSinLeer" icono="campana" :tono="$alertasSinLeer > 0 ? 'amarillo' : 'normal'" :enlace="route('alertas.index')">sin leer</x-dato>
        <x-dato etiqueta="Mantenimientos" :valor="$mantenimientosMes" icono="llave" :enlace="route('mantenimientos.index')">este mes · {{ $totalMaquinas }} máquinas</x-dato>
    </div>

    @if (! is_null($ventasMes))
        <div class="mt-4 grid gap-4 sm:grid-cols-2">
            <x-dato etiqueta="Ventas del mes" :valor="'$ ' . number_format($ventasMes, 0, ',', '.')" icono="venta" tono="amarillo" :enlace="route('ventas.index')">desde el {{ now()->startOfMonth()->format('d/m/Y') }}</x-dato>
            <x-dato etiqueta="Ganancia del mes" :valor="'$ ' . number_format($gananciaMes, 0, ',', '.')" icono="venta" tono="verde">precio de venta menos precio de compra</x-dato>
        </div>
    @endif

    <div class="mt-6 grid gap-6 xl:grid-cols-2">
        {{-- Stock bajo --}}
        <section class="panel overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-800 px-5 py-4">
                <h2 class="panel-titulo flex items-center gap-2"><x-icono nombre="alerta" class="text-red-400" /> Repuestos por reponer</h2>
                <a href="{{ route('productos.index', ['stock_bajo' => 1]) }}" class="text-xs font-semibold text-industrial hover:underline">Ver todos</a>
            </div>
            @forelse ($productosStockBajo as $producto)
                <div class="flex items-center gap-4 border-b border-slate-800/70 px-5 py-3 last:border-0">
                    <div class="min-w-0 flex-1">
                        <p class="truncate font-medium text-slate-200">{{ $producto->nombre }}</p>
                        <p class="text-xs text-slate-500">{{ $producto->marca ?: 'Sin marca' }}</p>
                    </div>
                    <div class="w-32">
                        @php $porcentaje = $producto->stock_minimo > 0 ? min(100, ($producto->cantidad / $producto->stock_minimo) * 100) : 0; @endphp
                        <div class="h-1.5 overflow-hidden rounded-full bg-slate-800">
                            <div class="h-full rounded-full bg-red-500" style="width: {{ $porcentaje }}%"></div>
                        </div>
                        <p class="mt-1 text-right font-mono text-xs text-slate-400">{{ $producto->cantidad }} / mín. {{ $producto->stock_minimo }}</p>
                    </div>
                </div>
            @empty
                <x-vacio mensaje="Todo el inventario está por encima del stock mínimo." icono="check" />
            @endforelse
        </section>

        {{-- Últimos mantenimientos --}}
        <section class="panel overflow-hidden">
            <div class="flex items-center justify-between border-b border-slate-800 px-5 py-4">
                <h2 class="panel-titulo flex items-center gap-2"><x-icono nombre="llave" class="text-industrial" /> Últimos mantenimientos</h2>
                <a href="{{ route('mantenimientos.index') }}" class="text-xs font-semibold text-industrial hover:underline">Ver todos</a>
            </div>
            @forelse ($ultimosMantenimientos as $mantenimiento)
                <a href="{{ route('maquinas.show', $mantenimiento->id_maquina) }}" class="flex items-center gap-4 border-b border-slate-800/70 px-5 py-3 last:border-0 hover:bg-slate-800/40">
                    <span @class(['chip', 'chip-azul' => $mantenimiento->tipo_mantenimiento === 'preventivo', 'chip-rojo' => $mantenimiento->tipo_mantenimiento === 'correctivo'])>
                        {{ $mantenimiento->tipo_mantenimiento }}
                    </span>
                    <div class="min-w-0 flex-1">
                        <p class="truncate font-medium text-slate-200">{{ $mantenimiento->maquina?->nombre }}</p>
                        <p class="truncate text-xs text-slate-500">{{ $mantenimiento->tecnico_responsable ?: 'Sin técnico asignado' }}</p>
                    </div>
                    <span class="font-mono text-xs text-slate-500">{{ $mantenimiento->fecha->format('d/m/Y') }}</span>
                </a>
            @empty
                <x-vacio mensaje="Aún no hay mantenimientos registrados." icono="llave" />
            @endforelse
        </section>
    </div>

    {{-- Movimientos recientes --}}
    <section class="panel mt-6 overflow-hidden">
        <div class="flex items-center justify-between border-b border-slate-800 px-5 py-4">
            <h2 class="panel-titulo flex items-center gap-2"><x-icono nombre="movimientos" class="text-industrial" /> Movimientos recientes de inventario</h2>
            <a href="{{ route('movimientos.index') }}" class="text-xs font-semibold text-industrial hover:underline">Ver todos</a>
        </div>
        <div class="overflow-x-auto">
            <table class="tabla">
                <thead>
                    <tr><th>Fecha</th><th>Tipo</th><th>Producto</th><th class="text-right">Cantidad</th><th>Motivo</th></tr>
                </thead>
                <tbody>
                    @forelse ($ultimosMovimientos as $movimiento)
                        <tr>
                            <td class="font-mono text-xs text-slate-400">{{ $movimiento->fecha->format('d/m/Y') }}</td>
                            <td>
                                <span @class(['chip', 'chip-verde' => $movimiento->esEntrada(), 'chip-rojo' => ! $movimiento->esEntrada()])>{{ $movimiento->tipo }}</span>
                            </td>
                            <td class="text-slate-200">{{ $movimiento->producto?->nombre }}</td>
                            <td class="text-right font-mono">{{ $movimiento->esEntrada() ? '+' : '−' }}{{ $movimiento->cantidad }}</td>
                            <td class="text-slate-400">{{ $movimiento->motivo }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="5"><x-vacio mensaje="Aún no hay movimientos." icono="movimientos" /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
@endsection
