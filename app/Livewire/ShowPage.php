<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ShowPage extends Component
{
    public null|Carbon $updated_at = null;
    public string $title;
    public string $markdown;

    public function mount($page)
    {
        $filePath = "pages/$page.md";
        if(!Storage::disk('content')->exists($filePath)){
            abort(404);
        }
        $file = Storage::disk('content')->get($filePath);

        $content = YamlFrontMatter::parse($file);
        $this->title = $content->matter('title');
        $this->markdown = str($content->body())->trim();

        if($content->matter('show_updated_at')){
            if($content->matter('updated_at')){
                $this->updated_at = Carbon::parse($content->matter('updated_at'));
            }
        }

    }

    public function render()
    {
        return view('livewire.page');
    }
}
