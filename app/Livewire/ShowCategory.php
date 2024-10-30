<?php

namespace App\Livewire;

use App\Models\Article;
use App\Support\SEO;
use Livewire\Component;
use App\Models\Tag;

class ShowCategory extends Component
{
    public Tag $category;

    public function mount($slug)
    {
        $this->category = Tag::where('slug->fi', $slug)
            ->where('type', 'category')
            ->withCount('articles')
            ->firstOrFail();

        SEO::set(
            title: $this->category->name . ' - Kategoria',
            description: 'Tällä sivulla on listattuna kaikki kategorian '.$this->category->name.' artikkelit.',
            url: route('category', [$this->category->slug]),
            titleSuffix: true
        );
    }

    public function render()
    {
        return view('livewire.show-category');
    }
}
