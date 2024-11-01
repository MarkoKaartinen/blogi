<div class="wrapper">
    <div class="pb-6 md:pb-12 text-center">
        <h1 class="font-extrabold text-5xl mb-4">
            {{ $title }}
        </h1>

        <input wire:model.live.debounce="keywords" type="text" class="w-full block rounded bg-transparent text-nord-13 text-base border-nord-13 border-2 focus:outline-none px-3 py-2 font-mono text-center" placeholder="Kirjoita hakusana" />

        <div class="h-1 w-20 rounded-full bg-nord-9 mt-6 md:mt-12 mx-auto"></div>
    </div>
    @if($keywords != '')
        @php
            $hits = collect();
            if(isset($articles->items()['hits'])){
                $hits = collect($articles->items()['hits']);
            }
        @endphp
        @if(count($hits) == 0)
            <p class="text-center">Ei hakutuloksia, koita toista hakusanaa!</p>
        @else
            <div class="grid grid-cols-1 gap-12 scroll-mt-20" id="articles">
                @foreach($hits as $hit)
                    @php
                        $article = $hit;
                        $published_at = \Carbon\Carbon::parse($article['published_at'])->setTimezone('Europe/Helsinki');
                        $description = $article['description'];
                        $title = $article['title'];
                        if(isset($hit['_formatted']['title'])){
                            $title = $hit['_formatted']['title'];
                        }
                        if(isset($hit['_formatted']['description'])){
                            $description = $hit['_formatted']['description'];
                        }
                    @endphp
                    <div class="" wire:key="article-search-list-{{ $article['year'] }}-{{ $article['slug'] }}">
                        <h2 class="text-xl md:text-2xl font-bold">
                            <a class="text-nord-11 hover:text-nord-12 transition-colors duration-300 searchHighlight" href="{{ $article['url'] }}" wire:navigate>
                                {!! $title !!}
                            </a>
                        </h2>
                        <div class="flex items-center space-x-3 mt-1">
                            <div class="text-xs uppercase text-nord-8">
                                {{ $published_at->dayName }} {{ $published_at->format("j.n.Y \k\l\o H:i") }}
                            </div>
                        </div>
                        <div class="text-sm pt-2 line-clamp-3 searchHighlight">{!! $description !!}</div>
                        <div class="flex pt-2">
                            <a class="text-nord-11 text-sm hover:text-nord-12 transition-colors duration-300 inline-flex items-center" href="{{ $article['url'] }}" wire:navigate>
                                <span>Lue lisää</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="ml-1 size-4">
                                    <path fill-rule="evenodd" d="M12.78 7.595a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06l3.25 3.25Zm-8.25-3.25 3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach

                {{ $articles->links(view: 'pagination', data: ['scrollTo' => '#articles']) }}
            </div>
        @endif
    @else
        <p class="text-center">Hae blogista kirjoittamalla hakusana yllä olevaan kenttään!</p>
    @endif

</div>
