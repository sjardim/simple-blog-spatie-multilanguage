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
    
     Route::get(LaravelLocalization::transRoute('routes.post'), [PostController::class, 'show'])
        ->name('posts.show');
        
});