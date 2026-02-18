<div>
    <div class="text-left wrapper">
        <h1 class="font-extrabold text-5xl mb-4 text-nord-13">
            {{ $category->name }}
        </h1>
        <p class="text-nord-13 text-base">Listasin alle kaikki kategoriassa <strong class="lowercase">{{ $category->name }}</strong> merkityt reseptit. Reseptejä on yhteensä <strong>{{ $category->recipes_count }}</strong> kappaletta.</p>
    </div>
    <div class="grid grid-cols-1 gap-6 md:gap-12 wrapper">
        <livewire:show-recipes :filter-tag="$category->name" filter-tag-type="recipe_category" />
    </div>
</div>
