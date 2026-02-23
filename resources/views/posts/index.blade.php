@extends('layouts.app')

@section('title', __('Posts'))

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="border-b border-border pb-6 mb-8 dark:border-dark-border">
            <h1 class="font-serif text-4xl md:text-5xl text-black mb-2 dark:text-dark-text">{{ __('messages.posts.title') }}</h1>
            <p class="text-gray text-lg dark:text-dark-text-muted">{{ __('messages.posts.subtitle') }}</p>
        </div>

        <!-- Categories Filter -->
        <x-category-filter :categories="$categories" :selectedCategory="$selectedCategory" />

        <!-- Featured Post (First Post) -->
        @if($posts->count() > 0)
            @php $featuredPost = $posts->first(); @endphp
            <x-featured-post :post="$featuredPost" />
        @endif

        <!-- Posts Grid -->
        @if($posts->count() > 1)
            <div class="border-t border-border pt-8 dark:border-dark-border">
                <h2 class="font-serif text-2xl text-black mb-6 dark:text-dark-text">{{ __('messages.posts.latest') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts->skip(1) as $post)
                        <x-post-card :post="$post" />
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Empty State -->
        @if($posts->count() === 0)
            <div class="text-center py-16">
                <svg class="w-16 h-16 text-border mx-auto mb-4 dark:text-dark-border" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <p class="text-gray text-lg dark:text-dark-text-muted">{{ __('messages.posts.no_posts') }}</p>
            </div>
        @endif
    </div>
@endsection