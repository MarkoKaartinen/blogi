<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class MarkdownHandler
{
    public static function getArticles($year = null): array
    {
        $filepath = 'articles';
        if ($year) {
            $filepath .= '/'.$year;
        }

        return collect(Storage::disk('content')
            ->allFiles($filepath))
            ->filter(fn ($value) => str($value)->endsWith('.md'))
            ->toArray();
    }

    public static function getFile($file)
    {
        if (! Storage::disk('content')->exists($file)) {
            return false;
        }

        return Storage::disk('content')->get($file);
    }

    public static function getArticle($year, $slug)
    {
        // Validate inputs to prevent directory traversal
        if (str_contains($year, '..') || str_contains($slug, '..') || str_contains($slug, '/')) {
            return false;
        }

        $filePath = "articles/$year/$slug.md";

        return self::getFile($filePath);
    }

    public static function getRecipes($year = null): array
    {
        $filepath = 'recipes';
        if ($year) {
            $filepath .= '/'.$year;
        }

        return collect(Storage::disk('content')
            ->allFiles($filepath))
            ->filter(fn ($value) => str($value)->endsWith('.md'))
            ->toArray();
    }

    public static function getRecipe($year, $slug)
    {
        if (str_contains($year, '..') || str_contains($slug, '..') || str_contains($slug, '/')) {
            return false;
        }

        $filePath = "recipes/$year/$slug.md";

        return self::getFile($filePath);
    }

    public static function getPage($slug)
    {
        // Validate input to prevent directory traversal
        if (str_contains($slug, '..') || str_contains($slug, '/')) {
            return false;
        }

        $filePath = "pages/$slug.md";

        return self::getFile($filePath);
    }
}
