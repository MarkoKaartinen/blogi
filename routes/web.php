<?php

use App\Livewire\ShowArticle;
use App\Livewire\Home;
use App\Livewire\ShowPage;
use App\Livewire\Search;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/haku', Search::class)->name('search');


Route::get('/{year}/{slug}', ShowArticle::class)->name('article');
Route::get('/{page}', ShowPage::class)->name('page');

Route::get('/kategoria', function () {
    return view('category');
});

Route::get('/tagi', function () {
    return view('tag');
});
Route::get('/testi', function(){
    $files = \Illuminate\Support\Facades\Storage::disk('content')->allFiles('articles');
    foreach ($files as $file){
        $file = \Illuminate\Support\Facades\Storage::disk('content')->get($file);
        $content = \Spatie\YamlFrontMatter\YamlFrontMatter::parse($file);
        dump($content);
    }
    dd($files);
});
