@extends('layouts.app')

@section('title', __('Posts'))

@section('content')
    <div class="max-w-7xl mx-auto px-4 py-8">
        <!-- Page Header -->
        <div class="border-b border-ft-border pb-6 mb-8">
            <h1 class="font-serif text-4xl md:text-5xl text-ft-black mb-2">{{ __('Posts') }}</h1>
            <p class="text-ft-gray text-lg">{{ __('Explore our latest articles and insights.') }}</p>
        </div>

        <!-- Categories Filter -->
        @if($categories->count() > 0)
            <div class="mb-8">
                <h2 class="font-serif text-xl text-ft-black mb-4">{{ __('Categories') }}</h2>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('posts.index') }}" 
                       class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $selectedCategory === null ? 'bg-ft-black text-white' : 'bg-ft-salmon-dark text-ft-black hover:bg-ft-border' }}">
                        {{ __('All') }}
                    </a>
                    @foreach($categories as $category)
                        <a href="{{ route('posts.category', $category->slug) }}" 
                           class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $selectedCategory?->id === $category->id ? 'bg-ft-black text-white' : 'bg-ft-salmon-dark text-ft-black hover:bg-ft-border' }}">
                            {{ $category->getTranslation('name', app()->getLocale()) }}
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Featured Post (First Post) -->
        @if($posts->count() > 0)
            @php $featuredPost = $posts->first(); @endphp
            <article class="mb-12">
                <a href="{{ route('posts.show', $featuredPost) }}" class="group block">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 article-card p-4 -m-4 rounded-lg">
                        <!-- Featured Image Placeholder -->
                                <div class="aspect-video bg-ft-salmon-dark rounded-lg overflow-hidden">
                                    @if($featuredPost->image_url)
                                        <img src="{{ $featuredPost->image_url }}" alt="{{ $featuredPost->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-ft-salmon">
                                            <svg class="w-16 h-16 text-ft-border" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                        <div class="flex flex-col justify-center">
                            @if($featuredPost->category)
                                <span class="text-ft-pink text-xs font-semibold uppercase tracking-wider mb-3">
                                    {{ $featuredPost->category->getTranslation('name', app()->getLocale()) }}
                                </span>
                            @endif
                            <h2 class="font-serif text-3xl md:text-4xl text-ft-black mb-4 group-hover:text-ft-pink transition-colors">
                                {{ $featuredPost->title }}
                            </h2>
                            <p class="text-ft-gray text-base leading-relaxed mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($featuredPost->content), 200) }}
                            </p>
                            <span class="text-ft-link text-sm font-medium">
                                {{ __('Read more') }} →
                            </span>
                        </div>
                    </div>
                </a>
            </article>
        @endif

        <!-- Posts Grid -->
        @if($posts->count() > 1)
            <div class="border-t border-ft-border pt-8">
                <h2 class="font-serif text-2xl text-ft-black mb-6">{{ __('Latest Posts') }}</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($posts->skip(1) as $post)
                        <article class="article-card p-4 -m-4 rounded-lg">
                            <a href="{{ route('posts.show', $post) }}" class="group block">
                                <!-- Image -->
                                <div class="aspect-video bg-ft-salmon-dark rounded-lg mb-4 overflow-hidden">
                                    @if($post->image_url)
                                        <img src="{{ $post->image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-ft-salmon">
                                            <svg class="w-12 h-12 text-ft-border" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                @if($post->category)
                                    <span class="text-ft-pink text-xs font-semibold uppercase tracking-wider mb-2 block">
                                        {{ $post->category->getTranslation('name', app()->getLocale()) }}
                                    </span>
                                @endif
                                
                                <!-- Tags -->
                                @if($post->tags->count() > 0)
                                    <div class="flex flex-wrap gap-2 mb-2">
                                        @foreach($post->tags as $tag)
                                            <span class="inline-block px-2 py-1 text-xs rounded-md bg-ft-border text-ft-black">
                                                {{ $tag->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif
                                
                                <h3 class="font-serif text-xl text-ft-black mb-2 group-hover:text-ft-pink transition-colors">
                                    {{ $post->title }}
                                </h3>
                                <p class="text-ft-gray text-sm leading-relaxed line-clamp-2">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>
                            </a>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Empty State -->
        @if($posts->count() === 0)
            <div class="text-center py-16">
                <svg class="w-16 h-16 text-ft-border mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                </svg>
                <p class="text-ft-gray text-lg">{{ __('No posts available yet.') }}</p>
            </div>
        @endif
    </div>
@endsection