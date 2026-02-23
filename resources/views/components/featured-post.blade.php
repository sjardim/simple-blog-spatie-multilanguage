@props(['post'])

<article class="mb-12">
    <a href="{{ route('posts.show', $post) }}" class="group block">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 article-card p-4 -m-4 rounded-lg">
            <!-- Featured Image -->
            <x-post-image :post="$post" size="large" />
            
            <div class="flex flex-col justify-center">
                <x-category-badge :category="$post->category" class="mb-3" />
                
                <!-- Tags -->
                <x-post-tags :tags="$post->tags" class="mb-3" />
                
                <h2 class="font-serif text-3xl md:text-4xl text-black mb-4 group-hover:text-pink transition-colors dark:text-dark-text dark:group-hover:text-dark-pink">
                    {{ $post->title }}
                </h2>
                <p class="text-gray text-base leading-relaxed mb-4 line-clamp-3 dark:text-dark-text-muted">                    
                    {{ Str::of(strip_tags($post->content))->limit(200, preserveWords: true) }}
                </p>
                <span class="text-link text-sm font-medium dark:text-dark-link">
                    {{ __('messages.read_more') }} →
                </span>
            </div>
        </div>
    </a>
</article>