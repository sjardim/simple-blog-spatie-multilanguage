@props(['size' => 'default'])

@php
    $buttonClasses = match($size) {
        'small' => 'px-3 py-1.5 text-xs',
        'large' => 'px-4 py-2 text-sm',
        default => 'px-4 py-2 text-sm',
    };
    
    $containerClasses = match($size) {
        'small' => 'gap-2',
        'large' => 'gap-3',
        default => 'gap-3',
    };
@endphp

<div class="flex flex-wrap {{ $containerClasses }}">
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        @php
            $localizedUrl = LaravelLocalization::getLocalizedURL($localeCode);
        @endphp
        <a href="{{ $localizedUrl }}" 
           class="{{ $buttonClasses }} rounded-md text-sm font-medium transition-colors {{ app()->getLocale() === $localeCode ? 'bg-black text-white dark:bg-dark-text dark:text-dark-bg' : 'bg-white text-black hover:bg-border dark:bg-dark-surface-hover dark:text-dark-text dark:hover:bg-dark-border' }}">
            {{ $properties['native'] }}
        </a>
    @endforeach
</div>