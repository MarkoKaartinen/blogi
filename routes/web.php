<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ShowFeedController;
use App\Http\Controllers\ShowOgImageController;
use App\Livewire\Blog;
use App\Livewire\CoffeeCalc;
use App\Livewire\Guestbook;
use App\Livewire\ShowAllCategories;
use App\Livewire\ShowAllSeries;
use App\Livewire\ShowAllTags;
use App\Livewire\ShowArticle;
use App\Livewire\Home;
use App\Livewire\ShowCategory;
use App\Livewire\ShowDraft;
use App\Livewire\ShowPage;
use App\Livewire\Search;
use App\Livewire\ShowSeries;
use App\Livewire\ShowTag;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/haku', Search::class)->name('search');
Route::get('/blogi', Blog::class)->name('blog');
Route::get('/vieraskirja', Guestbook::class)->name('guestbook');
Route::get('/kahvilaskuri', CoffeeCalc::class)->name('coffee-calc');

Route::get('/kategoria/{slug}', ShowCategory::class)->name('category');
Route::get('/avainsana/{slug}', ShowTag::class)->name('tag');
Route::get('/sarja/{slug}', ShowSeries::class)->name('series');

Route::get('/avainsanat', ShowAllTags::class)->name('tags.all');
Route::get('/sarjat', ShowAllSeries::class)->name('series.all');
Route::get('/kategoriat', ShowAllCategories::class)->name('categories.all');

Route::get('/media/{year}/{file}', ImageController::class)->name('media');

Route::get('/feed', ShowFeedController::class)->name('feed');

Route::get('/og/artikkeli/{slug}.png', [ShowOgImageController::class, 'article'])->name('article.og');
Route::get('/og/sivu/{slug}.png', [ShowOgImageController::class, 'page'])->name('page.og');

if(!app()->isProduction()){
    Route::get('/luonnos/{year}/{slug}', ShowDraft::class)->name('draft');
}

Route::get('/{year}/{slug}', ShowArticle::class)->name('article');
Route::get('/{page}', ShowPage::class)->name('page');

Route::get('/{year}/{month}/{day}/{slug}', [RedirectController::class, 'yearMonthDay']);
