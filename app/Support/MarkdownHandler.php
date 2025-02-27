<?php

namespace App\Support;

use Illuminate\Support\Facades\Storage;

class MarkdownHandler
{
    public static function getArticles($year = null): array
    {
        $filepath = 'articles';
        if($year){
            $filepath .= '/' . $year;
        }
        return collect(Storage::disk('content')
            ->allFiles($filepath))
            ->filter(function($value, $key){
                return !str($value)->contains(['.DS_Store']);
            })
            ->toArray();
    }

    public static function getChangelogs($year, $month): array
    {
        $filepath = 'changelogs/'.$year.'/'.$month;
        return collect(Storage::disk('content')
            ->allFiles($filepath))
            ->filter(function($value, $key){
                return !str($value)->contains(['.DS_Store']);
            })
            ->toArray();
    }

    public static function getFile($file)
    {
        if(!Storage::disk('content')->exists($file)){
            return false;
        }
        return Storage::disk('content')->get($file);
    }

    public static function getArticle($year, $slug)
    {
        $filePath = "articles/$year/$slug.md";
        return self::getFile($filePath);
    }

    public static function getPage($slug)
    {
        $filePath = "pages/$slug.md";
        return self::getFile($filePath);
    }
}
