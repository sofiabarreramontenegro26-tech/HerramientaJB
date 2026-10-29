@extends('layouts.app')

@section('titulo', 'Productos')

@section('contenido')
    @php $esAdmin = auth()->user()->esAdministrador(); @endphp

    <x-encabezado titulo="Productos y repuestos" subtitulo="Inventario actual del taller con alertas de stock mínimo.">
        <a href="{{ route('movimientos.create') }}" class="btn btn-secundario"><x-icono nombre="salida" /> Registrar salida</a>
        @if ($esAdmin)
            <a href="{{ route('entradas.create') }}" class="btn btn-secundario"><x-icono nombre="entrada" /> Registrar entrada</a>
            <a href="{{ route('productos.create') }}" class="btn btn-primario"><x-icono nombre="mas" /> Nuevo producto</a>
        @endif
    </x-encabezado>

    <form method="GET" class="panel mb-5 grid gap-3 p-4 sm:grid-cols-[1fr_220px_auto_auto] sm:items-end">
        <div>
            <label for="buscar" class="etiqueta">Buscar</label>
            <div class="relative">
                <x-icono nombre="buscar" class="pointer-events-none absolute top-1/2 left-3 -translate-y-1/2 text-slate-500" />
                <input id="buscar" name="buscar" value="{{ request('buscar') }}" class="campo pl-9" placeholder="Nombre, marca o descripción">
            </div>
        </div>
        <div>
            <label for="categoria" class="etiqueta">Categoría</label>
            <select id="categoria" name="categoria" class="campo">
                <option value="">Todas</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}" @selected(request('categoria') == $categoria->id_categoria)>{{ $categoria->nombre }}</option>
                @endforeach
            </select>
        </div>
        <label class="flex h-[38px] items-center gap-2 text-sm text-slate-300">
            <input type="checkbox" name="stock_bajo" value="1" @checked(request()->boolean('stock_bajo')) class="size-4 rounded border-slate-600 bg-slate-900 accent-industrial">
            Solo stock bajo
        </label>
        <div class="flex gap-2">
            <button class="btn btn-primario">Filtrar</button>
            @if (request()->hasAny(['buscar', 'categoria', 'stock_bajo']))
                <a href="{{ route('productos.index') }}" class="btn btn-secundario">Limpiar</a>
            @endif
        </div>
    </form>

    <div class="panel overflow-hidden">
        <div class="overflow-x-auto">
            <table class="tabla">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Categoría</th>
                        <th class="text-right">Stock</th>
                        @if ($esAdmin)<th class="text-right">Compra</th>@endif
                        <th class="text-right">Venta</th>
                        <th>Estado</th>
                        <th class="text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($productos as $producto)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    @if ($producto->imagen_url)
                                        <img src="{{ $producto->imagen_url }}" alt="" class="size-10 rounded-md border border-slate-700 object-cover">
                                    @else
                                        <div class="grid size-10 place-items-center rounded-md border border-slate-800 bg-slate-900 text-slate-600"><x-icono nombre="producto" /></div>
                                    @endif
                                    <div class="min-w-0">
                                        <p class="font-medium text-slate-100">{{ $producto->nombre }}</p>
                                        <p class="text-xs text-slate-500">{{ $producto->marca ?: 'Sin marca' }} · {{ $producto->proveedor?->nombre ?? 'Sin proveedor' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="text-slate-400">{{ $producto->categoria?->nombre }}</td>
                            <td class="text-right font-mono">
                                <span @class(['text-red-400 font-semibold' => $producto->tieneStockBajo(), 'text-slate-200' => ! $producto->tieneStockBajo()])>{{ $producto->cantidad }}</span>
                                <span class="text-xs text-slate-600">/ {{ $producto->stock_minimo }}</span>
                            </td>
                            @if ($esAdmin)
                                <td class="text-right font-mono text-slate-400">$ {{ number_format($producto->precio_compra, 0, ',', '.') }}</td>
                            @endif
                            <td class="text-right font-mono text-slate-200">$ {{ number_format($producto->precio_venta, 0, ',', '.') }}</td>
                            <td>
                                @if ($producto->cantidad === 0)
                                    <span class="chip chip-rojo">Agotado</span>
                                @elseif ($producto->tieneStockBajo())
                                    <span class="chip chip-amarillo">Stock bajo</span>
                                @else
                                    <span class="chip chip-verde">Disponible</span>
                                @endif
                            </td>
                            <td>
                                <div class="flex justify-end gap-1.5">
                                    @if ($producto->cantidad > 0)
                                        <a href="{{ route('movimientos.create', ['producto' => $producto->id_producto]) }}" class="btn btn-secundario btn-chico" title="Registrar salida"><x-icono nombre="salida" /></a>
                                    @endif
                                    @if ($esAdmin)
                                        <a href="{{ route('entradas.create', ['producto' => $producto->id_producto]) }}" class="btn btn-secundario btn-chico" title="Registrar entrada"><x-icono nombre="entrada" /></a>
                                        <a href="{{ route('productos.edit', $producto) }}" class="btn btn-secundario btn-chico" title="Editar"><x-icono nombre="editar" /></a>
                                        <form method="POST" action="{{ route('productos.destroy', $producto) }}" data-confirmar="¿Eliminar el producto {{ $producto->nombre }}?">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-peligro btn-chico" title="Eliminar"><x-icono nombre="eliminar" /></button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="7"><x-vacio mensaje="No se encontraron productos con esos filtros." /></td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        {{ $productos->links('partials.paginacion') }}
    </div>
@endsection
