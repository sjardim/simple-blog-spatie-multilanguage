@props(['category' => null, 'link' => false])

@if($category)
    @if($link)
        <a href="{{ route('posts.category', $category->slug) }}" 
           class="inline-block text-pink text-xs font-semibold uppercase tracking-wider hover:underline dark:text-dark-pink{{ $attributes->has('class') ? ' ' . $attributes->get('class') : '' }}">
            {{ $category->getTranslation('name', app()->getLocale()) }}
        </a>
    @else
        <span class="inline-block text-pink text-xs font-semibold uppercase tracking-wider dark:text-dark-pink{{ $attributes->has('class') ? ' ' . $attributes->get('class') : '' }}">
            {{ $category->getTranslation('name', app()->getLocale()) }}
        </span>
    @endif
@endif