<?php

use App\Http\Controllers\HumanJsonController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ShowFeedController;
use App\Http\Controllers\ShowOgImageController;
use App\Livewire\AI;
use App\Livewire\Blog;
use App\Livewire\CoffeeCalc;
use App\Livewire\Guestbook;
use App\Livewire\Home;
use App\Livewire\Links;
use App\Livewire\Recipes;
use App\Livewire\Search;
use App\Livewire\ShowAllCategories;
use App\Livewire\ShowAllSeries;
use App\Livewire\ShowAllTags;
use App\Livewire\ShowArticle;
use App\Livewire\ShowCategory;
use App\Livewire\ShowDraft;
use App\Livewire\ShowPage;
use App\Livewire\ShowRecipe;
use App\Livewire\ShowRecipeCategory;
use App\Livewire\ShowRecipeDraft;
use App\Livewire\ShowRecipeTag;
use App\Livewire\ShowSeries;
use App\Livewire\ShowTag;
use Illuminate\Support\Facades\Route;

Route::livewire('/', Home::class)->name('home');
Route::livewire('/haku', Search::class)->name('search');
Route::livewire('/blogi', Blog::class)->name('blog');
Route::livewire('/vieraskirja', Guestbook::class)->name('guestbook');
Route::livewire('/kahvilaskuri', CoffeeCalc::class)->name('coffee-calc');
Route::livewire('/linkit', Links::class)->name('links');
Route::livewire('/ai', AI::class)->name('ai');

Route::livewire('/kategoria/{slug}', ShowCategory::class)->name('category');
Route::livewire('/avainsana/{slug}', ShowTag::class)->name('tag');
Route::livewire('/sarja/{slug}', ShowSeries::class)->name('series');

Route::livewire('/avainsanat', ShowAllTags::class)->name('tags.all');
Route::livewire('/sarjat', ShowAllSeries::class)->name('series.all');
Route::livewire('/kategoriat', ShowAllCategories::class)->name('categories.all');

Route::livewire('/reseptit', Recipes::class)->name('recipes');
Route::livewire('/reseptit/kategoria/{slug}', ShowRecipeCategory::class)->name('recipe.category');
Route::livewire('/reseptit/avainsana/{slug}', ShowRecipeTag::class)->name('recipe.tag');
Route::livewire('/resepti/{slug}', ShowRecipe::class)->name('recipe');

Route::get('/media/{year}/{file}', ImageController::class)->name('media');

Route::get('/feed', ShowFeedController::class)->name('feed');

Route::get('/og/artikkeli/{slug}.png', [ShowOgImageController::class, 'article'])->name('article.og');
Route::get('/og/resepti/{slug}.png', [ShowOgImageController::class, 'recipe'])->name('recipe.og');
Route::get('/og/sivu/{slug}.png', [ShowOgImageController::class, 'page'])->name('page.og');

Route::get('/human.json', HumanJsonController::class)->name('human.json');

if (! app()->isProduction()) {
    Route::livewire('/luonnos/{year}/{slug}', ShowDraft::class)->name('draft');
    Route::livewire('/reseptiluonnos/{year}/{slug}', ShowRecipeDraft::class)->name('recipe.draft');
}

Route::livewire('/{year}/{slug}', ShowArticle::class)->name('article');
Route::livewire('/{page}', ShowPage::class)->name('page');

Route::get('/{year}/{month}/{day}/{slug}', [RedirectController::class, 'yearMonthDay']);
