<?php

namespace App\Livewire;

use App\Support\MarkdownHandler;
use App\Support\SEO;
use Livewire\Component;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class Home extends Component
{
    public string $title;
    public string $markdown;

    public function mount()
    {
        $file = MarkdownHandler::getFile('pages/koti.md');
        $content = YamlFrontMatter::parse($file);
        $this->title = $content->matter('title');
        $this->markdown = str($content->body())->trim();

        SEO::set(
            title: $this->title,
            description: $content->matter('description'),
            image: route('page.og', ['koti']),
            url: route('home'),
            type: 'website'
        );
    }

    public function render()
    {
        return view('livewire.home');
    }
}
