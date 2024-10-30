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
    public int $limit = 10;
    public bool $paginate = true;
    public string $heading = 'h2';
    public string $spacing = 'normal';

    public function render()
    {
        return view('livewire.show-articles');
    }

    #[Computed]
    public function getArticles()
    {
        $tag = $this->tag;
        $tagType = $this->tagType;
        $articles = Article::published()
            ->when(in_array($tagType, ['series', 'category', 'tag']) && $tag != null, function($q) use ($tag, $tagType){
                $q->withAnyTags([$tag], $tagType);
            })
            ->with(['tags'])
            ->orderBy('published_at', $this->order);

        if(!$this->paginate){
            return $articles->limit($this->limit)->get();
        }
        return $articles->paginate($this->limit);
    }
}
