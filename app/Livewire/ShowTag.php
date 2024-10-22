<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Spatie\Tags\Tag;

class ShowTag extends Component
{

    public Tag $tag;
    public $articleCount = 0;

    public function mount($slug)
    {
        $this->tag = Tag::where('slug->fi', $slug)
            ->where('type', 'tag')
            ->firstOrFail();
        $this->articleCount = Article::withAnyTags($this->tag)->count();
    }

    public function render()
    {
        return view('livewire.show-tag');
    }
}
