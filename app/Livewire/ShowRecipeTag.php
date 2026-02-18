<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Support\SEO;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ShowRecipeTag extends Component
{
    public Tag $tag;

    public function mount(string $slug): void
    {
        $this->tag = Cache::remember('recipe_tag_'.$slug, 3600, function () use ($slug) {
            return Tag::where('slug->fi', $slug)
                ->where('type', 'recipe_tag')
                ->withCount('recipes')
                ->firstOrFail();
        });

        SEO::set(
            title: $this->tag->name.' - Avainsana - Reseptit',
            description: 'Tällä sivulla on listattuna kaikki avainsanalla '.$this->tag->name.' merkityt reseptit.',
            url: route('recipe.tag', $this->tag->getTranslation('slug', 'fi')),
            titleSuffix: true
        );
    }

    public function render()
    {
        return view('livewire.show-recipe-tag');
    }
}
