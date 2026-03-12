@extends('layouts.dashboard')

@section('title', 'Owner Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Header with Actions -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-text-primary">Welcome back, {{ explode(' ', auth()->user()->name)[0] }}!</h1>
            <p class="text-text-secondary">Here's what's happening with your properties today.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('owner.properties.create') }}" class="bg-primary text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-primary/90 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Add Property
            </a>
            <a href="{{ route('owner.rooms.create') }}" class="bg-secondary text-white px-5 py-2.5 rounded-xl text-sm font-bold hover:bg-secondary/90 transition-all flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Add Room
            </a>
        </div>
    </div>

    <!-- Widgets Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <x-stat-card label="Total Properties" value="{{ $stats['total_properties'] }}" icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>' />
        <x-stat-card label="Total Rooms" value="{{ $stats['total_rooms'] }}" icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>' />
        <x-stat-card label="Active Bookings" value="{{ $stats['active_bookings'] }}" icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' />
        <x-stat-card label="Monthly Earnings" value="{{ $stats['monthly_earnings'] }}" trend="+0%" icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16V15"></path></svg>' />
    </div>

    <!-- Recent Property Listings -->
    <div>
        <div class="flex items-center justify-between mb-6">
            <h3 class="font-display font-bold text-xl text-text-primary">Your Properties</h3>
            <a href="{{ route('owner.properties.index') }}" class="text-primary text-sm font-bold hover:underline">View All</a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($properties as $property)
                <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden group hover:shadow-xl hover:shadow-primary/5 transition-all duration-300">
                    <div class="h-48 bg-gray-100 relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        <div class="absolute top-4 right-4">
                            <x-status-badge :status="$property->status" />
                        </div>
                    </div>
                    <div class="p-6">
                        <h4 class="font-bold text-lg text-text-primary truncate">{{ $property->title }}</h4>
                        <p class="text-sm text-text-secondary flex items-center gap-1 mt-1">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            {{ $property->city }}, {{ $property->area }}
                        </p>
                        <div class="mt-6 pt-6 border-t border-gray-50 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="w-8 h-8 rounded-lg bg-soft flex items-center justify-center text-primary font-bold text-xs">{{ $property->rooms_count }}</span>
                                <span class="text-xs font-bold text-text-secondary uppercase">Rooms</span>
                            </div>
                            <a href="{{ route('owner.properties.edit', $property) }}" class="text-sm font-bold text-primary hover:underline">Manage →</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 bg-white rounded-3xl border border-dashed border-gray-200 flex flex-col items-center justify-center text-center">
                    <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center text-gray-300 mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </div>
                    <h4 class="font-display font-bold text-lg text-text-primary">No Properties Listed Yet</h4>
                    <p class="text-text-secondary text-sm max-w-xs mt-1">Start by adding your first property to start earning.</p>
                    <a href="{{ route('owner.properties.create') }}" class="mt-6 text-primary font-bold text-sm hover:underline">Add Property Now →</a>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
