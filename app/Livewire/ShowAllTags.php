<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Support\SEO;
use Livewire\Component;

class ShowAllTags extends Component
{
    public function mount()
    {
        SEO::set(
            title: 'Avainsanat',
            description: 'Tällä sivulla on listattuna kaikki MarkoKaartinen.net blogissa olevat avainsanat',
            url: route('tags.all'),
            titleSuffix: true
        );
    }

    public function render()
    {
        return view('livewire.show-all-tags', [
            'tags' => Tag::where('type', 'tag')
                ->withCount('articles')
                ->orderBy('articles_count', 'desc')
                ->get(),
        ]);
    }
}
