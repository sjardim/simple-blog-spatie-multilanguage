<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
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
    <script>
        // Initialize dark mode based on system preference or localStorage
        (function() {
            const stored = localStorage.getItem('theme');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            if (stored === 'dark' || (!stored && prefersDark)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        })();
    </script>
</head>
<body class="bg-salmon min-h-screen flex flex-col dark:bg-dark-bg">
    <!-- Top Bar -->
    <div class="bg-black text-white py-1 px-4 dark:bg-black">
        <div class="max-w-7xl mx-auto flex justify-between items-center text-xs">
            <span>{{ \Carbon\Carbon::now()->translatedFormat('l, F j, Y') }}</span>
            <div class="flex items-center gap-4">
                <!-- Dark Mode Toggle -->
                <button id="theme-toggle" class="p-1 rounded hover:bg-gray-700 transition-colors" aria-label="Toggle dark mode">
                    <!-- Sun icon (shown in dark mode) -->
                    <svg id="theme-toggle-light" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path>
                    </svg>
                    <!-- Moon icon (shown in light mode) -->
                    <svg id="theme-toggle-dark" class="w-4 h-4 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path>
                    </svg>
                </button>
                @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                    <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" 
                       class="hover:text-salmon-dark dark:hover:text-gray-300 {{ app()->getLocale() === $localeCode ? 'text-salmon font-semibold' : 'text-white' }}">
                        {{ strtoupper($localeCode) }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Header -->
    <header class="bg-salmon border-b border-border dark:bg-dark-surface dark:border-dark-border">
        <div class="max-w-7xl mx-auto px-4">
            <!-- Main Navigation -->
            <nav class="flex items-center justify-between py-4">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <span class="font-serif text-3xl md:text-4xl text-black tracking-tight font-bold dark:text-dark-text">
                        {{ config('app.name') }}
                    </span>
                </a>

                <!-- Navigation Links -->
                <div class="hidden md:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-black hover:text-pink transition-colors dark:text-dark-text dark:hover:text-dark-pink">
                        {{ __('messages.nav.home') }}
                    </a>
                    <a href="{{ route('posts.index') }}" class="text-sm font-medium text-black hover:text-pink transition-colors dark:text-dark-text dark:hover:text-dark-pink">
                        {{ __('messages.nav.posts') }}
                    </a>
                </div>

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-btn" class="md:hidden p-2 text-black dark:text-dark-text">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </nav>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4">
                <div class="flex flex-col gap-3">
                    <a href="{{ route('home') }}" class="text-sm font-medium text-black hover:text-pink transition-colors py-2 border-b border-border dark:text-dark-text dark:hover:text-dark-pink dark:border-dark-border">
                        {{ __('messages.nav.home') }}
                    </a>
                    <a href="{{ route('posts.index') }}" class="text-sm font-medium text-black hover:text-pink transition-colors py-2 border-b border-border dark:text-dark-text dark:hover:text-dark-pink dark:border-dark-border">
                        {{ __('messages.nav.posts') }}
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
    <footer class="bg-black text-white mt-auto dark:bg-black">
        <div class="max-w-7xl mx-auto px-4 py-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- About -->
                <div class="col-span-1 md:col-span-2">
                    <h3 class="font-serif text-2xl mb-4 dark:text-dark-text">{{ config('app.name') }}</h3>
                    <p class="text-gray-400 text-sm leading-relaxed dark:text-dark-text-muted">
                        {{ __('messages.footer.about') }}
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 class="font-semibold text-sm uppercase tracking-wider mb-4 dark:text-dark-text">{{ __('messages.footer.quick_links') }}</h4>
                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('home') }}" class="text-gray-400 hover:text-salmon text-sm transition-colors dark:text-gray-300 dark:hover:text-white">
                                {{ __('messages.nav.home') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('posts.index') }}" class="text-gray-400 hover:text-salmon text-sm transition-colors dark:text-gray-300 dark:hover:text-white">
                                {{ __('messages.nav.all_posts') }}
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Languages -->
                <div>
                    <h4 class="font-semibold text-sm uppercase tracking-wider mb-4 dark:text-dark-text">{{ __('messages.footer.languages') }}</h4>
                    <ul class="space-y-2">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}" 
                                   class="text-gray-400 hover:text-salmon text-sm transition-colors dark:text-gray-300 dark:hover:text-white {{ app()->getLocale() === $localeCode ? 'text-salmon dark:text-white' : '' }}">
                                    {{ $properties['native'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Copyright -->
            <div class="border-t border-gray-700 mt-8 pt-6 text-center dark:border-dark-border">
                <p class="text-gray-500 text-sm dark:text-dark-text-muted">
                    &copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('messages.footer.copyright') }}
                </p>
            </div>
        </div>
    </footer>

    <!-- Mobile Menu and Dark Mode Toggle Script -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Dark mode toggle
        (function() {
            const toggleBtn = document.getElementById('theme-toggle');
            const lightIcon = document.getElementById('theme-toggle-light');
            const darkIcon = document.getElementById('theme-toggle-dark');
            const html = document.documentElement;

            function updateIcons() {
                if (html.classList.contains('dark')) {
                    lightIcon.classList.remove('hidden');
                    darkIcon.classList.add('hidden');
                } else {
                    lightIcon.classList.add('hidden');
                    darkIcon.classList.remove('hidden');
                }
            }

            // Initial icon state
            updateIcons();

            toggleBtn.addEventListener('click', function() {
                if (html.classList.contains('dark')) {
                    html.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                } else {
                    html.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                }
                updateIcons();
            });
        })();
    </script>
</body>
</html>
