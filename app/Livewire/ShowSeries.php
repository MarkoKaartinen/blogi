<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;
use Spatie\Tags\Tag;

class ShowSeries extends Component
{
    public Tag $series;
    public $articleCount = 0;

    public function mount($slug)
    {
        $this->series = Tag::where('slug->fi', $slug)
            ->where('type', 'series')
            ->firstOrFail();
        $this->articleCount = Article::withAnyTags($this->series)->count();
    }

    public function render()
    {
        return view('livewire.show-series');
    }
}
