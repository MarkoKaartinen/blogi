<?php

namespace App\Livewire;

use App\Models\Redirect;
use App\Support\MarkdownHandler;
use App\Support\SEO;
use Carbon\Carbon;
use Livewire\Component;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ShowPage extends Component
{
    public null|Carbon $updated_at = null;
    public string $title;
    public string $markdown;

    public function mount($page)
    {

        $file = MarkdownHandler::getPage($page);
        if(!$file) {
            //since this is kinda catchall web route, check for redirects
            return $this->checkRedirect($page);
        }

        $content = YamlFrontMatter::parse($file);
        $this->title = $content->matter('title');
        $this->markdown = str($content->body())->trim();


        SEO::set(
            title: $this->title,
            description: $content->matter('description'),
            image: route('page.og', [$page]),
            url: route('page', [$page]),
            titleSuffix: true
        );

        if($content->matter('show_updated_at')){
            if($content->matter('updated_at')){
                $this->updated_at = Carbon::parse($content->matter('updated_at'));
            }
        }

    }

    public function render()
    {
        return view('livewire.show-page');
    }

    public function checkRedirect($page)
    {
        $redirect = Redirect::where('old', $page)->first();
        if($redirect instanceof Redirect){
            $redirect->increment('hits');
            return $this->redirect($redirect->new, navigate: true);
        }

        abort(404);
    }
}
