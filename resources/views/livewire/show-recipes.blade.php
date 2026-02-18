<div class="px-6 md:px-0">
    @if($paginate)
        <div class="mt-6 flex flex-col sm:flex-row gap-4">
            <div class="w-full">
                <input
                    wire:model.live.debounce="search"
                    type="search"
                    placeholder="Hae reseptejä..."
                    class="w-full block rounded bg-transparent text-nord-13 text-base border-nord-13 border-2 focus:outline-none px-3 py-2 font-mono text-left h-12"
                />
            </div>

            @if($filterTagType === null && $this->categories->isNotEmpty())
                <div>
                    <select
                        wire:model.live="category"
                        class="w-full block rounded bg-transparent text-nord-13 text-base border-nord-13 border-2 focus:outline-none pl-3 pr-6 py-2 font-mono text-left h-12"
                    >
                        <option value="">Kategoria</option>
                        @foreach($this->categories as $cat)
                            <option value="{{ $cat->name }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
        </div>
    @endif

    <div class="mt-6 grid {{ $cols }} gap-6 scroll-mt-20" id="recipes">
        @forelse($this->getRecipes() as $recipe)
            <div wire:key="recipe-list-{{ $recipe->slug }}">
                @if($recipe->image)
                    <a href="{{ route('recipe', $recipe->slug) }}" wire:navigate class="link-with-image block mb-3">
                        <img src="{{ $recipe->image }}?size=small" alt="{{ $recipe->title }}" class="rounded-xl border-2 border-nord-10 w-full object-cover h-48">
                    </a>
                @endif
                <h2 class="text-xl font-bold">
                    <a class="text-nord-11 hover:text-nord-12 transition-colors duration-300"
                       href="{{ route('recipe', $recipe->slug) }}"
                       wire:navigate>
                        {{ $recipe->title }}
                    </a>
                </h2>

                @if($recipe->published_at)
                    <div class="text-xs uppercase text-nord-8 mt-1">
                        {{ $recipe->published_at->format('j.n.Y') }}
                    </div>
                @endif

                @if($recipe->description)
                    <div class="text-sm pt-2 line-clamp-3">{{ $recipe->description }}</div>
                @endif

                @if($recipe->prep_time || $recipe->cook_time)
                    <div class="text-xs text-nord-8 pt-2 flex gap-3">
                        @if($recipe->prep_time)
                            <span>Esivalmistelu {{ $recipe->prep_time }} min</span>
                        @endif
                        @if($recipe->cook_time)
                            <span>Valmistus {{ $recipe->cook_time }} min</span>
                        @endif
                    </div>
                @endif

                <div class="flex pt-2">
                    <a class="text-nord-11 text-sm hover:text-nord-12 transition-colors duration-300 inline-flex items-center"
                       href="{{ route('recipe', $recipe->slug) }}"
                       wire:navigate>
                        <span>Katso resepti</span>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="ml-1 size-4">
                            <path fill-rule="evenodd" d="M12.78 7.595a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06l3.25 3.25Zm-8.25-3.25 3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06Z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        @empty
            <div class="col-span-2 text-nord-8">
                Reseptejä ei löytynyt, kokeile toista hakusanaa tai kategoriaa!
            </div>
        @endforelse
    </div>

    @if($paginate)
        <div class="mt-8">
            {{ $this->getRecipes()->links(view: 'pagination', data: ['scrollTo' => '#recipes']) }}
        </div>
    @endif
</div>
