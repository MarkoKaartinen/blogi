<?php

namespace App\Livewire;

use App\Models\Article;
use Carbon\Carbon;
use Livewire\Attributes\Computed;
use Livewire\Component;

class ShowArticle extends Component
{
    public null|Carbon $published_at = null;
    public null|Carbon $updated_at = null;

    public Article $article;

    public null|Article $previousArticle;
    public null|Article $nextArticle;

    public function mount($year, $slug)
    {
        $article = Article::where('year', $year)
            ->where('slug', $slug)
            ->with(['tags', 'legacy_comments'])
            ->firstOrFail();
        $this->article = $article;

        $this->previousArticle = Article::where('published_at', '<', $article->published_at)
            ->whereNotNull('published_at')
            ->where('status', 'published')
            ->orderBy('published_at', 'desc')
            ->first();

        $this->nextArticle = Article::where('published_at', '>', $article->published_at)
            ->whereNotNull('published_at')
            ->where('status', 'published')
            ->orderBy('published_at')
            ->first();

    }

    public function render()
    {
        return view('livewire.show-article');
    }

    #[Computed]
    public function getSeriesInfo(): array
    {
        $articleSeriesInfo = [];
        if($this->article->tagsWithType('series')->count() > 0){
            foreach ($this->article->tagsWithType('series') as $seriesTag){
                $seriesArticles = Article::withAnyTags($seriesTag)->published()->orderBy('published_at')->get();
                $position = 1;
                $i = 1;
                foreach ($seriesArticles as $seriesArticle){
                    if($seriesArticle->id == $this->article->id){
                        $position = $i;
                    }
                    $i++;
                }
                $articleSeriesInfo[$seriesTag->slug] = [
                    'count' => $seriesArticles->count(),
                    'position' => $position,
                    'articles' => $seriesArticles,
                ];
            }
        }
        return $articleSeriesInfo;
    }
}
