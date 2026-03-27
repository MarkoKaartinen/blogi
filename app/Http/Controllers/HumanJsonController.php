<?php

namespace App\Http\Controllers;

class HumanJsonController extends Controller
{
    public function __invoke()
    {
        return response()->json([
            'version' => '0.1.1',
            'url' => 'https://markokaartinen.net',
            'vouches' => config('blog.human_json_blogs'),
        ]);
    }
}
