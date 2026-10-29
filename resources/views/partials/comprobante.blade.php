{{--
    Comprobante imprimible (cotización o venta).
    Variables: $tipoDocumento, $numero, $fecha, $cliente, $lineas (array), $total, $nota
--}}
<article class="panel mx-auto max-w-3xl overflow-hidden print:border-0 print:bg-white print:text-black">
    <div class="franja-peligro h-2 print:hidden"></div>

    <header class="flex flex-col gap-6 border-b border-slate-800 p-8 sm:flex-row sm:justify-between print:border-slate-300">
        <div>
            <p class="font-display text-2xl font-bold tracking-wide uppercase">Herramienta<span class="text-industrial print:text-black">JB</span></p>
            <p class="mt-1 text-sm text-slate-400 print:text-slate-600">Taller electromecánico · Suba, Bogotá</p>
        </div>
        <div class="sm:text-right">
            <p class="text-xs font-semibold tracking-[0.2em] text-slate-500 uppercase">{{ $tipoDocumento }}</p>
            <p class="font-mono text-2xl font-semibold text-industrial print:text-black">{{ $numero }}</p>
            <p class="mt-1 font-mono text-sm text-slate-400 print:text-slate-600">{{ $fecha?->format('d/m/Y') }}</p>
        </div>
    </header>

    <div class="border-b border-slate-800 px-8 py-5 print:border-slate-300">
        <p class="text-xs font-semibold tracking-wider text-slate-500 uppercase">Cliente</p>
        <p class="mt-1 text-lg text-slate-100 print:text-black">{{ $cliente }}</p>
    </div>

    <table class="w-full text-sm">
        <thead>
            <tr class="text-xs tracking-wider text-slate-500 uppercase">
                <th class="px-8 py-3 text-left font-semibold">Descripción</th>
                <th class="px-4 py-3 text-right font-semibold">Cant.</th>
                <th class="px-4 py-3 text-right font-semibold">Precio unit.</th>
                <th class="px-8 py-3 text-right font-semibold">Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lineas as $linea)
                <tr class="border-t border-slate-800/70 print:border-slate-200">
                    <td class="px-8 py-3 text-slate-200 print:text-black">{{ $linea['nombre'] }}@if (! empty($linea['marca'])) <span class="text-slate-500">({{ $linea['marca'] }})</span>@endif</td>
                    <td class="px-4 py-3 text-right font-mono">{{ $linea['cantidad'] }}</td>
                    <td class="px-4 py-3 text-right font-mono">$ {{ number_format($linea['precio_unitario'], 0, ',', '.') }}</td>
                    <td class="px-8 py-3 text-right font-mono text-slate-100 print:text-black">$ {{ number_format($linea['subtotal'], 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="border-t-2 border-slate-700 print:border-black">
                <td colspan="3" class="px-8 py-5 text-right text-xs font-semibold tracking-wider text-slate-400 uppercase">Total</td>
                <td class="px-8 py-5 text-right font-mono text-2xl font-semibold text-industrial print:text-black">$ {{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    @if ($nota)
        <p class="border-t border-slate-800 px-8 py-4 text-xs text-slate-500 print:border-slate-300">{{ $nota }}</p>
    @endif
</article>
