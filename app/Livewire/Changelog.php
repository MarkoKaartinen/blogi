<?php

namespace App\Livewire;

use App\Support\MarkdownHandler;
use App\Support\SEO;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\YamlFrontMatter\YamlFrontMatter;
use App\Models\Changelog as Log;

class Changelog extends Component
{
    public string $title;
    public string $markdown;
    public int|null $year = null;

    public function render()
    {
        return view('livewire.changelog');
    }

    public function mount()
    {
        $file = MarkdownHandler::getFile('pages/muutosloki.md');
        $content = YamlFrontMatter::parse($file);
        $this->title = $content->matter('title');
        $this->markdown = str($content->body())->trim();

        SEO::set(
            title: $this->title,
            description: $content->matter('description'),
            image: route('page.og', ['muutosloki']),
            url: route('changelog'),
            titleSuffix: true
        );
    }

    #[Computed]
    public function getChangelogs()
    {
        $year = $this->year;
        if($year === null){
            $year = now()->format('Y');
        }

        $cacheKey = 'show_changelogs_v2_'.$year;

        return Cache::remember($cacheKey, 3600, function() use ($year) {
            return Log::orderBy('created_at', 'desc')
                ->get()
                ->groupBy(function (Log $log) {
                    return $log->created_at->format('Y-m-d');
                });
        });
    }

    public function getContent($file)
    {
        $content = YamlFrontMatter::parse(MarkdownHandler::getFile($file));
        return str($content->body())->trim();
    }
}
