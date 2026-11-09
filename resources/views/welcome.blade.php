<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>RoomDekho | Find Your Perfect Room</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=outfit:400,500,600,700" rel="stylesheet" />
        <link rel="shortcut icon" href="assets/app_icon.png" type="image/x-icon">
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        <style>
            body { font-family: 'Outfit', sans-serif; }
            [x-cloak] { display: none !important; }
            .bg-glass { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(12px); }
        </style>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            primary: '#A78BFA',
                            secondary: '#F9A8D4',
                            soft: '#F9F7FF',
                            textPrimary: '#1F2937',
                            textSecondary: '#6B7280',
                        },
                        borderRadius: {
                            '3xl': '1.5rem',
                            '4xl': '2rem',
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="bg-soft text-textPrimary antialiased overflow-x-hidden">
        <!-- Floating Navbar -->
        <nav class="fixed top-6 left-1/2 -translate-x-1/2 w-[90%] max-w-6xl z-50">
            <div class="bg-glass border border-white/50 px-8 py-4 rounded-3xl shadow-xl shadow-primary/5 flex items-center justify-between">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-10 bg-primary rounded-xl flex items-center justify-center text-white font-bold text-xl">R</div>
                    <span class="text-xl font-bold tracking-tight">RoomDekho</span>
                </div>
                
                <div class="hidden md:flex items-center gap-8">
                    <a href="{{ route('rooms.search') }}" class="text-sm font-bold text-textSecondary hover:text-primary transition-colors">Find Rooms</a>
                    <a href="{{ route('register') }}" class="text-sm font-bold text-textSecondary hover:text-primary transition-colors">List Your Room</a>
                    <a href="{{ route('documentation') }}" class="text-sm font-bold text-textSecondary hover:text-primary transition-colors">How it Works</a>
                </div>

                <div class="flex items-center gap-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="bg-primary text-white px-6 py-2.5 rounded-2xl text-sm font-bold shadow-lg shadow-primary/20 hover:scale-105 active:scale-95 transition-all">Go to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-bold text-textSecondary hover:text-primary transition-all">Log In</a>
                        <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-2.5 rounded-2xl text-sm font-bold shadow-lg shadow-primary/20 hover:scale-105 active:scale-95 transition-all">Join RoomDekho</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <header class="relative pt-44 pb-32 px-6 overflow-hidden">
            <div class="absolute -top-24 -right-24 w-96 h-96 bg-primary/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute top-1/2 -left-24 w-72 h-72 bg-secondary/10 rounded-full blur-3xl"></div>

            <div class="max-w-4xl mx-auto text-center relative">
                <h1 class="text-5xl md:text-7xl font-bold leading-tight mb-8">
                    Find your <span class="text-primary">next home</span><br>just around the corner.
                </h1>
                <p class="text-lg text-textSecondary mb-12 max-w-2xl mx-auto">
                    Simple, verified, and premium room finding experience in your city. Browse real rooms with real data.
                </p>

                <!-- Premium Search Box -->
                <form method="GET" action="{{ route('rooms.search') }}" class="bg-white p-3 rounded-4xl shadow-2xl shadow-primary/10 border border-gray-100 flex flex-col md:flex-row items-center gap-2 max-w-3xl mx-auto">
                    <div class="flex-1 px-4 flex items-center gap-3 w-full">
                        <svg class="w-6 h-6 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-width="2"></path></svg>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Where are you looking for room?" class="w-full py-4 text-sm font-medium outline-none placeholder:text-textSecondary/50 bg-transparent">
                    </div>
                    <button type="submit" class="bg-primary text-white px-10 py-4 rounded-3xl font-bold shadow-lg shadow-primary/30 hover:bg-primary/90 transition-all w-full md:w-auto">Search Now</button>
                </form>
            </div>
        </header>

        <!-- Stats Section -->
        <section class="max-w-6xl mx-auto px-6 mb-32">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 rounded-4xl border border-gray-50 text-center hover:shadow-xl transition-all group">
                    <div class="w-16 h-16 bg-primary/10 rounded-3xl flex items-center justify-center text-primary mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m4 0h4" stroke-width="2"></path></svg>
                    </div>
                    <h3 class="text-3xl font-bold mb-2">{{ number_format($stats['total_rooms']) }}+</h3>
                    <p class="text-textSecondary font-medium">Verified Rooms Available</p>
                </div>
                <div class="bg-white p-8 rounded-4xl border border-gray-50 text-center hover:shadow-xl transition-all group">
                    <div class="w-16 h-16 bg-secondary/10 rounded-3xl flex items-center justify-center text-secondary mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2"></path></svg>
                    </div>
                    <h3 class="text-3xl font-bold mb-2">{{ number_format($stats['active_bookings']) }}+</h3>
                    <p class="text-textSecondary font-medium">Active Safe Bookings</p>
                </div>
                <div class="bg-white p-8 rounded-4xl border border-gray-50 text-center hover:shadow-xl transition-all group">
                    <div class="w-16 h-16 bg-green-50 rounded-3xl flex items-center justify-center text-green-500 mx-auto mb-6 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" stroke-width="2"></path></svg>
                    </div>
                    <h3 class="text-3xl font-bold mb-2">{{ number_format($stats['satisfied_tenants']) }}+</h3>
                    <p class="text-textSecondary font-medium">Satisfied Tenants Joined</p>
                </div>
            </div>
        </section>

        <!-- Featured Rooms -->
        <section id="featured" class="max-w-6xl mx-auto px-6 mb-32">
            <div class="flex items-end justify-between mb-12">
                <div>
                    <h2 class="text-4xl font-bold mb-3">Featured Rooms</h2>
                    <p class="text-textSecondary">Handpicked verified listings for you.</p>
                </div>
                <a href="{{ route('rooms.search') }}" class="text-primary font-bold hover:underline mb-2">View All Rooms</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @forelse($featuredRooms as $room)
                    <div class="bg-white rounded-4xl border border-gray-50 overflow-hidden group hover:shadow-2xl hover:-translate-y-2 transition-all duration-500">
                        <div class="h-64 bg-gray-200 relative overflow-hidden">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                            <span class="absolute top-4 left-4 bg-white/90 backdrop-blur px-4 py-1.5 rounded-full text-xs font-bold text-primary shadow-sm capitalize">{{ $room->room_type }}</span>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-xl font-bold text-textPrimary">{{ $room->property->title }}</h3>
                                    <p class="text-sm text-textSecondary">{{ $room->property->city }}, {{ $room->property->area }}</p>
                                </div>
                                <span class="text-2xl font-bold text-primary">₹{{ number_format($room->rent) }}<span class="text-xs text-textSecondary font-normal">/mo</span></span>
                            </div>
                            <div class="flex items-center gap-4 py-4 border-t border-gray-50 mt-4">
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20"><path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                                    <span class="text-xs font-bold text-textSecondary">{{ $room->electricity_type }}</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 2a1 1 0 011 1v1.323l.395.17c.76.325 1.314.97 1.492 1.742l.547 2.369.499-.5a1 1 0 111.414 1.414l-2.207 2.207a1 1 0 01-1.414 0L9.5 9.5a1 1 0 111.414-1.414l.499.5-.547-2.369a.602.602 0 00-.49-.742l-.395-.17V3a1 1 0 011-1zM4 11V9a1 1 0 012 0v2a1 1 0 01-2 0zm10 0V9a1 1 0 012 0v2a1 1 0 01-2 0zM8 11V9a1 1 0 012 0v2a1 1 0 01-2 0z" clip-rule="evenodd"></path></svg>
                                    <span class="text-xs font-bold text-textSecondary uppercase">{{ $room->water_source }} Source</span>
                                </div>
                            </div>
                            <a href="{{ route('rooms.show', $room) }}" class="block text-center w-full bg-soft text-primary py-3 rounded-2xl font-bold mt-2 hover:bg-primary hover:text-white transition-all">View Details</a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-3 text-center py-20 bg-white rounded-4xl border-2 border-dashed border-gray-100">
                        <p class="text-textSecondary italic">More premium listings coming soon.</p>
                    </div>
                @endforelse
            </div>
        </section>

        <!-- Call to Action -->
        <section class="max-w-6xl mx-auto px-6 mb-32">
            <div class="bg-gradient-to-r from-primary to-secondary p-12 md:p-20 rounded-4xl relative overflow-hidden text-center text-white">
                <div class="absolute -top-12 -left-12 w-48 h-48 bg-white/10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-12 -right-12 w-64 h-64 bg-white/10 rounded-full blur-2xl"></div>
                
                <h2 class="text-4xl md:text-5xl font-bold mb-6 relative">Ready to list your room?</h2>
                <p class="text-white/80 mb-10 text-lg relative max-w-xl mx-auto">Join thousands of property owners and start earning today. Professional management tools included.</p>
                <div class="flex flex-col md:flex-row items-center justify-center gap-4 relative">
                    <a href="{{ route('register') }}" class="bg-white text-primary px-12 py-4 rounded-3xl font-bold shadow-xl hover:scale-105 active:scale-95 transition-all w-full md:w-auto">Start as Owner</a>
                    <a href="{{ route('documentation') }}" class="border-2 border-white/30 text-white px-12 py-4 rounded-3xl font-bold hover:bg-white/10 transition-all w-full md:w-auto text-center">Learn More</a>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-white pt-20 pb-10 border-t border-gray-100">
            <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2 mb-6">
                        <div class="w-8 h-8 bg-primary rounded-lg flex items-center justify-center text-white font-bold text-lg">R</div>
                        <span class="text-xl font-bold tracking-tight">RoomDekho</span>
                    </div>
                    <p class="text-textSecondary leading-relaxed max-w-sm">Premium room management and discovery platform. Finding your next home should be as easy as a click.</p>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Explore</h4>
                    <ul class="space-y-4 text-sm text-textSecondary">
                        <li><a href="{{ route('rooms.search') }}" class="hover:text-primary transition-all">Browse Rooms</a></li>
                        <li><a href="{{ route('register') }}" class="hover:text-primary transition-all">List Property</a></li>
                        <li><a href="{{ route('documentation') }}" class="hover:text-primary transition-all">How RoomDekho Works</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-bold mb-6">Support</h4>
                    <ul class="space-y-4 text-sm text-textSecondary">
                        <li><a href="#" class="hover:text-primary transition-all">Help Center</a></li>
                        <li><a href="#" class="hover:text-primary transition-all">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-primary transition-all">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            <div class="max-w-6xl mx-auto px-6 border-t border-gray-50 pt-10 text-center text-sm text-textSecondary">
                &copy; {{ date('Y') }} RoomDekho. All rights reserved . Designed and Developed by ❤️.
                {{-- <a class="text-blue-600" href="https://github.com/tejaslandge">Tejas Landge</a> --}}
            </div>
        </footer>
    </body>
</html>
