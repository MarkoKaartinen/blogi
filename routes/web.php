<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/artikkeli', function () {
    return view('article');
});

Route::get('/kategoria', function () {
    return view('category');
});

Route::get('/tagi', function () {
    return view('tag');
});

Route::get('/sivu', function () {
    return view('page');
});

Route::get('/haku', function () {
    return view('search');
});
