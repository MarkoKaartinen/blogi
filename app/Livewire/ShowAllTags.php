<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Support\SEO;
use Illuminate\Support\Facades\Cache;
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
            'tags' => $this->getTags(),
        ]);
    }

    public function getTags()
    {
        return Cache::remember('tags_all', 3600, function(){
            return Tag::where('type', 'tag')
                ->withCount('articles')
                ->orderBy('articles_count', 'desc')
                ->get();
        });
    }
}
