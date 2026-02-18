<div wire:key="recipe-{{ $recipe->slug }}" class="px-6 md:px-0">
    <h1 class="font-extrabold text-3xl md:text-4xl lg:text-5xl">{{ $recipe->title }}</h1>

    @if($recipe->published_at)
        <div class="text-sm text-nord-8 uppercase mt-1">
            {{ str($recipe->published_at->dayName)->ucfirst() }}na
            {{ $recipe->published_at->format('j.') }} {{ $recipe->published_at->monthName }}ta {{ $recipe->published_at->format('Y') }}
        </div>
    @endif

    @if($recipe->image)
        <div class="mt-6">
            <a href="{{ $recipe->image }}?size=xl" class="link-with-image glightbox"><img src="{{ $recipe->image }}" alt="{{ $recipe->title }}" class="rounded-xl border-2 border-nord-10 w-full object-cover max-h-96"></a>
        </div>
    @endif

    @if($recipe->description)
        <div class="textcontent">
            <p class="lead">{{ $recipe->description }}</p>
        </div>
    @endif

    @if($recipe->mastodon_post_id)
        <livewire:mastodon-reactions :status="$recipe->mastodon_post_id" />
    @endif

    {{-- Ainesosat --}}
    @if($recipe->ingredients)
        <div class="mt-8" x-data="{
            currentServings: {{ $recipe->servings_amount ?? 1 }},
            baseServings: {{ $recipe->servings_amount ?? 1 }},
            formatAmount(amount) {
                if (amount === null || amount === undefined || amount === '') return '';
                const str = String(amount);
                const num = str.includes('/')
                    ? parseFloat(str.split('/')[0]) / parseFloat(str.split('/')[1])
                    : parseFloat(str);
                const scaled = num * this.currentServings / this.baseServings;
                const whole = Math.floor(scaled);
                const frac = scaled - whole;
                if (frac < 0.01) return whole.toString();
                if (frac > 0.99) return (whole + 1).toString();
                const gcd = (a, b) => b === 0 ? a : gcd(b, a % b);
                let bestNum = 1, bestDen = 2, bestError = Infinity;
                for (let den = 2; den <= 8; den++) {
                    const n = Math.round(frac * den);
                    if (n === 0 || n === den) continue;
                    const error = Math.abs(frac - n / den);
                    if (error < bestError) { bestError = error; bestNum = n; bestDen = den; }
                }
                const g = gcd(bestNum, bestDen);
                const fracStr = `${bestNum / g}/${bestDen / g}`;
                return whole === 0 ? fracStr : `${whole} ${fracStr}`;
            }
        }">
            <div class=" mb-4">
                <h2 class="text-2xl font-extrabold mb-4">Ainesosat</h2>

                @if($recipe->servings_amount)
                    <div>
                        <div class="inline-flex items-center gap-2 text-sm bg-theme-0 rounded-lg px-3 py-1.5">
                            <button type="button" @click="currentServings = Math.max(1, currentServings - 1)" class="size-6 flex items-center justify-center rounded border border-nord-3 hover:bg-nord-2 transition-colors duration-150 font-bold">−</button>
                            <span class="font-bold min-w-[1.5rem] text-center" x-text="currentServings"></span>
                            <button type="button" @click="currentServings++" class="size-6 flex items-center justify-center rounded border border-nord-3 hover:bg-nord-2 transition-colors duration-150 font-bold">+</button>
                            @if($recipe->servings_unit)
                                <span class="text-nord-8 uppercase text-xs">{{ str($recipe->servings_unit)->ucfirst() }}</span>
                            @endif
                        </div>
                        <button x-show="currentServings !== baseServings" x-cloak @click="currentServings = baseServings" class="text-xs text-nord-8 hover:text-nord-4 transition-colors duration-150 ml-1">Nollaa</button>
                    </div>
                @endif
            </div>

            <ul class="space-y-1">
                @foreach($recipe->ingredients as $ingredient)
                    @if(isset($ingredient['section']))
                        <li class="font-bold text-nord-13 mt-4 first:mt-0">{{ $ingredient['section'] }}</li>
                    @else
                        <li class="flex gap-3">
                                            <span class="text-nord-8 min-w-[5rem] text-right shrink-0">
                                    @if(isset($ingredient['amount']))
                                        @if($recipe->servings_amount)
                                            <span x-text="formatAmount('{{ $ingredient['amount'] }}')"></span>
                                        @else
                                            {{ $ingredient['amount'] }}
                                        @endif
                                    @endif
                                    {{ isset($ingredient['unit']) ? ' '.$ingredient['unit'] : '' }}
                                </span>
                            <span>{{ $ingredient['name'] ?? '' }}</span>
                        </li>
                    @endif
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Valmistusohje --}}
    <div class="textcontent mt-8">
        @markdown($recipe->body)
    </div>

    {{-- Tagit --}}
    @php
        $recipeCategories = $recipe->tagsWithType('recipe_category');
        $recipeTags = $recipe->tagsWithType('recipe_tag');
    @endphp

    @if($recipeCategories->isNotEmpty() || $recipeTags->isNotEmpty())
        <div class="pt-6 flex flex-col gap-2">
            @if($recipeCategories->isNotEmpty())
                <div>
                    @foreach($recipeCategories as $category)
                        <a href="{{ route('recipe.category', $category->getTranslation('slug', 'fi')) }}" wire:navigate class="md:text-lg font-bold uppercase text-nord-13 hover:text-nord-12 transition-colors duration-300">{{ $category->name }}</a>
                        @if(!$loop->last) / @endif
                    @endforeach
                </div>
            @endif
            @if($recipeTags->isNotEmpty())
                <div class="overflow-clip -m-1 flex flex-wrap">
                    @foreach($recipeTags as $tag)
                        <div class="p-1">
                            <a href="{{ route('recipe.tag', $tag->getTranslation('slug', 'fi')) }}" wire:navigate class="bg-nord-13 text-nord-0 text-sm font-bold rounded px-1.5 py-0.5 leading-none lowercase hover:bg-nord-12 transition-colors duration-300">#{{ $tag->name }}</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    @if($this->relatedRecipes->isNotEmpty())
        <div>
            <div class="h-1 w-20 rounded-full bg-nord-9 my-12"></div>

            <h2 class="text-xl font-extrabold mb-4">Myös nämä saattaisi kiinnostaa</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                @foreach($this->relatedRecipes->shuffle()->take(4) as $related)
                    <div>
                        <h3 class="text-lg font-semibold">
                            <a class="text-nord-14 hover:text-nord-12 transition-colors duration-300" href="{{ $related->url }}" wire:navigate>{{ $related->title }}</a>
                        </h3>
                        <div class="text-xs uppercase text-nord-8 mt-1">
                            {{ $related->published_at?->format('j.n.Y') }}
                        </div>
                        @if($related->description)
                            <div class="text-xs pt-2 line-clamp-3">{{ $related->description }}</div>
                        @endif
                        <div class="flex pt-2">
                            <a class="text-nord-14 text-xs hover:text-nord-12 transition-colors duration-300 inline-flex items-center" href="{{ $related->url }}" wire:navigate>
                                <span>Katso resepti</span>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="ml-1 size-4">
                                    <path fill-rule="evenodd" d="M12.78 7.595a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06l3.25 3.25Zm-8.25-3.25 3.25 3.25a.75.75 0 0 1 0 1.06l-3.25 3.25a.75.75 0 0 1-1.06-1.06l2.72-2.72-2.72-2.72a.75.75 0 0 1 1.06-1.06Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <x-discussion
        :commentable-id="$recipe->id"
        :commentable-type="\App\Models\Recipe::class"
        :mastodon-post-id="$recipe->mastodon_post_id"
    >
        Osallistu keskusteluun Mastodonin tai blogin kautta.
    </x-discussion>
</div>
