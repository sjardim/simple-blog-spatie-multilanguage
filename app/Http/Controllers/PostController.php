<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request, ?string $slug = null)
    {
        // Query using JSON containment for translatable slug
        $category = $slug 
            ? Category::where('slug', 'like', '%"'.$slug.'"%')->first() 
            : null;
        
        $posts = $category 
            ? $category->posts()->get()
            : Post::all();
        
        $categories = Category::whereHas('posts')->get();

        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'selectedCategory' => $category,
        ]);
    }
    
    public function show(Post $post)
    {
       return view('posts.show', ['post' => $post]);
    }
}
