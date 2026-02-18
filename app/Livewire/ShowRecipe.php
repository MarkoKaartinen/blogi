<?php

namespace App\Livewire;

use App\Models\Recipe;
use App\Support\SEO;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ShowRecipe extends Component
{
    public Recipe $recipe;

    public function mount(string $slug): void
    {
        $cacheKey = 'recipe_'.$slug;
        $recipe = Cache::remember($cacheKey, 3600, function () use ($slug) {
            return Recipe::where('slug', $slug)
                ->published()
                ->with(['tags'])
                ->first();
        });

        if (! $recipe instanceof Recipe) {
            abort(404);
        }

        $this->recipe = $recipe;

        SEO::set(
            title: $recipe->title.' - Reseptit',
            description: $recipe->description ?? '',
            image: route('recipe.og', [$recipe->slug]),
            url: $recipe->url,
            titleSuffix: true
        );
    }

    public function render()
    {
        return view('livewire.show-recipe');
    }

    #[Computed]
    public function relatedRecipes(): \Illuminate\Support\Collection
    {
        $recipe = $this->recipe;
        $cacheKey = 'related_recipe_'.$recipe->slug;

        return Cache::remember($cacheKey, 3600, function () use ($recipe) {
            $tags = $recipe->tags;

            if ($tags->isEmpty()) {
                return collect();
            }

            $candidates = Recipe::withAnyTags($tags)
                ->published()
                ->where('id', '!=', $recipe->id)
                ->with('tags')
                ->get();

            $now = now();

            return $candidates
                ->map(function (Recipe $candidate) use ($tags, $now) {
                    $sharedCount = $candidate->tags
                        ->whereIn('id', $tags->pluck('id'))
                        ->count();

                    $daysAgo = $candidate->published_at
                        ? $candidate->published_at->diffInDays($now)
                        : 9999;

                    $recencyBonus = max(0, 1 - ($daysAgo / 730));

                    $candidate->relevanceScore = ($sharedCount * 2) + $recencyBonus;

                    return $candidate;
                })
                ->sortByDesc('relevanceScore')
                ->take(8)
                ->values();
        });
    }
}
