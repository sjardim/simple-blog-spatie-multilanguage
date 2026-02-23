@props(['post'])

<article class="article-card p-4 -m-4 rounded-lg">
    <a href="{{ route('posts.show', $post) }}" class="group block">
        <!-- Image -->
        <x-post-image :post="$post" size="small" />
        
        <x-category-badge :category="$post->category" class="mt-4" />
        
        <!-- Tags -->
        <x-post-tags :tags="$post->tags" class="mt-2" />
        
        <h3 class="font-serif text-xl text-black mt-2 mb-2 group-hover:text-pink transition-colors dark:text-dark-text dark:group-hover:text-dark-pink">
            {{ $post->title }}
        </h3>
        <p class="text-gray text-sm leading-relaxed line-clamp-2 dark:text-dark-text-muted">
            {{ Str::limit(strip_tags($post->content), 120) }}
        </p>
    </a>
</article>