<div>
    <div class="text-left wrapper">
        <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl">
            Avainsanat
        </h1>

        <div class="pb-6 md:pb-12 mt-6 text-nord-9">
            Täältä löydät kaikki blogissa käytetyt avainsanat. Järjestettiin ne vielä suosituimmuuden mukaan!
        </div>

        <div class="h-1 w-20 rounded-full bg-nord-9 mb-6 md:mb-12"></div>

        <div class="overflow-clip -m-1 flex flex-wrap justify-center">
            @foreach($tags as $tag)
                <div class="p-1">
                    <a class="bg-nord-13 text-nord-0 text-sm font-bold rounded px-1.5 py-0.5 leading-none transition-colors duration-300 hover:bg-nord-12 lowercase break-inside-avoid" href="{{ route('tag', [$tag->slug]) }}" wire:navigate>#{{ $tag->name }} <span class="text-xs">[{{ $tag->articles_count }}]</span></a>
                </div>
            @endforeach
        </div>
    </div>
</div>
