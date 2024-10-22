<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Spatie\Tags\Tag;

class ShowCategory extends Component
{
    public Tag $category;
    public $articleCount = 0;

    public function mount($slug)
    {
        $this->category = Tag::where('slug->fi', $slug)
            ->where('type', 'category')
            ->firstOrFail();
        $this->articleCount = Article::withAnyTags($this->category)->count();
    }

    public function render()
    {
        return view('livewire.show-category');
    }
}
