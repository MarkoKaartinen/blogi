<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Recipe;
use App\Support\MarkdownHandler;
use App\Support\SEO;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Search extends Component
{
    use WithPagination;

    #[Url]
    public string $keywords = '';

    public string $title;

    public function mount(): void
    {
        $file = MarkdownHandler::getFile('pages/haku.md');
        $content = YamlFrontMatter::parse($file);
        $this->title = $content->matter('title');

        SEO::set(
            title: $this->title,
            description: $content->matter('description'),
            image: route('page.og', ['haku']),
            url: route('search'),
            titleSuffix: true
        );
    }

    public function updatedKeywords(): void
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.search', [
            'results' => $this->paginatedResults(),
        ]);
    }

    private function combinedResults(): Collection
    {
        if ($this->keywords === '') {
            return collect();
        }

        $highlightCallback = function ($meilisearch, $query, $options) {
            $options['attributesToHighlight'] = ['title', 'description'];

            return $meilisearch->search($query, $options);
        };

        $articleHits = collect(
            Article::search($this->keywords, $highlightCallback)->take(50)->raw()['hits'] ?? []
        )->map(fn ($hit) => array_merge($hit, ['_type' => 'article']));

        $recipeHits = collect(
            Recipe::search($this->keywords, $highlightCallback)->take(50)->raw()['hits'] ?? []
        )->map(fn ($hit) => array_merge($hit, ['_type' => 'recipe']));

        $results = collect();
        $maxCount = max($articleHits->count(), $recipeHits->count());

        for ($i = 0; $i < $maxCount; $i++) {
            if ($articleHits->has($i)) {
                $results->push($articleHits->values()[$i]);
            }
            if ($recipeHits->has($i)) {
                $results->push($recipeHits->values()[$i]);
            }
        }

        return $results;
    }

    private function paginatedResults(): LengthAwarePaginator
    {
        $all = $this->combinedResults();
        $perPage = 10;
        $page = $this->getPage();

        return new LengthAwarePaginator(
            $all->forPage($page, $perPage)->values(),
            $all->count(),
            $perPage,
            $page,
            ['pageName' => 'page']
        );
    }
}
