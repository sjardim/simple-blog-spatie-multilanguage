<?php

use App\Http\Controllers\PostController;
use App\Models\Post;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/posts/{post}', [PostController::class, 'show'])
->name('posts.show');

// Route::get('/posts/{post}', function (Post $post) {
//     dd($post);
// })->name('posts.show');
