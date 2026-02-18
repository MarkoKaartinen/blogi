<div wire:key="article-{{ $article->year }}-{{ $article->slug }}" class="px-6 md:px-0">
    <div class="">
        <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl">{{ $article->title }}</h1>
        @if($article->published_at)
            <div class="text-sm text-nord-8 uppercase mt-1 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 mr-1">
                    <path d="M5.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H6a.75.75 0 0 1-.75-.75V12ZM6 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H6ZM7.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H8a.75.75 0 0 1-.75-.75V12ZM8 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H8ZM9.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V10ZM10 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H10ZM9.25 14a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V14ZM12 9.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V10a.75.75 0 0 0-.75-.75H12ZM11.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H12a.75.75 0 0 1-.75-.75V12ZM12 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H12ZM13.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H14a.75.75 0 0 1-.75-.75V10ZM14 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H14Z" />
                    <path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z" clip-rule="evenodd" />
                </svg>

                <span class="hidden md:block">
                    {{ str($article->published_at->dayName)->ucfirst() }}na
                    {{ $article->published_at->format('j.') }} {{ $article->published_at->monthName }}ta {{ $article->published_at->format('Y') }}
                    KELLO {{ $article->published_at->format('H:i') }}
                </span>
                <span class="block md:hidden">
                    {{ $article->published_at->format('j.n.Y \K\L\O H:i') }}
                </span>
            </div>
        @endif
        <div class="text-sm text-nord-8 uppercase mt-1 flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 mr-1">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
            <span>~{{ $article->reading_time }} min lukuaika</span>
        </div>

        @if($article->updated_at && !$article->legacy)
            <div class="text-sm text-nord-12 uppercase inline-flex items-center mt-1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 mr-1">
                    <path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                    <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                </svg>
                <span>
                    <span class="hidden md:inline">Päivitetty:</span>
                    {{ $article->updated_at->format('j.n.Y') }}
                    KLO {{ $article->updated_at->format('H:i') }}
                </span>
            </div>
        @endif
    </div>

    @if($article->mastodon_post_id != null)
        <livewire:mastodon-reactions :status="$article->mastodon_post_id" />
    @endif

    @if($article->tagsWithType('series')->count() > 0)
        @php
        $articleSeriesInfo = $this->getSeriesInfo();
        @endphp

        <div class="lg:float-right bg-theme-0 rounded-lg p-4 max-w-xs w-full text-sm mt-6 lg:ml-6 lg:mb-6">
            @foreach($article->tagsWithType('series') as $series)
                <div class="{{ !$loop->first ? 'mt-4' : '' }}">
                    <div>
                        <a href="{{ route('series', [$series->slug]) }}" class="font-bold text-nord-13 transition-colors duration-300 hover:text-nord-12 text-base" wire:navigate>{{ $series->name }}</a>
                    </div>
                    <div class="text-sm">
                        <ol class="list-decimal ml-6 mt-1 marker:text-nord-13">
                            @foreach($articleSeriesInfo[$series->slug]['articles'] as $seriesArticle)
                                <li>
                                    <a class="{{ $seriesArticle->id == $article->id ? 'text-nord-14' : 'text-nord-7' }} transition-colors duration-300 hover:text-nord-12" href="{{ $seriesArticle->url }}" wire:navigate>
                                        {{ $seriesArticle->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    </div>

                </div>
            @endforeach
        </div>
    @endif


    <div class="textcontent">
        @if($article->legacy)
            {!! $article->body !!}
        @else
            @markdown($article->body)
        @endif
    </div>

    @if($article->igdb_id)
        <livewire:game-box :igdb-id="$article->igdb_id" />
    @endif

    <div class="pt-6 flex flex-col gap-2">
        <div class="">
            @foreach($article->tagsWithType('category') as $category)
                <a class="md:text-lg font-bold uppercase text-nord-13 transition-colors duration-300 hover:text-nord-12" href="{{ route('category', [$category->slug]) }}" wire:navigate>{{ $category->name }}</a>
                @if(!$loop->last)
                    /
                @endif
            @endforeach
        </div>
        <div class="overflow-clip -m-1 flex flex-wrap">
            @foreach($article->tagsWithType('tag') as $tag)
                <div class="p-1">
                    <a class="bg-nord-13 text-nord-0 text-sm font-bold rounded px-1.5 py-0.5 leading-none transition-colors duration-300 hover:bg-nord-12 lowercase break-inside-avoid" href="{{ route('tag', [$tag->slug]) }}" wire:navigate>#{{ $tag->name }}</a>
                </div>
            @endforeach
        </div>
    </div>

    <div>
        <div class="h-1 w-20 rounded-full bg-nord-9 my-12"></div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                @if($previousArticle)
                    <a class="text-left group" href="{{ $previousArticle->url }}" wire:navigate>
                        <span class="block text-xs uppercase">Edellinen artikkeli</span>
                        <span class="block text-base text-nord-14 group-hover:text-nord-12 transition-colors duration-300">{{ $previousArticle->title }}</span>
                    </a>
                @endif
            </div>
            <div>
                @if($nextArticle)
                    <a class="md:text-right group" href="{{ $nextArticle->url }}" wire:navigate>
                        <span class="block text-xs uppercase">Seuraava artikkeli</span>
                        <span class="block text-base text-nord-14 group-hover:text-nord-12 transition-colors duration-300">{{ $nextArticle->title }}</span>
                    </a>
                @endif
            </div>
        </div>
    </div>

    @if($this->relatedArticles->isNotEmpty())
        <div>
            <div class="h-1 w-20 rounded-full bg-nord-9 my-12"></div>

            <h2 class="text-xl font-extrabold mb-4">Myös nämä saattaisi kiinnostaa</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach($this->relatedArticles->shuffle()->take(4) as $related)
                    <div>
                        <h3 class="text-lg font-semibold">
                            <a class="text-nord-14 hover:text-nord-12 transition-colors duration-300" href="{{ $related->url }}" wire:navigate>{{ $related->title }}</a>
                        </h3>
                        <div class="text-xs uppercase text-nord-8 mt-1">
                            {{ $related->published_at?->dayName }}na {{ $related->published_at?->format('j.n.Y \k\l\o H:i') }}
                        </div>
                        @if($related->description)
                            <div class="text-xs pt-2 line-clamp-3">{{ $related->description }}</div>
                        @endif
                        <div class="flex pt-2">
                            <a class="text-nord-14 text-xs hover:text-nord-12 transition-colors duration-300 inline-flex items-center" href="{{ $related->url }}" wire:navigate>
                                <span>Lue lisää</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="ml-1 size-4">
                                    <path fill-rule="evenodd" d="M12.78 7.595a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06l3.25 3.25Zm-8.25-3.25 3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <x-discussion
        :commentable-id="$article->id"
        :commentable-type="\App\Models\Article::class"
        :mastodon-post-id="$article->mastodon_post_id"
    >
        @if($article->legacy)
            Tämä artikkeli on tuotu vanhasta blogista ja niiden artikkelien kommentointi on uudistettu. Vanhaan artikkeliin voi kommentoida vain blogin kautta, kun taas uudemmissa näytetään myös Mastodonin kautta tulleet kommentit.
        @else
            Osallistu keskusteluun Mastodonin tai blogin kautta. Tämän artikkelin "toottiin" voi kommentoida ja sen kommentit näytetään tämän artikkelin yhteydessä. Samoin käytössä on ns. perinteinen kommentointilomake. Vanhasta blogista tuodut kommentit, uuden blogin kommentit ja Mastodonin kommentit näytetään kimpassa.
        @endif
    </x-discussion>
</div>
