<?php

namespace App\Console\Commands;

use App\Models\Recipe;
use App\Support\MarkdownHandler;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class ImportRecipesCommand extends Command
{
    protected $signature = 'blogi:import-recipes {year?}';

    protected $description = 'Imports recipes from markdown to database';

    public function handle(): void
    {
        $files = MarkdownHandler::getRecipes($this->argument('year'));

        foreach ($files as $filepath) {
            $file = MarkdownHandler::getFile($filepath);
            $content = YamlFrontMatter::parse($file);
            $pathinfo = pathinfo($filepath);
            $year = str($pathinfo['dirname'])->replace('recipes/', '')->toInteger();

            $recipe = Recipe::updateOrCreate([
                'slug' => $content->matter('slug'),
            ], [
                'title' => $content->matter('title'),
                'description' => $content->matter('description'),
                'year' => $year,
                'file' => $filepath,
                'ingredients' => $content->matter('ingredients'),
                'servings_amount' => $content->matter('servings_amount'),
                'servings_unit' => $content->matter('servings_unit'),
                'status' => $content->matter('status'),
                'post_to_mastodon' => $content->matter('post_to_mastodon') ?? true,
                'published_at' => $content->matter('published_at'),
                'updated_at' => $content->matter('updated_at'),
            ]);

            if ($content->matter('categories')) {
                $recipe->syncTagsWithType($content->matter('categories'), 'recipe_category');
            }
            if ($content->matter('tags')) {
                $recipe->syncTagsWithType($content->matter('tags'), 'recipe_tag');
            }

            $recipe->searchable();
        }

        Cache::flush();
    }
}
