@extends('layouts.dashboard')

@section('title', 'Search Rooms')

@section('content')
<div class="space-y-6">
    <!-- Search Bar -->
    <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
        <form action="{{ route('tenant.rooms.search') }}" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1 relative">
                <input type="text" name="q" value="{{ request('q') }}" placeholder="Search by city, area, or room type..." class="w-full pl-12 pr-4 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20">
                <svg class="w-6 h-6 text-gray-400 absolute left-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <button type="submit" class="bg-primary text-white px-8 py-4 rounded-2xl font-bold hover:shadow-lg hover:shadow-primary/20 transition-all">
                Search Now
            </button>
        </form>
    </div>

    <!-- Filters & Results -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Filters Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <div class="bg-white p-6 rounded-3xl border border-gray-100 shadow-sm">
                <h3 class="font-bold text-lg text-text-primary mb-4">Filters</h3>
                <div class="space-y-4">
                    <div class="space-y-2">
                        <label class="text-xs font-bold text-text-secondary uppercase">Rent Range</label>
                        <input type="range" class="w-full accent-primary">
                    </div>
                </div>
            </div>
        </div>

        <!-- Results Grid -->
        <div class="lg:col-span-3">
            <div class="flex items-center justify-between mb-6">
                <p class="text-text-secondary">Showing <span class="font-bold text-text-primary">{{ $rooms->total() }}</span> rooms found</p>
                <select class="bg-transparent border-none text-sm font-bold text-text-primary focus:ring-0">
                    <option>Latest First</option>
                    <option>Price: Low to High</option>
                    <option>Price: High to Low</option>
                </select>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @forelse($rooms as $room)
                    <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden group hover:shadow-xl hover:shadow-primary/5 transition-all duration-300">
                        <div class="h-48 bg-gray-200 relative overflow-hidden">
                            @if($room->images->count() > 0)
                                <img src="{{ asset('storage/' . $room->images->first()->image_path) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @else
                                <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=800" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                            @endif
                            <div class="absolute top-4 right-4">
                                <form action="{{ route('tenant.favourites.toggle', $room) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="h-8 w-8 bg-white/90 backdrop-blur rounded-full flex items-center justify-center {{ auth()->user()->favourites()->where('room_id', $room->id)->exists() ? 'text-red-500' : 'text-gray-400 hover:text-red-500' }} shadow-sm border border-white/20 transition-colors">
                                        <svg class="w-5 h-5" fill="{{ auth()->user()->favourites()->where('room_id', $room->id)->exists() ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                                    </button>
                                </form>
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
                                <a href="{{ route('tenant.rooms.show', $room) }}" class="text-sm font-black text-text-primary hover:text-primary transition-colors underline uppercase tracking-tighter">View Details</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-24 text-center">
                        <p class="text-text-secondary">No rooms match your search criteria.</p>
                    </div>
                @endforelse
            </div>
            
            <div class="mt-8">
                {{ $rooms->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
