<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - {{ config('app.name') }}</title>
    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
    <link rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode) }}">
    @endforeach
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bona+Nova:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])
</head>
<body class="bg-ft-salmon min-h-screen flex flex-col">
    <!-- Top Bar -->
    <div class="bg-ft-black text-white py-1 px-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center text-xs">
            <span>{{ date('l, F j, Y') }}</span>
            <div class="flex items-center gap-4">
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" 
                       class="hover:text-ft-salmon-dark {{ app()->getLocale() === $localeCode ? 'text-ft-salmon font-semibold' : '' }}">
                        {{ strtoupper($localeCode) }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-ft-salmon border-b border-ft-border">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Main Navigation -->
            <nav class="flex items-center justify-between py-4">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="font-serif text-3xl md:text-4xl text-ft-black tracking-tight font-bold">
                        {{ config('app.name') }}
                    </span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-ft-black hover:text-ft-pink transition-colors">
                        {{ __('Home') }}
                    </a>
                    <a href="{{ route('posts.index') }}" class="text-sm font-medium text-ft-black hover:text-ft-pink transition-colors">
                        {{ __('Posts') }}
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 text-ft-black">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </nav>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col gap-3">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-ft-black hover:text-ft-pink transition-colors py-2 border-b border-ft-border">
                        {{ __('Home') }}
                    </a>
                    <a href="{{ route('posts.index') }}" class="text-sm font-medium text-ft-black hover:text-ft-pink transition-colors py-2 border-b border-ft-border">
                        {{ __('Posts') }}
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-ft-black text-white mt-auto">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="font-serif text-2xl mb-4">{{ config('app.name') }}</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        {{ __('A modern blog built with Laravel, featuring multilingual support and clean design inspired by the Financial Times.') }}
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold text-sm uppercase tracking-wider mb-4">{{ __('Quick Links') }}</h4>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('home') }}" class="text-gray-400 hover:text-ft-salmon text-sm transition-colors">
                                {{ __('Home') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('posts.index') }}" class="text-gray-400 hover:text-ft-salmon text-sm transition-colors">
                                {{ __('All Posts') }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Languages -->
                <div>
                    <h4 class="font-semibold text-sm uppercase tracking-wider mb-4">{{ __('Languages') }}</h4>
                    <ul class="space-y-2">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" 
                                   class="text-gray-400 hover:text-ft-salmon text-sm transition-colors {{ app()->getLocale() === $localeCode ? 'text-ft-salmon' : '' }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-700 mt-8 pt-6 text-center">
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('All rights reserved.') }}
                </p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu Script -->
    <script>
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>
</body>
</html>