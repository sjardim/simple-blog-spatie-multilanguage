@props(['post' => null, 'imageUrl' => null, 'size' => 'default', 'showPlaceholder' => true])

@php
    $imageUrl = $imageUrl ?? ($post?->image_url ?? null);
    
    $sizeClasses = match($size) {
        'small' => 'aspect-video',
        'large' => 'aspect-video',
        default => 'aspect-video',
    };
    
    $iconSize = match($size) {
        'small' => 'w-12 h-12',
        'large' => 'w-24 h-24',
        default => 'w-16 h-16',
    };
@endphp

<div class="{{ $sizeClasses }} bg-salmon-dark rounded-lg overflow-hidden dark:bg-dark-surface">
    @if($imageUrl)
        <img src="{{ $imageUrl }}" alt="{{ $post?->title ?? '' }}" class="w-full h-full object-cover">
    @elseif($showPlaceholder)
        <div class="w-full h-full flex items-center justify-center bg-salmon dark:bg-dark-bg">
            <svg class="{{ $iconSize }} text-border dark:text-dark-border" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
        </div>
    @endif
</div>