<?php

use App\Models\Category;
use App\Models\Post;
use Spatie\Tags\Tag;

test('can visit posts index page', function () {
    refreshApplicationWithLocale('en');

    $response = $this->get('/en/posts');

    $response->assertStatus(200);
    $response->assertSee('Posts');
});

test('can visit posts index page in Portuguese', function () {
    refreshApplicationWithLocale('pt');

    $response = $this->get('/pt/posts');

    $response->assertStatus(200);
});

test('posts index displays categories filter', function () {
    refreshApplicationWithLocale('en');

    // Create a category
    $category = Category::factory()->create([
        'name' => ['en' => 'Test Category', 'pt' => 'Categoria de Teste'],
        'slug' => ['en' => 'test-category', 'pt' => 'categoria-teste'],
    ]);

    $response = $this->get('/en/posts');

    $response->assertStatus(200);
    $response->assertSee('Test Category');
    $response->assertSee('All');
});

test('posts index shows all posts when no category selected', function () {
    refreshApplicationWithLocale('en');

    $category = Category::factory()->create();
    $post1 = Post::factory()->create(['category_id' => $category->id]);
    $post2 = Post::factory()->create();

    $response = $this->get('/en/posts');

    $response->assertStatus(200);
    $response->assertSee($post1->title);
    $response->assertSee($post2->title);
});

test('can filter posts by category', function () {
    refreshApplicationWithLocale('en');

    $category = Category::factory()->create([
        'name' => ['en' => 'Tech', 'pt' => 'Tecnologia'],
        'slug' => ['en' => 'tech', 'pt' => 'tecnologia'],
    ]);
    
    $otherCategory = Category::factory()->create([
        'name' => ['en' => 'Other', 'pt' => 'Outro'],
        'slug' => ['en' => 'other', 'pt' => 'outro'],
    ]);

    $postInCategory = Post::factory()->create(['category_id' => $category->id]);
    $postInOtherCategory = Post::factory()->create(['category_id' => $otherCategory->id]);

    $response = $this->get('/en/news/category/tech');

    $response->assertStatus(200);
    $response->assertSee($postInCategory->title);
    $response->assertDontSee($postInOtherCategory->title);
});

test('category filter shows selected state', function () {
    refreshApplicationWithLocale('en');

    $category = Category::factory()->create([
        'name' => ['en' => 'Tech', 'pt' => 'Tecnologia'],
        'slug' => ['en' => 'tech', 'pt' => 'tecnologia'],
    ]);

    $response = $this->get('/en/news/category/tech');

    $response->assertStatus(200);
    // The selected category should have a highlighted style
    $response->assertSee('Tech');
});

test('posts index displays tags', function () {
    refreshApplicationWithLocale('en');

    $post = Post::factory()->create();
    $tag = Tag::findOrCreate('Test Tag', 'en');
    $post->tags()->attach($tag);

    $response = $this->get('/en/posts');

    $response->assertStatus(200);
    $response->assertSee('Test Tag');
});

test('post show page displays tags', function () {
    refreshApplicationWithLocale('en');

    $post = Post::factory()->create();
    $tag = Tag::findOrCreate('Test Tag', 'en');
    $post->tags()->attach($tag);

    $response = $this->get('/en/posts/' . $post->slug);

    $response->assertStatus(200);
    $response->assertSee('Test Tag');
});

test('post show page category links to category filter', function () {
    refreshApplicationWithLocale('en');

    $category = Category::factory()->create([
        'name' => ['en' => 'Tech', 'pt' => 'Tecnologia'],
        'slug' => ['en' => 'tech', 'pt' => 'tecnologia'],
    ]);
    
    $post = Post::factory()->create(['category_id' => $category->id]);

    $response = $this->get('/en/posts/' . $post->slug);

    $response->assertStatus(200);
    $response->assertSee('news/category/tech');
});

test('empty posts shows empty state message', function () {
    refreshApplicationWithLocale('en');

    // Delete all posts
    Post::query()->delete();

    $response = $this->get('/en/posts');

    $response->assertStatus(200);
    $response->assertSee('No posts available yet');
});

test('posts can have multiple tags', function () {
    refreshApplicationWithLocale('en');

    $post = Post::factory()->create();
    $tag1 = Tag::findOrCreate('Tag One', 'en');
    $tag2 = Tag::findOrCreate('Tag Two', 'en');
    $post->tags()->attach([$tag1->id, $tag2->id]);

    $response = $this->get('/en/posts');

    $response->assertStatus(200);
    $response->assertSee('Tag One');
    $response->assertSee('Tag Two');
});

test('category in Portuguese shows Portuguese name', function () {
    refreshApplicationWithLocale('pt');

    $category = Category::factory()->create([
        'name' => ['en' => 'Tech', 'pt' => 'Tecnologia'],
        'slug' => ['en' => 'tech', 'pt' => 'tecnologia'],
    ]);

    $response = $this->get('/pt/posts');

    $response->assertStatus(200);
    $response->assertSee('Tecnologia');
});

test('category filtering works in Portuguese', function () {
    refreshApplicationWithLocale('pt');

    $category = Category::factory()->create([
        'name' => ['en' => 'Tech', 'pt' => 'Tecnologia'],
        'slug' => ['en' => 'tech', 'pt' => 'tecnologia'],
    ]);

    $post = Post::factory()->create(['category_id' => $category->id]);

    $response = $this->get('/pt/news/category/tecnologia');

    $response->assertStatus(200);
    $response->assertSee($post->title);
});