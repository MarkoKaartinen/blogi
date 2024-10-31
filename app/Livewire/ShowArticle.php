<?php

namespace App\Livewire;

use App\Models\Article;
use App\Support\SEO;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
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
        $cacheKey = 'article_'.$year.'_'.$slug;
        $article = Cache::remember($cacheKey, 3600, function() use ($year, $slug){
            return Article::where('year', $year)
                ->where('slug', $slug)
                ->with(['tags', 'legacy_comments'])
                ->first();
        });

        if(!$article instanceof Article){
            abort(404);
        }

        $this->article = $article;

        SEO::set(
            title: $article->title,
            description: $article->seo_description,
            image: route('article.og', [$article->slug]),
            url: $article->url,
            titleSuffix: true
        );

        $this->previousArticle = Cache::remember($cacheKey.'_previous', 3600, function() use ($article){
            return Article::where('published_at', '<', $article->published_at)
                ->whereNotNull('published_at')
                ->where('status', 'published')
                ->orderBy('published_at', 'desc')
                ->first();
        });

        $this->nextArticle = Cache::remember($cacheKey.'_next', 3600, function() use($article){
            return Article::where('published_at', '>', $article->published_at)
                ->whereNotNull('published_at')
                ->where('status', 'published')
                ->orderBy('published_at')
                ->first();
        });
    }

    public function render()
    {
        return view('livewire.show-article');
    }

    #[Computed]
    public function getSeriesInfo(): array
    {
        $article = $this->article;
        $cacheKey = 'series_'.$article->year.'_'.$article->slug;
        return Cache::remember($cacheKey, 3600, function() use ($article) {
            $articleSeriesInfo = [];
            if($article->tagsWithType('series')->count() > 0){
                foreach ($article->tagsWithType('series') as $seriesTag){
                    $seriesArticles = Article::withAnyTags($seriesTag)->published()->orderBy('published_at')->get();
                    $position = 1;
                    $i = 1;
                    foreach ($seriesArticles as $seriesArticle){
                        if($seriesArticle->id == $article->id){
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
        });
    }
}
