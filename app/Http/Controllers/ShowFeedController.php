<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Response;

class ShowFeedController extends Controller
{
    public function __invoke()
    {
        $articles = Article::published()->with('tags')->latest()->limit(20)->get();

        $feedUpdated = $articles->first()->created_at;
        if($articles->first()->updated_at){
            $feedUpdated = $articles->first()->updated_at;
        }

        $contents = view('atom', [
            'articles' => $articles,
            'feedUpdated' => $feedUpdated,
        ]);

        return new Response($contents, 200, [
            'Content-Type' => 'application/xml;charset=UTF-8',
        ]);
    }
}
