@props(['categories' => [], 'selectedCategory' => null])

@if(count($categories) > 0)
    <div class="mb-8">
        <h2 class="font-serif text-xl text-black mb-4 dark:text-dark-text">{{ __('messages.categories.title') }}</h2>
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('posts.index') }}" 
               class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $selectedCategory === null ? 'bg-black text-white dark:bg-white dark:text-black' : 'bg-salmon-dark text-black hover:bg-border dark:bg-dark-surface dark:text-gray-200 dark:hover:bg-dark-border' }}">
                {{ __('messages.posts.all') }}
            </a>
            @foreach($categories as $category)
                <a href="{{ route('posts.category', $category->slug) }}" 
                   class="px-4 py-2 rounded-md text-sm font-medium transition-colors {{ $selectedCategory?->id === $category->id ? 'bg-black text-white dark:bg-white dark:text-black' : 'bg-salmon-dark text-black hover:bg-border dark:bg-dark-surface dark:text-gray-200 dark:hover:bg-dark-border' }}">
                    {{ $category->getTranslation('name', app()->getLocale()) }}
                </a>                
            @endforeach
        </div>
    </div>
@endif