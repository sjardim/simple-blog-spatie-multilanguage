<ul>
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
        <li>
            <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                {{ $properties['native'] }}
            </a>
        </li>
    @endforeach
</ul>

<h1>{{ $post->title }}</h1>
<p>{{ $post->content }}</p>
{{-- If current locale is Portuguese, it returns `/pt/test` --}}
{{-- <a href="{{ LaravelLocalization::localizeUrl('/test') }}">@lang('Follow this link')</a> --}}
<p>
    {{-- Returns current url with English locale. --}}
    {{ LaravelLocalization::getLocalizedURL('en') }}
</p>
<p>
    {{-- Returns current url with Portuguese locale. --}}
    {{ LaravelLocalization::getLocalizedURL('pt') }}
</p>
