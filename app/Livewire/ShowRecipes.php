<?php

namespace App\Livewire;

use App\Models\Recipe;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class ShowRecipes extends Component
{
    use WithPagination;

    public string $order = 'desc';

    public int $limit = 10;

    public bool $paginate = true;

    #[Url]
    public string $search = '';

    #[Url]
    public string $category = '';

    public ?string $filterTag = null;

    public ?string $filterTagType = null;

    public string $cols = 'grid-cols-1 sm:grid-cols-2';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategory(): void
    {
        $this->resetPage();
    }

    #[Computed]
    public function categories(): Collection
    {
        return \Spatie\Tags\Tag::where('type', 'recipe_category')->orderBy('name')->get();
    }

    #[Computed]
    public function getRecipes()
    {
        $paginate = $this->paginate;
        $limit = $this->limit;

        $activeCategory = $this->filterTagType === 'recipe_category' ? $this->filterTag : ($this->category ?: null);
        $activeTag = $this->filterTagType === 'recipe_tag' ? $this->filterTag : null;

        if ($this->search !== '') {
            $recipes = Recipe::search($this->search)
                ->when($activeCategory !== null, fn ($query) => $query->where('categories', $activeCategory))
                ->when($activeTag !== null, fn ($query) => $query->where('tags', $activeTag));

            return $paginate ? $recipes->paginate($limit) : $recipes->limit($limit)->get();
        }

        $cacheKey = 'show_recipes';
        if ($this->filterTagType !== null && $this->filterTag !== null) {
            $cacheKey .= '_'.$this->filterTagType.'_'.$this->filterTag;
        } elseif ($activeCategory !== null) {
            $cacheKey .= '_category_'.$activeCategory;
        }
        $cacheKey .= '_'.$limit;
        if ($paginate) {
            $cacheKey .= '_'.$this->getPage();
        }

        return Cache::remember($cacheKey, 3600, function () use ($activeCategory, $activeTag, $paginate, $limit) {
            $recipes = Recipe::published()
                ->when($activeCategory !== null, fn ($query) => $query->withAnyTags([$activeCategory], 'recipe_category'))
                ->when($activeTag !== null, fn ($query) => $query->withAnyTags([$activeTag], 'recipe_tag'))
                ->with('tags')
                ->orderBy('published_at', 'desc');

            return $paginate ? $recipes->paginate($limit) : $recipes->limit($limit)->get();
        });
    }

    public function render()
    {
        return view('livewire.show-recipes');
    }
}
