<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ShowArticle extends Component
{
    public string $markdown;
    public string $title;

    public null|Carbon $published_at = null;
    public null|Carbon $updated_at = null;

    public null|array $categories = null;
    public null|array $tags = null;

    public null|string $series = null;

    public function mount($year, $slug)
    {
        $filePath = "articles/$year/$slug.md";
        $file = Storage::disk('content')->get($filePath);
        $content = YamlFrontMatter::parse($file);
        $this->title = $content->matter('title');
        $this->markdown = str($content->body())->trim();

        if($content->matter('published_at')){
            $this->published_at = Carbon::parse($content->matter('published_at'));
        }
        if($content->matter('updated_at')){
            $this->updated_at = Carbon::parse($content->matter('updated_at'));
        }
        if($content->matter('categories')){
            $this->categories = $content->matter('categories');
        }
        if($content->matter('tags')){
            $this->tags = $content->matter('tags');
        }
        if($content->matter('series')){
            $this->series = $content->matter('series');
        }
    }

    public function render()
    {
        return view('livewire.article');
    }
}
