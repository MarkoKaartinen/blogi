<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Support\SEO;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ShowRecipeCategory extends Component
{
    public Tag $category;

    public function mount(string $slug): void
    {
        $this->category = Cache::remember('recipe_category_'.$slug, 3600, function () use ($slug) {
            return Tag::where('slug->fi', $slug)
                ->where('type', 'recipe_category')
                ->withCount('recipes')
                ->firstOrFail();
        });

        SEO::set(
            title: $this->category->name.' - Kategoria - Reseptit',
            description: 'Tällä sivulla on listattuna kaikki kategorian '.$this->category->name.' reseptit.',
            url: route('recipe.category', $this->category->getTranslation('slug', 'fi')),
            titleSuffix: true
        );
    }

    public function render()
    {
        return view('livewire.show-recipe-category');
    }
}
