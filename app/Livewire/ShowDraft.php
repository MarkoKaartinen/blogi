<?php

namespace App\Livewire;

use App\Models\Article;
use App\Support\MarkdownHandler;
use Livewire\Component;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ShowDraft extends Component
{
    public Article $article;

    public string $title;
    public string $markdown;

    public $year;
    public $slug;

    public function mount($year, $slug)
    {
        $file = MarkdownHandler::getArticle($year, $slug);
        $content = YamlFrontMatter::parse($file);

        $this->year = $year;
        $this->slug = $slug;
        $this->markdown = str($content->body())->trim();
        $this->title = $content->matter('title');

    }

    public function render()
    {
        return view('livewire.show-draft');
    }
}
