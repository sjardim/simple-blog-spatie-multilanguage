@props(['categories' => [], 'selectedCategory' => null, 'categoryCounts' => []])

@if(count($categories) > 0)
    <div class="mb-8">
        <h2 class="font-serif text-xl text-black mb-4 dark:text-dark-text">{{ __('messages.categories.title') }}</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('posts.index') }}" 
               class="px-4 py-2 rounded-md text-sm font-medium border transition-colors {{ $selectedCategory === null ? 'bg-salmon border-salmon-dark text-white dark:bg-white dark:text-black' : 'border-salmon-dark bg-salmon-dark text-black hover:bg-border dark:text-gray-200 dark:hover:bg-salmon' }}">
                {{ __('messages.posts.all_categories') }}
            </a>
            @foreach($categories as $category)
                <a href="{{ route('posts.category', $category->slug) }}" 
                   class="px-4 py-2 rounded-md text-sm font-medium border transition-colors {{ $selectedCategory?->id === $category->id ? 'bg-salmon border-salmon-dark text-white dark:bg-white dark:text-black' : 'border-salmon-dark bg-salmon-dark text-black hover:bg-highlight  dark:text-gray-200 dark:hover:bg-salmon' }}">
                    {{ $category->getTranslation('name', app()->getLocale()) }} ({{ $categoryCounts[$category->id] }})
                </a>                
            @endforeach
        </div>
    </div>
@endif