@php
if (! isset($scrollTo)) {
    $scrollTo = 'body';
}

$scrollIntoViewJsSnippet = ($scrollTo !== false)
    ? <<<JS
       (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
    JS
    : '';
@endphp
<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination" class="flex items-center">
            <div class="flex items-center w-1/3">
                @if ($paginator->onFirstPage())
                @else
                    <button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" rel="prev" class="text-sm uppercase border border-nord-4 font-bold block leading-none px-2 py-2 text-nord-4 rounded transition-colors duration-300 hover:bg-nord-6 hover:text-nord-0">
                        Edellinen
                    </button>
                @endif
            </div>

            <div class="  w-1/3 flex items-center justify-center">
                <div class="leading-none text-lg font-bold">{{ $paginator->currentPage() }} / {{ $paginator->lastPage() }}</div>
            </div>

            <div class="flex items-center justify-end w-1/3">
                @if ($paginator->onLastPage())
                @else
                    <button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')" x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled" rel="next" class="text-sm uppercase border border-nord-4 font-bold block leading-none px-2 py-2 text-nord-4 rounded transition-colors duration-300 hover:bg-nord-6 hover:text-nord-0">
                        Seuraava
                    </button>
                @endif

            </div>
        </nav>
    @endif
</div>
