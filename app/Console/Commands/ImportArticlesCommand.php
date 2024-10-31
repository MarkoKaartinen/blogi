<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Support\MarkdownHandler;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ImportArticlesCommand extends Command
{
    protected $signature = 'blogi:import-articles {year?}';

    protected $description = 'Imports articles from markdown to database';

    public function handle(): void
    {
        $files = MarkdownHandler::getArticles($this->argument('year'));
        foreach ($files as $filepath) {
            $file = MarkdownHandler::getFile($filepath);
            $content = YamlFrontMatter::parse($file);
            $pathinfo = pathinfo($filepath);
            $year = str($pathinfo['dirname'])->replace('articles/', '')->toInteger();

            $import = true;
            if($content->matter('legacy')){
                $import = false;
            }

            if($import){
                $article = Article::updateOrCreate([
                    'year' => $year,
                    'slug' => $content->matter('slug')
                ], [
                    'title' => $content->matter('title'),
                    'description' => $content->matter('description'),
                    'file' => $filepath,
                    'status' => $content->matter('status'),
                    'published_at' => $content->matter('published_at'),
                    'updated_at' => $content->matter('updated_at'),
                ]);

                if($content->matter('categories')){
                    $article->syncTagsWithType($content->matter('categories'), 'category');
                }
                if($content->matter('tags')){
                    $article->syncTagsWithType($content->matter('tags'), 'tag');
                }
                if($content->matter('series')){
                    $article->syncTagsWithType($content->matter('series'), 'series');
                }
            }
        }

        Cache::flush();
    }
}
