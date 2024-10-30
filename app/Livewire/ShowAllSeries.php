<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Support\SEO;
use Livewire\Component;

class ShowAllSeries extends Component
{
    public function mount()
    {
        SEO::set(
            title: 'Sarjat',
            description: 'Tällä sivulla on listattuna kaikki MarkoKaartinen.net blogissa olevat sarjat',
            url: route('series.all'),
            titleSuffix: true
        );
    }

    public function render()
    {
        return view('livewire.show-all-series', [
            'series' => Tag::where('type', 'series')
                ->withCount('articles')
                ->orderBy('articles_count', 'desc')
                ->get(),
        ]);
    }
}
