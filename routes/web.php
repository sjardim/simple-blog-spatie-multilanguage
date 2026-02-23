<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
    'prefix' => LaravelLocalization::setLocale(),
	'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], 
    function()
{
    Route::get('/', function () {
        return view('welcome');
    })->name('home');

	// Route::get('/posts/{post}', [PostController::class, 'show'])
    //     ->name('posts.show');

    Route::get(LaravelLocalization::transRoute('routes.posts'), [PostController::class, 'index'])
        ->name('posts.index');

    Route::get(LaravelLocalization::transRoute('routes.post'), [PostController::class, 'show'])
        ->name('posts.show');

    // Category filtering route
    Route::get(LaravelLocalization::transRoute('routes.news.category'), [PostController::class, 'index'])
        ->name('posts.category');

    // Route::get(LaravelLocalization::transRoute('routes.news.index'), [PostController::class, 'show'])
    //     ->name('news.index');

        
});
