<div>
    <div class="text-left pb-6 md:pb-12 wrapper">
        <h1 class="font-extrabold text-5xl mb-4 text-nord-13">
            {{ $series->name }}
        </h1>
        <p class="text-nord-13 text-base">Tällä sivulla on listattuna kaikki sarjan <strong class="lowercase">{{ $series->name }}</strong> artikkelit. Artikkeleita on yhteensä <strong>{{ $articleCount }}</strong> kappaletta.</p>
    </div>
    <div class="grid grid-cols-1 gap-6 md:gap-12 wrapper">
        <div class="h-1 w-20 rounded-full bg-nord-9"></div>

        <livewire:show-articles :tag="$series->slug" tag-type="series" order="asc" />
    </div>
</div>
