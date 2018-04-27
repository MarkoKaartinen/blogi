<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//admin routes
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/', 'AdminController@index')->name('index');
    Route::get('artikkelit/lisaa', 'PostsController@create')->name('posts.create');
    Route::post('artikkelit/lisaa', 'PostsController@store')->name('posts.store');
    Route::post('artikkelit/julkaise', 'PostsController@publish')->name('posts.publish');
    Route::get('artikkelit/{post}', 'PostsController@edit')->name('posts.edit');
    Route::post('artikkelit/{post}', 'PostsController@update')->name('posts.update');
    Route::get('artikkelit/', 'PostsController@index')->name('posts.index');
});

Route::get('/', 'HomeController@index')->name('front.home');

// login routes
Route::get('kirjaudu', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('kirjaudu', 'Auth\LoginController@login');
Route::post('ulos', 'Auth\LoginController@logout')->name('logout');

// password reset routes
Route::post('salasana/sahkoposti', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('salasana/nollaa', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('salasana/nollaa', 'Auth\ResetPasswordController@reset');
Route::get('salasana/nollaa/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

// register routes
//Route::get('rekisteroidy', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('rekisteroidy', 'Auth\RegisterController@register');

Route::get('/{slug}', 'PostsController@show')->name('front.posts.show');