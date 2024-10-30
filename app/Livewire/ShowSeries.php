<?php

namespace App\Livewire;

use App\Models\Article;
use App\Support\SEO;
use Livewire\Component;
use App\Models\Tag;

class ShowSeries extends Component
{
    public Tag $series;

    public function mount($slug)
    {
        $this->series = Tag::where('slug->fi', $slug)
            ->where('type', 'series')
            ->withCount('articles')
            ->firstOrFail();

        SEO::set(
            title: $this->series->name . ' - Sarja',
            description: 'Tällä sivulla on listattuna kaikki sarjan '.$this->series->name.' artikkelit.',
            url: route('series', [$this->series->slug]),
            titleSuffix: true
        );
    }

    public function render()
    {
        return view('livewire.show-series');
    }
}
