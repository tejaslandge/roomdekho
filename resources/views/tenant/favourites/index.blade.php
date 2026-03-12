@extends('layouts.dashboard')

@section('title', 'My Favourites')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-black text-text-primary uppercase tracking-tighter">Liked Rooms</h1>
        <p class="text-text-secondary text-sm font-bold">{{ $favourites->total() }} rooms saved</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @if($favourites->count() > 0)
            @foreach ($favourites as $favourite)
                @php($room = $favourite->room)
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
                                <button type="submit" class="h-8 w-8 bg-white/90 backdrop-blur rounded-full flex items-center justify-center text-red-500 shadow-sm border border-white/20 hover:scale-110 transition-transform">
                                    <svg class="w-5 h-5" fill="currentColor" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
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
                            <span class="font-black text-primary text-lg">₹{{ number_format($room->rent) }}<span class="text-text-secondary text-xs">/mo</span></span>
                            <a href="{{ route('tenant.rooms.show', $room) }}" class="text-sm font-black text-text-primary hover:text-primary transition-colors underline uppercase tracking-tighter">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="col-span-full py-24 text-center space-y-4">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto">
                    <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                </div>
                <p class="text-text-secondary font-bold">You haven't liked any rooms yet.</p>
                <a href="{{ route('tenant.rooms.search') }}" class="inline-block bg-primary text-white px-8 py-3 rounded-2xl font-bold hover:shadow-lg transition-all">Find Rooms</a>
            </div>
        @endif
    </div>
    </div>
    
    <div class="mt-8">
        {{ $favourites->links() }}
    </div>
</div>
@endsection
