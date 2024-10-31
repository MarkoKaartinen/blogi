<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Redirect;
use App\Support\MarkdownHandler;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ReplaceOldUrlsFromArticlesCommand extends Command
{
    protected $signature = 'blogi:replace-old-urls';

    protected $description = 'Replace old links from articles';

    public function handle(): void
    {
        $articles = Article::get();
        $notChanged = [];
        $changed = [];
        foreach ($articles as $article){
            $fileContents = MarkdownHandler::getFile($article->file);
            $newContens = Str::of($fileContents);
            $urls = $this->getUrls($article->content());
            foreach ($urls as $url){
                $redirect = Redirect::where('old_url', $url)->first();
                if($redirect instanceof Redirect){
                    $newContens = $newContens->replace($redirect->old_url, $redirect->new);
                    $changed[] = $url;
                }else{
                    $notChanged[] = $url;
                }
            }
        }
        dump($notChanged);
    }

    private function getUrls($content)
    {
        preg_match_all("/(?:(?:https?|ftp):\/\/)(?:\S+(?::\S*)?@)?(?:(?!10(?:\.\d{1,3}){3})(?!127(?:\.\d{1,3}){3})(?!169\.254(?:\.\d{1,3}){2})(?!192\.168(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)(?:\.(?:[a-z\x{00a1}-\x{ffff}0-9]+-?)*[a-z\x{00a1}-\x{ffff}0-9]+)*(?:\.(?:[a-z\x{00a1}-\x{ffff}]{2,})))(?::\d{2,5})?(?:\/[^\"\'\s]*)?/uix", $content, $post_links);

        $noNeedForTheseUrls = [
            'cdn.markokaartinen.net',
            'markokaartinen.net/avainsana',
            'markokaartinen.net/sarja',
            'markokaartinen.net/kategoria',
        ];

        $links = [];
        foreach ($post_links[0] as $link){
            $link = Str::of($link)->stripTags();
            if($link->contains('markokaartinen.net') && !$link->contains($noNeedForTheseUrls) && !in_array($link, $links)){
                $links[] = $link->toString();
            }
        }

        return $links;
    }
}
