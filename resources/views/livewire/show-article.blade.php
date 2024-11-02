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

    @if($article->legacy || $article->mastodon_post_id)
        <div>
            <div class="h-1 w-20 rounded-full bg-nord-9 my-12"></div>

            <h2 class="text-3xl font-extrabold mb-4">Keskustelu</h2>
            @if($article->legacy)
                <div class="text-sm bg-theme-0 px-3 inline-block py-2 rounded">Tämä artikkeli on tuotu vanhasta blogista ja niiden artikkelien kommentointi on suljettu. Vanhat kommentit kuitenkin näytetään mikäli niitä on. Mikäli haluat kommentoida tätä artikkelia niin voit lähettää viestiä <a class="font-bold text-nord-13 transition-colors duration-300 hover:text-nord-12" href="https://kaartinen.social/@marko">Mastodonissa</a> tai <a class="font-bold text-nord-13 transition-colors duration-300 hover:text-nord-12" href="mailto:markokaartinen@gmail.com">sähköpostilla</a>.</div>
            @else
                <div class="mb-4 text-sm bg-theme-0 px-3 inline-block py-2 rounded">
                    Osallistu keskusteluun Mastodonin kautta. Tämän artikkelin "toottiin" voi kommentoida ja sen kommentit näytetään tämän artikkelin yhteydessä.
                </div>
                <div>
                    <a class="text-lg inline-flex items-center border-2 rounded-xl border-nord-10 px-3 py-3 bg-nord-10 transition-colors duration-300 hover:bg-nord-1" href="{{ config('services.mastodon.profile_url') }}/{{ $article->mastodon_post_id }}" target="_blank">
                        <svg class="size-7 fill-current" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><title>Mastodon</title><path d="M23.268 5.313c-.35-2.578-2.617-4.61-5.304-5.004C17.51.242 15.792 0 11.813 0h-.03c-3.98 0-4.835.242-5.288.309C3.882.692 1.496 2.518.917 5.127.64 6.412.61 7.837.661 9.143c.074 1.874.088 3.745.26 5.611.118 1.24.325 2.47.62 3.68.55 2.237 2.777 4.098 4.96 4.857 2.336.792 4.849.923 7.256.38.265-.061.527-.132.786-.213.585-.184 1.27-.39 1.774-.753a.057.057 0 0 0 .023-.043v-1.809a.052.052 0 0 0-.02-.041.053.053 0 0 0-.046-.01 20.282 20.282 0 0 1-4.709.545c-2.73 0-3.463-1.284-3.674-1.818a5.593 5.593 0 0 1-.319-1.433.053.053 0 0 1 .066-.054c1.517.363 3.072.546 4.632.546.376 0 .75 0 1.125-.01 1.57-.044 3.224-.124 4.768-.422.038-.008.077-.015.11-.024 2.435-.464 4.753-1.92 4.989-5.604.008-.145.03-1.52.03-1.67.002-.512.167-3.63-.024-5.545zm-3.748 9.195h-2.561V8.29c0-1.309-.55-1.976-1.67-1.976-1.23 0-1.846.79-1.846 2.35v3.403h-2.546V8.663c0-1.56-.617-2.35-1.848-2.35-1.112 0-1.668.668-1.67 1.977v6.218H4.822V8.102c0-1.31.337-2.35 1.011-3.12.696-.77 1.608-1.164 2.74-1.164 1.311 0 2.302.5 2.962 1.498l.638 1.06.638-1.06c.66-.999 1.65-1.498 2.96-1.498 1.13 0 2.043.395 2.74 1.164.675.77 1.012 1.81 1.012 3.12z"/></svg>
                        <span class="ml-2">Osallistu keskusteluun</span>
                    </a>

                </div>
            @endif

            @if($article->mastodon_post_id != null)
                <div class=" max-w-2xl w-full">
                    <livewire:mastodon-comments :status="$article->mastodon_post_id" />
                </div>
            @endif


            @if($article->legacy_comments)
                <div class="mt-8 grid grid-cols-1 gap-8 max-w-2xl w-full">
                    @foreach($article->legacy_comments as $legacyComment)
                        <div class="">
                            <div class="flex flex-col md:flex-row md:items-end mb-2">
                                <div class="font-bold text-base leading-none text-nord-12">{{ $legacyComment->name }}</div>
                                <div class="text-xs text-nord-9 mt-1 md:mt-0 md:ml-2 leading-none">{{ $legacyComment->created_at->diffForHumans() }}</div>
                            </div>
                            <div class="border-l-4 border-l-nord-10 pl-2">
                                <div class="whitespace-pre-line text-sm textcontent">{!! $legacyComment->body !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif
</div>
