<?php

namespace App\Livewire;

use App\Models\Article;
use Illuminate\Support\Facades\Cache;
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
        $paginate = $this->paginate;
        $limit = $this->limit;
        $order = $this->order;

        $cacheKey = 'show_articles';
        if($tagType != null && $tag != null){
            $cacheKey .= '_'.$tagType.'_'.$tag;
        }
        $cacheKey .= '_'.$order;
        $cacheKey .= '_'.$limit;
        if($paginate){
            $cacheKey .= '_'.$this->getPage();
        }

        return Cache::remember($cacheKey, 3600, function() use ($tag, $tagType, $paginate, $limit, $order){
            $articles = Article::published()
                ->when(in_array($tagType, ['series', 'category', 'tag']) && $tag != null, function($q) use ($tag, $tagType){
                    $q->withAnyTags([$tag], $tagType);
                })
                ->with(['tags'])
                ->orderBy('published_at', $order);

            if(!$paginate){
                return $articles->limit($limit)->get();
            }
            return $articles->paginate($limit);
        });


    }
}
