<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RoomDekho') }} - Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-soft text-text-primary" x-data="{ showLogoutModal: false }">
    <div class="min-h-screen flex overflow-hidden">
        <!-- Sidebar -->
        <aside class="w-64 bg-white border-r border-gray-100 flex-shrink-0 hidden md:flex flex-col">
            <div class="p-6">
                <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white font-bold text-xl">R</div>
                    <span class="font-display font-bold text-xl text-primary">RoomDekho</span>
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

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Navbar -->
            <header class="h-16 bg-white border-b border-gray-100 flex items-center justify-between px-4 md:px-8 flex-shrink-0">
                <div class="flex items-center gap-4">
                    <button class="md:hidden p-2 text-gray-400 hover:bg-gray-50 rounded-lg">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </button>
                    <h2 class="font-display font-semibold text-lg">@yield('title', 'Dashboard')</h2>
                </div>

                <div class="flex items-center gap-4">
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
                        <div class="w-10 h-10 rounded-full bg-primary/10 border-2 border-primary/20 flex items-center justify-center text-primary font-bold group-hover:bg-primary group-hover:text-white transition-all">
                            {{ substr(auth()->user()->name, 0, 1) }}
                        </div>
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
</body>
</html>
