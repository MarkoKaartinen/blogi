<?php

use App\Livewire\ShowArticle;
use App\Livewire\Home;
use App\Livewire\ShowCategory;
use App\Livewire\ShowPage;
use App\Livewire\Search;
use App\Livewire\ShowSeries;
use App\Livewire\ShowTag;
use Illuminate\Support\Facades\Route;

Route::get('/', Home::class)->name('home');
Route::get('/haku', Search::class)->name('search');

Route::get('/kategoria/{slug}', ShowCategory::class)->name('category');
Route::get('/avainsana/{slug}', ShowTag::class)->name('tag');
Route::get('/sarja/{slug}', ShowSeries::class)->name('series');

Route::feeds();

Route::get('/{year}/{slug}', ShowArticle::class)->name('article');
Route::get('/{page}', ShowPage::class)->name('page');
