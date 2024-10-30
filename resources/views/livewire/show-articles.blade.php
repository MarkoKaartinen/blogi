<div class="grid grid-cols-1 {{ $spacing == 'small' ? 'gap-6' : 'gap-6 md:gap-12' }} scroll-mt-20" id="articles">
    @foreach($this->getArticles() as $article)
        <div class="" wire:key="article-list-{{ $article->year }}-{{ $article->slug }}">
            @if($heading == 'h3')
                <h3 class="text-lg md:text-xl font-bold">
                    <a class="text-nord-11 hover:text-nord-12 transition-colors duration-300" href="{{ route('article', [$article->year, $article->slug]) }}" wire:navigate>
                        {{ $article->title }}
                    </a>
                </h3>
            @else
                <h2 class="text-xl md:text-2xl font-bold">
                    <a class="text-nord-11 hover:text-nord-12 transition-colors duration-300" href="{{ route('article', [$article->year, $article->slug]) }}" wire:navigate>
                        {{ $article->title }}
                    </a>
                </h2>
            @endif
            <div class="flex items-center space-x-3 mt-1">
                <div class="text-xs uppercase text-nord-8">
                    {{ $article->published_at->dayName }}na {{ $article->published_at->format("j.n.Y \k\l\o H:i") }}
                </div>
            </div>
            <div class="text-sm pt-2 line-clamp-3">{{ $article->description }}</div>
            <div class="flex pt-2">
                <a class="text-nord-11 text-sm hover:text-nord-12 transition-colors duration-300 inline-flex items-center" href="{{ route('article', [$article->year, $article->slug]) }}" wire:navigate>
                    <span>Lue lisää</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="ml-1 size-4">
                        <path fill-rule="evenodd" d="M12.78 7.595a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06l3.25 3.25Zm-8.25-3.25 3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06Z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    @endforeach

    @if($paginate)
        {{ $this->getArticles()->links(view: 'pagination', data: ['scrollTo' => '#articles']) }}
    @endif
</div>
