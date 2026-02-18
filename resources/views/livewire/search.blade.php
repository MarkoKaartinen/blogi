<div class="wrapper">
    <div class="pb-6 md:pb-12 text-center">
        <h1 class="font-extrabold text-5xl mb-4">
            {{ $title }}
        </h1>

        <input wire:model.live.debounce="keywords" type="text" class="w-full block rounded bg-transparent text-nord-13 text-base border-nord-13 border-2 focus:outline-none px-3 py-2 font-mono text-center" placeholder="Kirjoita hakusana" />

        <div class="h-1 w-20 rounded-full bg-nord-9 mt-6 md:mt-12 mx-auto"></div>
    </div>

    @if($keywords != '')
        @if($results->isEmpty())
            <p class="text-center">Ei hakutuloksia, koita toista hakusanaa!</p>
        @else
            <div class="grid grid-cols-1 gap-10 scroll-mt-20" id="results">
                @foreach($results as $hit)
                    @php
                        $isArticle = $hit['_type'] === 'article';
                        $published_at = \Carbon\Carbon::parse($hit['published_at'])->setTimezone('Europe/Helsinki');
                        $title = $hit['_formatted']['title'] ?? $hit['title'];
                        $description = $hit['_formatted']['description'] ?? $hit['description'] ?? '';
                    @endphp
                    <div wire:key="search-{{ $hit['_type'] }}-{{ $hit['slug'] }}">
                        <div class="flex items-center gap-2 mb-1">
                            <span class="text-xs uppercase font-bold px-1.5 py-0.5 rounded leading-none {{ $isArticle ? 'bg-nord-10 text-nord-0' : 'bg-nord-12 text-nord-0' }}">
                                {{ $isArticle ? 'Artikkeli' : 'Resepti' }}
                            </span>
                            <span class="text-xs uppercase text-nord-8">
                                {{ $isArticle ? $published_at->format("j.n.Y \k\l\o H:i") : $published_at->format("j.n.Y") }}
                            </span>
                        </div>

                        <h2 class="text-xl md:text-2xl font-bold">
                            <a class="text-nord-11 hover:text-nord-12 transition-colors duration-300 searchHighlight" href="{{ $hit['url'] }}" wire:navigate>
                                {!! $title !!}
                            </a>
                        </h2>

                        @if($description)
                            <div class="text-sm pt-2 line-clamp-3 searchHighlight">{!! $description !!}</div>
                        @endif

                        <div class="flex pt-2">
                            <a class="text-nord-11 text-sm hover:text-nord-12 transition-colors duration-300 inline-flex items-center" href="{{ $hit['url'] }}" wire:navigate>
                                <span>{{ $isArticle ? 'Lue lisää' : 'Katso resepti' }}</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="ml-1 size-4">
                                    <path fill-rule="evenodd" d="M12.78 7.595a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06l3.25 3.25Zm-8.25-3.25 3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $results->links(view: 'pagination', data: ['scrollTo' => '#results']) }}
            </div>
        @endif
    @else
        <p class="text-center">Hae blogista kirjoittamalla hakusana yllä olevaan kenttään!</p>
    @endif
</div>
