<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Support\SEO;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class ShowAllCategories extends Component
{
    public function mount()
    {
        SEO::set(
            title: 'Kategoriat',
            description: 'Tällä sivulla on listattuna kaikki MarkoKaartinen.net blogissa olevat kategoriat',
            url: route('categories.all'),
            titleSuffix: true
        );
    }

    public function render()
    {
        return view('livewire.show-all-categories', [
            'categories' => $this->getCategories(),
        ]);
    }

    public function getCategories()
    {
        return Cache::remember('categories_all', 3600, function(){
            return Tag::where('type', 'category')
                ->withCount('articles')
                ->orderBy('articles_count', 'desc')
                ->get();
        });
    }
}
