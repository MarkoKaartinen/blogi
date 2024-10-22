<?php

namespace App\Livewire;

use App\Models\Article;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;

class ShowArticles extends Component
{
    use WithPagination;

    public string|null $tagType = null;
    public string|null $tag = null;
    public string $order = 'desc';

    public function render()
    {
        return view('livewire.show-articles');
    }

    #[Computed]
    public function getArticles()
    {
        $tag = $this->tag;
        $tagType = $this->tagType;
        return Article::published()
            ->when(in_array($tagType, ['series', 'category', 'tag']) && $tag != null, function($q) use ($tag, $tagType){
                $q->withAnyTags([$tag], $tagType);
            })
            ->with(['tags'])
            ->orderBy('published_at', $this->order)
            ->paginate(10);
    }
}
