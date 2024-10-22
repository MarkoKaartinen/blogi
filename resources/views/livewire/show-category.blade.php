<div>
    <div class="text-left pb-12 max-w-3xl mx-auto">
        <h1 class="font-extrabold text-5xl mb-4 text-nord-13">
            {{ $category->name }}
        </h1>
        <p class="text-nord-13 text-base">Listasin alle kaikki kategoriassa <strong class="lowercase">{{ $category->name }}</strong> merkityt artikkelit. Artikkeleita on yhteensä <strong>{{ $articleCount }}</strong> kappaletta.</p>
    </div>
    <div class="grid grid-cols-1 gap-12 max-w-3xl mx-auto">
        <div class="h-1 w-20 rounded-full bg-nord-9"></div>

        <livewire:show-articles :tag="$category->slug" tag-type="category" />
    </div>
</div>
