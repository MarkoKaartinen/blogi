@if ($paginator->hasPages())

    <ul class="pagination rounded flex flex-wrap flex-row w-auto items-center list-reset font-sans">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled"><span class="page-link block border border-info px-3 py-2 rounded-l text-info font-bold hover:text-white hover:bg-info">&laquo;</span></li>
        @else
            <li class="page-item"><a class="page-link block border border-info px-3 py-2 rounded-l text-info font-bold hover:text-white hover:bg-info" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="block page-link border-t border-b border-r border-info px-3 py-2 text-info font-bold hover:text-white hover:bg-info">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><span class="block border-t border-b page-link border-r border-info px-3 py-2 font-bold text-white bg-info">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="block page-link border-t border-b border-r border-info px-3 py-2 text-info font-bold hover:text-white hover:bg-info" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item"><a class="page-link block border-t border-info border-b border-r px-3 py-2 rounded-r text-info font-bold hover:text-white hover:bg-info" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
        @else
            <li class="page-item disabled"><span class="page-link border-t border-info border-b border-r px-3 py-2 rounded-r text-info font-bold  hover:text-white hover:bg-info">&raquo;</span></li>
        @endif
    </ul>
@endif
