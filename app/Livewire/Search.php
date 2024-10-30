<?php

namespace App\Livewire;

use App\Models\Article;
use App\Support\MarkdownHandler;
use App\Support\SEO;
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

    public function mount()
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

    public function render()
    {
        return view('livewire.search', [
            'articles' => Article::search($this->keywords)
                ->paginateRaw(10),
        ]);
    }
}
