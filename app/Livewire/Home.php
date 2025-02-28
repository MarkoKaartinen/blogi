<?php

namespace App\Livewire;

use App\Models\Changelog as Log;
use App\Support\MarkdownHandler;
use App\Support\SEO;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
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

    #[Computed]
    public function getRecentChanges()
    {
        return Cache::remember('home_changelog', 3600, function() {
            return Log::orderBy('created_at', 'desc')
                ->limit(10)
                ->get();
        });
    }

    public function getContent($file)
    {
        $content = YamlFrontMatter::parse(MarkdownHandler::getFile($file));
        return str($content->body())->trim();
    }
}
