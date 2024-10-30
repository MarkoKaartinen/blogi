<?php

namespace App\Livewire;

use App\Models\Article;
use App\Support\SEO;
use Livewire\Attributes\Computed;
use Livewire\Component;
use App\Models\Tag;

class ShowTag extends Component
{

    public Tag $tag;

    public function mount($slug)
    {
        $this->tag = Tag::where('slug->fi', $slug)
            ->where('type', 'tag')
            ->withCount('articles')
            ->firstOrFail();

        SEO::set(
            title: $this->tag->name . ' - Avainsana',
            description: 'Tällä sivulla on listattuna kaikki avainsanan '.$this->tag->name.' artikkelit.',
            url: route('tag', [$this->tag->slug]),
            titleSuffix: true
        );
    }

    public function render()
    {
        return view('livewire.show-tag');
    }
}
