@php
    $dashboardBrand = site_branding();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex,nofollow">

    <title>{{ $dashboardBrand['site_name'] }} - @yield('title', 'Dashboard')</title>

    @include('partials.pwa-head')
    @include('partials.theme-variables')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-soft text-text-primary" x-data="{ showLogoutModal: false, sidebarOpen: false }">
    <div class="min-h-screen flex overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-100 flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <x-site-logo image-class="h-8 w-auto" name-class="font-display text-xl font-bold text-primary" />
                </a>
            </div>

            <nav class="flex-1 px-4 py-4 space-y-1 overflow-y-auto">
                @include('layouts.partials.sidebar-' . auth()->user()->role)
            </nav>

            <div class="p-4 border-t border-gray-50">
                <button @click="showLogoutModal = true" class="flex items-center gap-3 w-full px-4 py-2 text-sm font-medium text-red-500 hover:bg-red-50 rounded-xl transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                    Logout
                </button>
            </div>
        </aside>

        <!-- Mobile navigation drawer -->
        <div x-show="sidebarOpen" x-cloak class="fixed inset-0 z-[90] md:hidden" style="display: none;">
            <div class="absolute inset-0 bg-gray-900/50 backdrop-blur-sm" @click="sidebarOpen = false"></div>
            <aside class="relative flex h-full w-72 max-w-[85%] flex-col bg-white shadow-2xl"
                   x-transition:enter="transition ease-out duration-200"
                   x-transition:enter-start="-translate-x-full"
                   x-transition:enter-end="translate-x-0"
                   x-transition:leave="transition ease-in duration-150"
                   x-transition:leave-start="translate-x-0"
                   x-transition:leave-end="-translate-x-full">
                <div class="flex items-center justify-between p-6">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        <x-site-logo variant="mobile" image-class="h-8 w-auto" name-class="font-display text-xl font-bold text-primary" />
                    </a>
                    <button @click="sidebarOpen = false" class="rounded-xl p-2 text-gray-400 hover:bg-gray-50" aria-label="Close menu">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <nav class="flex-1 space-y-1 overflow-y-auto px-4 py-2">
                    @include('layouts.partials.sidebar-' . auth()->user()->role)
                </nav>
                <div class="space-y-2 border-t border-gray-50 p-4">
                    <x-pwa-install-button variant="menu" mode="help" label="Install RoomDekho App" />
                    <button @click="showLogoutModal = true" class="flex w-full items-center gap-3 rounded-xl px-4 py-2 text-sm font-medium text-red-500 transition-colors hover:bg-red-50">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Logout
                    </button>
                </div>
            </aside>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <header class="h-16 bg-white border-b border-gray-100 flex items-center justify-between px-4 md:px-8 flex-shrink-0">
                <div class="flex items-center gap-4">
                    <button @click="sidebarOpen = true" class="md:hidden p-2 text-gray-400 hover:bg-gray-50 rounded-lg" aria-label="Open menu">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="font-display font-semibold text-lg">@yield('title', 'Dashboard')</h2>
                </div>

                <div class="flex items-center gap-3 md:gap-4">
                    <div class="hidden sm:block">
                        <x-pwa-install-button variant="ghost" label="Install" compact />
                    </div>
                    <!-- Notifications -->
                    <button class="p-2 text-gray-400 hover:bg-gray-50 rounded-full relative">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                        <span class="absolute top-2 right-2 w-2 h-2 bg-secondary rounded-full border border-white"></span>
                    </button>

                    <!-- Profile Dropdown -->
                    <a href="{{ route(auth()->user()->role . '.profile') }}" class="flex items-center gap-3 pl-4 border-l border-gray-100 group transition-all">
                        <div class="text-right hidden sm:block">
                            <p class="text-sm font-semibold text-text-primary leading-none group-hover:text-primary">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-text-secondary mt-1 capitalize">{{ auth()->user()->role }}</p>
                        </div>
                        <img class="w-10 h-10 rounded-full object-cover border-2 border-primary/20 group-hover:border-primary transition-all" 
                             src="{{ auth()->user()->profile_photo_url }}" 
                             alt="{{ auth()->user()->name }}">
                    </a>
                </div>
            </header>

            <!-- Page Body -->
            <main class="flex-1 overflow-y-auto p-4 md:p-8">
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-2xl border border-green-100 flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-6 p-4 bg-red-50 text-red-700 rounded-2xl border border-red-100 flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        {{ session('error') }}
                    </div>
                @endif
                
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Logout Confirmation Modal -->
    <div x-show="showLogoutModal" 
         class="fixed inset-0 z-[100] overflow-y-auto" 
         style="display: none;"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity bg-gray-900/50 backdrop-blur-sm" @click="showLogoutModal = false"></div>

            <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>

            <div class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white shadow-2xl rounded-3xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                
                <div class="bg-white p-8">
                    <div class="sm:flex sm:items-start">
                        <div class="flex items-center justify-center flex-shrink-0 w-12 h-12 mx-auto bg-red-50 rounded-2xl sm:mx-0 sm:h-12 sm:w-12">
                            <svg class="w-6 h-6 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        </div>
                        <div class="mt-4 text-center sm:mt-0 sm:ml-6 sm:text-left">
                            <h3 class="text-xl font-bold leading-6 text-text-primary font-display" id="modal-title">
                                Confirm Logout
                            </h3>
                            <div class="mt-3">
                                <p class="text-sm text-text-secondary">
                                    Are you sure you want to logout? You will need to login again to access your dashboard.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-8 py-6 bg-gray-50/50 flex flex-col sm:flex-row-reverse gap-3 rounded-b-3xl">
                    <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit" class="w-full bg-red-500 text-white px-6 py-3 rounded-2xl font-bold text-sm hover:bg-red-600 transition-all shadow-lg shadow-red-500/20 active:scale-95">
                            Yes, Logout
                        </button>
                    </form>
                    <button @click="showLogoutModal = false" class="w-full sm:w-auto bg-white text-text-primary border border-gray-200 px-6 py-3 rounded-2xl font-bold text-sm hover:bg-gray-50 transition-all active:scale-95">
                        No, Stay Logged In
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('partials.pwa-ui')
</body>
</html>
