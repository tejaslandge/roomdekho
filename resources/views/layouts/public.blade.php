@php
    $publicBrand = site_branding();
    $publicAppearance = site_settings()->appearance();
    $pageTitle = trim($__env->yieldContent('meta_title')) ?: trim($__env->yieldContent('title'));
    $pageDescription = trim($__env->yieldContent('meta_description'));
    $pageImage = trim($__env->yieldContent('meta_image'));
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('partials.seo-meta', [
        'pageTitle' => $pageTitle,
        'pageDescription' => $pageDescription,
        'pageImage' => $pageImage,
    ])
    @include('partials.pwa-head')
    @include('partials.theme-variables')

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-soft text-text-primary" data-rd-theme="{{ $publicAppearance['theme'] }}">
    <div class="min-h-screen">
        <header class="sticky top-0 z-40 border-b border-gray-100 bg-header-bg/90 backdrop-blur">
            <div class="mx-auto flex h-16 max-w-6xl items-center justify-between px-4 md:px-6">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <x-site-logo />
                </a>

                <nav class="hidden items-center gap-6 sm:flex">
                    <a href="{{ route('home') }}" class="text-sm font-bold text-text-secondary transition-colors hover:text-primary">Home</a>
                    <a href="{{ route('rooms.search') }}" class="text-sm font-bold text-text-secondary transition-colors hover:text-primary">Find Rooms</a>
                    <a href="{{ route('documentation') }}" class="text-sm font-bold text-primary transition-colors">How it Works</a>
                </nav>

                <div class="flex items-center gap-2 sm:gap-3">
                    <x-pwa-install-button variant="ghost" label="Install" compact />
                    @auth
                        <a href="{{ url('/dashboard') }}" class="rd-button rounded-2xl bg-primary px-5 py-2.5 text-sm font-bold text-white shadow-lg shadow-primary/20 transition-all hover:bg-primary/90">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="hidden text-sm font-bold text-text-secondary transition-all hover:text-primary sm:inline">Log In</a>
                        <a href="{{ route('register') }}" class="rd-button rounded-2xl bg-primary px-4 py-2.5 text-sm font-bold text-white shadow-lg shadow-primary/20 transition-all hover:bg-primary/90 sm:px-5">Join</a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-6xl px-4 py-8 md:px-6">
            @if (session('success'))
                <div class="mb-6 rounded-2xl border border-green-100 bg-green-50 p-4 text-green-700">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-6 rounded-2xl border border-red-100 bg-red-50 p-4 text-red-700">{{ session('error') }}</div>
            @endif

            @yield('content')
        </main>

        <footer class="mt-10 border-t border-gray-100 bg-footer-bg py-8">
            <div class="mx-auto flex max-w-6xl flex-col items-center justify-between gap-4 px-4 text-sm text-text-secondary md:flex-row md:px-6">
                <div class="flex flex-col items-center gap-2 md:items-start">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <x-site-logo variant="dark" image-class="h-7 w-auto" name-class="font-display text-lg font-bold text-primary" />
                    </a>
                    <p>{{ $publicBrand['copyright'] }}</p>
                </div>
                <div class="flex flex-wrap items-center justify-center gap-4">
                    <p>{{ $publicBrand['tagline'] }}</p>
                    <x-pwa-install-button variant="ghost" mode="help" label="Install App" />
                </div>
            </div>
        </footer>
    </div>

    @include('partials.pwa-ui')
</body>
</html>
