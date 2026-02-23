@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <article class="max-w-7xl mx-auto px-4 py-8">
        <!-- Article Header -->
        <header class="max-w-3xl mx-auto mb-8">
            @if($post->category)
                <a href="{{ route('posts.index') }}" class="inline-block text-ft-pink text-xs font-semibold uppercase tracking-wider mb-4 hover:underline">
                    {{ $post->category->getTranslation('name', app()->getLocale()) }}
                </a>
            @endif
            <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl text-ft-black leading-tight mb-6">
                {{ $post->title }}
            </h1>
            <div class="flex items-center gap-4 text-ft-gray text-sm pb-6 border-b border-ft-border">
                <span>{{ date('F j, Y', strtotime($post->created_at)) }}</span>
                <span class="text-ft-border">|</span>
                <span>{{ Str::wordCount($post->content) }} {{ __('words') }}</span>
            </div>
        </header>

        <!-- Featured Image Placeholder -->
        <div class="aspect-video bg-ft-salmon-dark rounded-lg mb-8 max-w-4xl mx-auto flex items-center justify-center">
            <svg class="w-24 h-24 text-ft-border" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </div>

        <!-- Article Content -->
        <div class="max-w-3xl mx-auto">
            <div class="prose prose-lg max-w-none">
                <div class="text-ft-black text-lg leading-relaxed space-y-6">
                    {!! nl2br(e($post->content)) !!}
                </div>
            </div>

            <!-- Article Footer -->
            <footer class="mt-12 pt-8 border-t border-ft-border">
                <!-- Language Switcher -->
                <div class="bg-ft-salmon-dark rounded-lg p-6 mb-8">
                    <h3 class="font-serif text-lg text-ft-black mb-4">{{ __('Read in another language') }}</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            @php
                                $localizedUrl = LaravelLocalization::getLocalizedURL($localeCode);
                            @endphp
                            <a href="{{ $localizedUrl }}" 
                               class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ app()->getLocale() === $localeCode ? 'bg-ft-black text-white' : 'bg-white text-ft-black hover:bg-ft-border' }}">
                                {{ $properties['native'] }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <!-- Share -->
                <div class="flex items-center gap-4">
                    <span class="text-ft-gray text-sm">{{ __('Share this article') }}:</span>
                    <div class="flex gap-2">
                        <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(request()->url()) }}" 
                           target="_blank"
                           class="p-2 rounded-full bg-ft-salmon-dark hover:bg-ft-border transition-colors text-ft-black"
                           aria-label="Share on Twitter">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}" 
                           target="_blank"
                           class="p-2 rounded-full bg-ft-salmon-dark hover:bg-ft-border transition-colors text-ft-black"
                           aria-label="Share on LinkedIn">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                        <button onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied!')" 
                                class="p-2 rounded-full bg-ft-salmon-dark hover:bg-ft-border transition-colors text-ft-black"
                                aria-label="Copy link">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Back to Posts -->
        <div class="max-w-3xl mx-auto mt-8">
            <a href="{{ route('posts.index') }}" class="inline-flex items-center gap-2 text-ft-link hover:text-ft-link-hover font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                {{ __('Back to all posts') }}
            </a>
        </div>
    </article>
@endsection