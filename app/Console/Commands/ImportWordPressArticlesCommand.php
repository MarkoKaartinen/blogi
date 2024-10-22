<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\LegacyComment;
use App\Models\Redirect;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use function Laravel\Prompts\warning;
use function Laravel\Prompts\confirm;
use function Laravel\Prompts\info;
use function Laravel\Prompts\text;
use function Laravel\Prompts\progress;

class ImportWordPressArticlesCommand extends Command
{
    protected $signature = 'blogi:import-wp';

    protected $description = 'Imports stuff from WP';

    public function handle(): void
    {
        warning('Tämä on hyvinkin kokeellinen koodinpätkä ja toimii vain jos WP puolelta on tehty tiettyjä määreitä. Tässä ei ole järkeviä validointeja ja koodi tekee paljon olettamuksia. Sinun oikeastaan pitää tietää miten homma toimii.');

        $continue = confirm(
            label: 'Oletko nyt ihan varma, että haluat ajaa tämän komennon?',
            default: false,
            yes: 'Kyllä',
            no: 'Ei, peruuta!'
        );

        if(!$continue){
            info('Homma peruutettu!');
            return ;
        }

        $page = text(
            label: 'Mikä sivu?',
            validate: ['page' => 'numeric|required'],
            hint: 'Tehdään WP:n jsonista haku tältä sivulta.'
        );

        $amount = text(
            label: 'Montako artikkelia?',
            default: 100,
            validate: ['amount' => 'numeric|required'],
            hint: 'Tehdään WP:n jsonista haku tältä määrällä per sivu.'
        );

        info('Aloitetaan puuhastelu! Tuodaan '.$amount.' kpl artikkeleita sivulta numero '.$page.'.');

        $endpoint = config('services.wordpress.url').'/wp-json/wp/v2/posts?page='.$page.'&per_page='.$amount.'&context=edit';

        $request = Http::withBasicAuth(config('services.wordpress.username'), config('services.wordpress.password'))->get($endpoint);


        if(!$request->successful()){
            warning('Virheellinen pyyntö, tarkista sivunumero ja määrä.');
            return ;
        }
        $importAmount = count($request->json());

        $progress = progress(label: 'Tuodaan artikkeleita WordPressistä', steps: $importAmount);
        $progress->start();
        foreach ($request->object() as $post){
            $postID = $post->id;
            $title = html_entity_decode($post->title->raw);
            $slug = $post->slug;
            $description = null;
            if(isset($post->yoast_head_json->og_description)){
                $description = html_entity_decode($post->yoast_head_json->og_description);
            }
            $published_at = \Carbon\Carbon::parse($post->date);
            $updated_at = \Carbon\Carbon::parse($post->modified);
            $year = $published_at->format('Y');

            $content = $post->content->rendered;
            $content = Str::of($content)
                ->replace('https://markokaartinen.net/wp-content', 'https://cdn.markokaartinen.net')
                ->replace('https://markokaartinen.net/app/uploads', 'https://cdn.markokaartinen.net/uploads')
                ->trim();

            $status = 'published';
            if($post->status != 'publish'){
                $status = 'draft';
            }

            $cats = "";
            $catsArr = [];
            if(is_array($post->mcategories) && count($post->mcategories) > 0){
                $cats = "categories:";
                foreach ($post->mcategories as $cat){
                    $catsArr[] = html_entity_decode($cat->name);
                    $cats .= "\n- ".html_entity_decode($cat->name);
                }
            }

            $tags = "";
            $tagsArr = [];
            if(is_array($post->mtags) && count($post->mtags) > 0){
                $tags = "\ntags:";
                foreach ($post->mtags as $tag){
                    $tagsArr[] = html_entity_decode($tag->name);
                    $tags .= "\n- ".html_entity_decode($tag->name);
                }
            }

            $series = "";
            $seriesArr = [];
            if(is_array($post->mseries) && count($post->mseries) > 0){
                $series = "\nseries:";
                foreach ($post->mseries as $serie){
                    $seriesArr[] = html_entity_decode($serie->name);
                    $series .= "\n- ".html_entity_decode($serie->name);
                }
            }

            $titleQuotes = "'";
            if(str($title)->contains("'")){
                $titleQuotes = '"';
            }

            $markdown = "---
title: $titleQuotes$title$titleQuotes
slug: $slug
status: published
published_at: ".$published_at->format('Y-m-d H:i')."
updated_at: ".$updated_at->format('Y-m-d H:i')."
description: |
    $description
legacy: true
$cats$tags$series
---

$content";

            $filepath = "articles/$year/$slug.md";
            Storage::disk('content')->put($filepath, $markdown);

            $article = Article::updateOrCreate([
                'year' => $year,
                'slug' => $slug
            ], [
                'title' => $title,
                'description' => $description,
                'file' => $filepath,
                'status' => $status,
                'published_at' => $published_at,
                'updated_at' => $updated_at,
                'legacy' => true,
            ]);

            if(count($tagsArr) > 0){
                $article->syncTagsWithType($tagsArr, 'tag');
            }
            if(count($catsArr) > 0){
                $article->syncTagsWithType($catsArr, 'category');
            }
            if(count($seriesArr) > 0){
                $article->syncTagsWithType($seriesArr, 'series');
            }


            if(is_array($post->mcomments) && count($post->mcomments) > 0){
                foreach ($post->mcomments as $comment){
                    LegacyComment::updateOrCreate([
                        'name' => html_entity_decode($comment->comment_author),
                        'email' => $comment->comment_author_email,
                        'created_at' => $comment->comment_date,
                        'body' => html_entity_decode($comment->comment_content),
                        'article_id' => $article->id,
                    ]);
                }
            }

            Redirect::updateOrCreate([
                'old' => $slug,
            ], [
                'new' => $article->url
            ]);

            $progress->advance();

        }

        $progress->finish();

        info('Tuotiin '.$importAmount.' artikkelia!');
    }
}
