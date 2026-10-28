{{--
    Tabla dinámica de productos para cotizaciones y ventas.
    Variables: $productos (colección), $items (filas iniciales), $validarStock (bool)
    El precio y el total que se ven aquí son solo informativos: el servidor
    recalcula todo con los precios de la base de datos al guardar.
--}}
@php
    $filas = old('items', $items ?? []);

    $opcionesProductos = function ($seleccionado = null) use ($productos) {
        $html = '<option value="">Selecciona un producto…</option>';
        foreach ($productos as $p) {
            $html .= sprintf(
                '<option value="%d" data-precio="%s" data-stock="%d" %s>%s — stock %d</option>',
                $p->id_producto,
                e($p->precio_venta),
                $p->cantidad,
                (string) $seleccionado === (string) $p->id_producto ? 'selected' : '',
                e($p->nombre . ($p->marca ? ' (' . $p->marca . ')' : '')),
                $p->cantidad
            );
        }
        return $html;
    };
@endphp

<div data-lineas data-validar-stock="{{ $validarStock ? 'true' : 'false' }}" class="panel overflow-hidden">
    <div class="flex items-center justify-between border-b border-slate-800 px-5 py-4">
        <h2 class="panel-titulo">Productos</h2>
        <button type="button" data-agregar class="btn btn-secundario btn-chico"><x-icono nombre="mas" /> Agregar línea</button>
    </div>

    @error('items') <p class="texto-error px-5 pt-3">{{ $message }}</p> @enderror

    <div class="overflow-x-auto">
        <table class="tabla">
            <thead>
                <tr><th class="min-w-64">Producto</th><th class="w-28">Cantidad</th><th class="text-right">Precio unit.</th><th class="text-right">Subtotal</th><th class="w-12"></th></tr>
            </thead>
            <tbody data-lineas-cuerpo>
                @foreach ($filas as $i => $fila)
                    <tr data-linea>
                        <td>
                            <select name="items[{{ $i }}][id_producto]" required class="campo">{!! $opcionesProductos($fila['id_producto'] ?? null) !!}</select>
                            <p data-aviso-stock class="texto-error hidden"></p>
                            @error("items.$i.id_producto") <p class="texto-error">{{ $message }}</p> @enderror
                        </td>
                        <td>
                            <input type="number" min="1" name="items[{{ $i }}][cantidad]" value="{{ $fila['cantidad'] ?? 1 }}" required data-cantidad class="campo font-mono">
                            @error("items.$i.cantidad") <p class="texto-error">{{ $message }}</p> @enderror
                        </td>
                        <td data-precio class="text-right font-mono text-slate-400">—</td>
                        <td data-subtotal class="text-right font-mono text-slate-100">$ 0</td>
                        <td><button type="button" data-quitar class="rounded p-1.5 text-slate-500 hover:bg-red-500/10 hover:text-red-400" aria-label="Quitar línea"><x-icono nombre="eliminar" /></button></td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="px-4 py-4 text-right text-xs font-semibold tracking-wider text-slate-400 uppercase">Total estimado</td>
                    <td data-total class="px-4 py-4 text-right font-mono text-xl font-semibold text-industrial">$ 0</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
    </div>

    <template>
        <tr data-linea>
            <td>
                <select name="items[__INDICE__][id_producto]" required class="campo">{!! $opcionesProductos() !!}</select>
                <p data-aviso-stock class="texto-error hidden"></p>
            </td>
            <td><input type="number" min="1" name="items[__INDICE__][cantidad]" value="1" required data-cantidad class="campo font-mono"></td>
            <td data-precio class="text-right font-mono text-slate-400">—</td>
            <td data-subtotal class="text-right font-mono text-slate-100">$ 0</td>
            <td><button type="button" data-quitar class="rounded p-1.5 text-slate-500 hover:bg-red-500/10 hover:text-red-400" aria-label="Quitar línea"><x-icono nombre="eliminar" /></button></td>
        </tr>
    </template>
</div>
