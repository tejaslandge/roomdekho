@extends('layouts.dashboard')

@section('title', 'Tenant Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Welcome Section -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-text-primary">Find your perfect home, {{ explode(' ', auth()->user()->name)[0] }}!</h1>
            <p class="text-text-secondary">Discover the best rooms and apartments in your city.</p>
        </div>
        <a href="{{ route('rooms.search') }}" class="bg-primary text-white px-6 py-3 rounded-2xl font-bold hover:shadow-lg hover:shadow-primary/20 transition-all flex items-center gap-2 text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            Explore Rooms
        </a>
    </div>

    <!-- Widgets Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <x-stat-card label="Current Booking" value="{{ $stats['current_booking'] }}" icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>' />
        <x-stat-card label="Pending Requests" value="{{ $stats['pending_requests'] }}" icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>' />
        <x-stat-card label="Favourite Rooms" value="{{ $stats['favourite_rooms'] }}" icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>' />
        <x-stat-card label="Rent Paid" value="{{ $stats['payment_history'] }}" icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' />
    </div>

    <!-- Recommendations / Favourites -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content (Recommendations) -->
        <div class="lg:col-span-2 space-y-6">
            <div class="flex items-center justify-between">
                <h3 class="font-display font-bold text-xl text-text-primary">Recommended for You</h3>
                <a href="{{ route('rooms.search') }}" class="text-primary text-sm font-bold hover:underline">View All</a>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($recommended_rooms as $room)
                    <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden group hover:shadow-xl hover:shadow-primary/5 transition-all duration-300">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            <div class="absolute top-4 right-4 h-8 w-8 bg-white/90 backdrop-blur rounded-full flex items-center justify-center text-red-500 cursor-pointer shadow-sm">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            </div>
                        </div>
                        <div class="p-5">
                            <div class="flex items-center justify-between">
                                <span class="text-[10px] font-black uppercase tracking-wider text-primary bg-primary/5 px-2 py-1 rounded-lg">{{ $room->room_type }}</span>
                                <span class="text-xs font-bold text-text-secondary">{{ $room->property->city }}</span>
                            </div>
                            <h4 class="font-bold text-lg mt-2 text-text-primary truncate">{{ $room->property->title }}</h4>
                            <p class="text-sm text-text-secondary truncate mt-1">{{ $room->property->area }}</p>
                            <div class="mt-4 flex items-center justify-between">
                                <span class="font-bold text-primary text-lg">₹{{ number_format($room->rent) }}<span class="text-text-secondary text-xs">/mo</span></span>
                                <a href="{{ route('rooms.show', $room) }}" class="text-sm font-black text-text-primary hover:text-primary transition-colors underline uppercase tracking-tighter">View Details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 bg-white rounded-3xl border border-dashed border-gray-200 flex flex-col items-center justify-center text-center">
                        <p class="text-text-secondary italic">No rooms recommended currently.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Sidebar (Activity/History) -->
        <div class="space-y-6">
            <h3 class="font-display font-bold text-xl text-text-primary">Recent Messages</h3>
            <div class="bg-white rounded-3xl border border-gray-100 p-6 space-y-4">
                @forelse($recent_messages as $msg)
                    <div class="flex items-center gap-4 group cursor-pointer p-2 rounded-xl hover:bg-gray-50 transition-all">
                        <div class="h-10 w-10 bg-primary/10 rounded-full flex items-center justify-center text-primary font-bold">
                            {{ substr($msg->owner->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-bold text-text-primary truncate">{{ $msg->owner->name }}</p>
                            <p class="text-[10px] text-text-secondary truncate">Regarding: {{ $msg->room->room_type }}</p>
                        </div>
                        <div class="text-[10px] text-text-secondary">
                            {{ $msg->created_at->diffForHumans(null, true) }}
                        </div>
                    </div>
                @empty
                    <div class="text-center py-6">
                        <p class="text-sm text-text-secondary">No recent messages.</p>
                        <a href="{{ route('tenant.messages.index') }}" class="text-xs font-bold text-primary mt-2 block">Go to Chat</a>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
