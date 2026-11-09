@php($guestBrand = site_branding())
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="robots" content="noindex,nofollow">

        <title>@yield('title', 'Account') | {{ $guestBrand['site_name'] }}</title>

        @include('partials.pwa-head')
        @include('partials.theme-variables')

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased h-full">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-purple-100 via-white to-pink-100">
            <div class="mb-6 transform hover:scale-110 transition-transform duration-300">
                <a href="{{ route('home') }}" aria-label="{{ $guestBrand['site_name'] }}">
                    <x-application-logo class="w-20 h-20 fill-current text-purple-600" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-10 bg-white/70 backdrop-blur-lg border border-white/20 shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden sm:rounded-2xl transition-all duration-300 hover:shadow-[0_20px_50px_rgba(157,113,190,0.1)]">
                {{ $slot }}
            </div>

            <p class="mt-6 text-xs text-gray-500">{{ $guestBrand['copyright'] }}</p>
        </div>

        @include('partials.pwa-ui')
    </body>
</html>
