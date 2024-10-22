<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Search extends Component
{
    use WithPagination;

    #[Url]
    public string $keywords = '';

    public function render()
    {
        return view('livewire.search', [
            'articles' => Article::search($this->keywords)
                ->paginate(10),
            'random' => Article::published()->inRandomOrder()->limit(10)->get(),
        ]);
    }
}
