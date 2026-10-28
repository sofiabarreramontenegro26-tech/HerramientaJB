@if ($paginator->hasPages())
    <nav class="flex items-center justify-between gap-4 border-t border-slate-800 px-4 py-3 text-sm" aria-label="Paginación">
        <p class="text-slate-500">
            Mostrando <span class="font-mono text-slate-300">{{ $paginator->firstItem() }}–{{ $paginator->lastItem() }}</span>
            de <span class="font-mono text-slate-300">{{ $paginator->total() }}</span>
        </p>

        <div class="flex items-center gap-1">
            @if ($paginator->onFirstPage())
                <span class="btn btn-secundario btn-chico pointer-events-none opacity-40">Anterior</span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="btn btn-secundario btn-chico">Anterior</a>
            @endif

            <span class="px-2 font-mono text-xs text-slate-500">{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</span>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="btn btn-secundario btn-chico">Siguiente</a>
            @else
                <span class="btn btn-secundario btn-chico pointer-events-none opacity-40">Siguiente</span>
            @endif
        </div>
    </nav>
@endif
