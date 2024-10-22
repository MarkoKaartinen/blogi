<div>
    <div class="text-left pb-6 md:pb-12 wrapper">
        <h1 class="bg-nord-13 text-5xl rounded-xl px-2 py-2 mb-4 text-nord-0 font-extrabold inline-block lowercase">
            #{{ $tag->name }}
        </h1>
        <p class="text-nord-13 text-base">Listasin alle kaikki avainsanalla <strong class="bg-nord-13 text-nord-0 text-sm font-bold rounded px-1.5 py-0.5 leading-none lowercase">#{{ $tag->name }}</strong> merkityt artikkelit. Artikkeleita on yhteensä <strong>{{ $articleCount }}</strong> kappaletta.</p>
    </div>
    <div class="grid grid-cols-1 gap-6 md:gap-12 wrapper">
        <div class="h-1 w-20 rounded-full bg-nord-9"></div>

        <livewire:show-articles :tag="$tag->slug" tag-type="tag" />
    </div>
</div>
