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
            ? $category->posts()->with('tags')->get()
            : Post::with('tags')->get();
        
        // Get unique categories from loaded posts (no extra query needed)
        $categories = $posts->pluck('category')->filter()->unique('id')->values();
        
        // Calculate post counts per category
        $categoryCounts = $posts->groupBy('category_id')->map(fn($group) => $group->count());

        return view('posts.index', [
            'posts' => $posts,
            'categories' => $categories,
            'categoryCounts' => $categoryCounts,
            'selectedCategory' => $category,
        ]);
    }
    
    public function show(Post $post)
    {
       return view('posts.show', ['post' => $post]);
    }
}
