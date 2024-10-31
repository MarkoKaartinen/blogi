<div wire:key="article-{{ $article->year }}-{{ $article->slug }}" class="px-6 md:px-0">
    <div class="">
        <div class="text-nord-11 font-bold text-xl">LUONNOS</div>
        <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl">{{ $article->title }}</h1>
    </div>

    <div class="textcontent">
        @if($article->legacy)
            {!! $article->body !!}
        @else
            @markdown($article->body)
        @endif
    </div>

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
</div>
