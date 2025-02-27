<?php

namespace App\Console\Commands;

use App\Models\Article;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapIndex;
use App\Models\Tag;

class GenerateSitemapCommand extends Command
{
    protected $signature = 'blogi:generate-sitemap';

    protected $description = 'Generates sitemap';

    public function handle(): void
    {
        //sivut
        $pages_sitemap_name = "pages_sitemap.xml";
        $pages_sitemap = Sitemap::create();
        $pages_sitemap->add(route('home'))
            ->add(route('blog'))
            ->add(route('search'))
            ->add(route('guestbook'))
            ->add(route('changelog'))
            ->add(route('coffee-calc'))
            ->add(route('series.all'))
            ->add(route('categories.all'))
            ->add(route('tags.all'));

        $pages = ['nyt', 'tietoa'];
        foreach ($pages as $page){
            $pages_sitemap->add(route('page', [$page]));
        }
        $pages_sitemap->writeToFile(public_path($pages_sitemap_name));

        //artikkelit
        $articles = Article::published()->get();
        $articles_sitemap_name = "articles_sitemap.xml";
        $articles_sitemap = Sitemap::create();
        foreach ($articles as $article) {
            $articles_sitemap->add(
                route("article", [$article->year, $article->slug])
            );
        }
        $articles_sitemap->writeToFile(public_path($articles_sitemap_name));

        //sarjat
        $series = Tag::whereType('series')->get();
        $series_sitemap_name = "series_sitemap.xml";
        $series_sitemap = Sitemap::create();
        foreach ($series as $serie) {
            $series_sitemap->add(route("series", [$serie->slug]));
        }
        $series_sitemap->writeToFile(public_path($series_sitemap_name));

        //kategoriat
        $categories = Tag::whereType('category')->get();
        $categories_sitemap_name = "categories_sitemap.xml";
        $categories_sitemap = Sitemap::create();
        foreach ($categories as $category) {
            $categories_sitemap->add(route("category", [$category->slug]));
        }
        $categories_sitemap->writeToFile(public_path($categories_sitemap_name));

        //avainsanat
        $tags = Tag::whereType('tag')->get();
        $tags_sitemap_name = "tags_sitemap.xml";
        $tags_sitemap = Sitemap::create();
        foreach ($tags as $tag) {
            $tags_sitemap->add(route("tag", [$tag->slug]));
        }
        $tags_sitemap->writeToFile(public_path($tags_sitemap_name));

        SitemapIndex::create()
            ->add(url($pages_sitemap_name))
            ->add(url($articles_sitemap_name))
            ->add(url($series_sitemap_name))
            ->add(url($categories_sitemap_name))
            ->add(url($tags_sitemap_name))
            ->writeToFile(public_path("sitemap_index.xml"));
    }
}
