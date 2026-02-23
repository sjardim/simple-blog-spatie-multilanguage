@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article class="max-w-7xl mx-auto px-4 py-8">
        <!-- Article Header -->
        <header class="max-w-3xl mx-auto mb-8">
            <x-category-badge :category="$post->category" :link="true" class="mb-4" />
            
            <!-- Tags -->
            <x-post-tags :tags="$post->tags" class="mb-4" size="large" />
            
            <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl text-black leading-tight mb-6 dark:text-dark-text">
                {{ $post->title }}
            </h1>
            <div class="flex items-center gap-4 text-gray text-sm pb-6 border-b border-border dark:text-dark-text-muted dark:border-dark-border">
                <span>{{ \Carbon\Carbon::parse($post->created_at)->translatedFormat('F j, Y') }}</span>
                <span class="text-border dark:text-dark-border">|</span>
                @php
                $readTime = Str::readTime($post->content)
                @endphp
                <span>{{ $readTime }} {{ trans_choice('messages.minutes', $readTime) }} {{ __('messages.read_time') }}</span>
                <span class="text-border dark:text-dark-border">|</span>
                <span>{{ Str::wordCount($post->content) }} {{ __('messages.words') }}</span>
            </div>
        </header>

        <!-- Featured Image -->
        <div class="max-w-4xl mx-auto mb-8">
            <x-post-image :post="$post" size="large" />
        </div>

        <!-- Article Content -->
        <div class="max-w-3xl mx-auto">
            <div class="prose prose-lg max-w-none">
                <div class="text-black text-lg leading-relaxed space-y-6 dark:text-dark-text">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            <!-- Article Footer -->
            <footer class="mt-12 pt-8 border-t border-border dark:border-dark-border">
                <!-- Language Switcher -->
                <div class="bg-salmon-dark rounded-lg p-6 mb-8 dark:bg-dark-surface">
                    <h3 class="font-serif text-lg text-black mb-4 dark:text-dark-text">{{ __('messages.read_another_language') }}</h3>
                    <x-language-switcher />
                </div>

                <!-- Share -->
                <x-share-buttons :title="$post->title" />
            </footer>
        </div>

        <!-- Back to Posts -->
        <div class="max-w-3xl mx-auto mt-8">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 text-link hover:text-link-hover font-medium dark:text-dark-link dark:hover:text-dark-link-hover">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                {{ __('messages.posts.back_to_all') }}
            </a>
        </div>
    </article>
@endsection