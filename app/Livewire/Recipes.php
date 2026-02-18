<?php

namespace App\Livewire;

use App\Support\MarkdownHandler;
use App\Support\SEO;
use Livewire\Component;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Recipes extends Component
{
    public string $title;

    public string $markdown;

    public function mount()
    {
        $file = MarkdownHandler::getFile('pages/reseptit.md');
        $content = YamlFrontMatter::parse($file);
        $this->title = $content->matter('title');
        $this->markdown = str($content->body())->trim();

        SEO::set(
            title: $this->title,
            description: $content->matter('description'),
            image: route('page.og', ['reseptit']),
            url: route('recipes'),
            titleSuffix: true
        );
    }

    public function render()
    {
        return view('livewire.recipes');
    }
}
