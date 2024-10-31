<?php

namespace App\Http\Controllers;

use App\Models\Article;

class RedirectController extends Controller
{
    public function yearMonthDay($year, $month, $day, $slug)
    {
        $article = Article::where('year', $year)
            ->where('slug', $slug)
            ->firstOrFail();

        return redirect($article->url);
    }
}
