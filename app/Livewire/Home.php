<?php

namespace App\Livewire;

use App\Support\MarkdownHandler;
use Livewire\Component;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Home extends Component
{
    public string $title;
    public string $markdown;

    public function mount()
    {
        $file = MarkdownHandler::getFile('pages/home.md');
        $content = YamlFrontMatter::parse($file);
        $this->title = $content->matter('title');
        $this->markdown = str($content->body())->trim();
    }

    public function render()
    {
        return view('livewire.home');
    }
}
