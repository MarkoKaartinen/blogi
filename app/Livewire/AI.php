<?php

namespace App\Livewire;

use App\Support\MarkdownHandler;
use App\Support\SEO;
use Livewire\Component;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class AI extends Component
{
    public string $title;
    public string $markdown;
    public array $blogs;

    public function render()
    {
        return view('livewire.ai');
    }

    public function mount()
    {
        $file = MarkdownHandler::getFile('pages/ai.md');
        $content = YamlFrontMatter::parse($file);
        $this->title = $content->matter('title');
        $this->markdown = str($content->body())->trim();

        $this->blogs = config('blog.human_json_blogs');

        SEO::set(
            title: $this->title,
            description: $content->matter('description'),
            image: route('page.og', ['ai']),
            url: route('ai'),
            titleSuffix: true
        );
    }
}
