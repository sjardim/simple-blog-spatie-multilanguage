@props(['tags' => [], 'size' => 'default'])

@if(count($tags) > 0)
    <div class="flex flex-wrap gap-2">
        @foreach($tags as $tag)
            <span class="inline-block px-2 py-1 text-xs rounded-md bg-border text-black dark:bg-dark-border dark:text-dark-text{{ $size === 'large' ? ' text-sm px-3 py-1.5' : '' }}">
                {{ $tag->name }}
            </span>
        @endforeach
    </div>
@endif