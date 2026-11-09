<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'RoomDekho') }} - @yield('title', 'Find your next home')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-soft text-text-primary">
    <div class="min-h-screen">
        <header class="sticky top-0 z-40 bg-white/90 backdrop-blur border-b border-gray-100">
            <div class="max-w-6xl mx-auto px-4 md:px-6 h-16 flex items-center justify-between">
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white font-bold text-xl">R</div>
                    <span class="font-display font-bold text-xl text-primary">RoomDekho</span>
                </a>

                <nav class="hidden sm:flex items-center gap-6">
                    <a href="{{ route('home') }}" class="text-sm font-bold text-text-secondary hover:text-primary transition-colors">Home</a>
                    <a href="{{ route('rooms.search') }}" class="text-sm font-bold text-text-secondary hover:text-primary transition-colors">Find Rooms</a>
                    <a href="{{ route('documentation') }}" class="text-sm font-bold text-primary transition-colors">How it Works</a>
                </nav>

                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-primary text-white px-5 py-2.5 rounded-2xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-text-secondary hover:text-primary transition-all">Log In</a>
                        <a href="{{ route('register') }}" class="bg-primary text-white px-5 py-2.5 rounded-2xl text-sm font-bold shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all">Join</a>
                    @endauth
                </div>
            </div>
        </header>

        <main class="max-w-6xl mx-auto px-4 md:px-6 py-8">
            @if (session('success'))
                <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-2xl border border-green-100">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-2xl border border-red-100">{{ session('error') }}</div>
            @endif

            @yield('content')
        </main>

        <footer class="border-t border-gray-100 bg-white py-8 mt-10">
            <div class="max-w-6xl mx-auto px-4 md:px-6 flex flex-col sm:flex-row items-center justify-between gap-3 text-sm text-text-secondary">
                <p>© {{ date('Y') }} RoomDekho. All rights reserved.</p>
                <p>Verified rooms. Transparent pricing. Zero surprises.</p>
            </div>
        </footer>
    </div>
</body>
</html>
