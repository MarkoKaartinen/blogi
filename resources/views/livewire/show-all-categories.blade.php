<div>
    <div class="text-left wrapper">
        <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl">
            Kategoriat
        </h1>

        <div class="pb-6 md:pb-12 mt-6 text-nord-9">
            Täältä löydät kaikki blogissa käytetyt kategoriat. Järjestettiin ne vielä suosituimmuuden mukaan!
        </div>

        <div class="h-1 w-20 rounded-full bg-nord-9 mb-6 md:mb-12"></div>

        @foreach($categories as $category)
            <div class="py-1">
                <a class="font-bold text-nord-13 transition-colors duration-300 hover:text-nord-12" href="{{ route('category', [$category->slug]) }}" wire:navigate>{{ $category->name }} <span class="text-sm">[{{ $category->articles_count }}]</span></a>
            </div>
        @endforeach
    </div>
</div>
