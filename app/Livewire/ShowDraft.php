<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Component;

class ShowDraft extends Component
{
    public Article $article;

    public function mount($year, $slug)
    {
        $article = Article::where('year', $year)
            ->unpublished()
            ->where('slug', $slug)
            ->with(['tags'])
            ->firstOrFail();

        $this->article = $article;
    }

    public function render()
    {
        return view('livewire.show-draft');
    }
}
