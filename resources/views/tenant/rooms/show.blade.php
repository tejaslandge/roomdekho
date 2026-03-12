@extends('layouts.dashboard')

@section('title', $room->room_type . ' in ' . $room->property->title)

@section('content')
<div class="max-w-6xl mx-auto space-y-8">
    <!-- Header/Navigation -->
    <div class="flex items-center justify-between">
        <a href="{{ route('tenant.rooms.search') }}" class="flex items-center gap-2 text-text-secondary hover:text-primary transition-colors font-bold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
            Back to Search
        </a>
        <form action="{{ route('tenant.favourites.toggle', $room) }}" method="POST">
            @csrf
            <button type="submit" class="flex items-center gap-2 px-6 py-2.5 rounded-2xl border border-gray-100 font-bold transition-all {{ auth()->user()->favourites()->where('room_id', $room->id)->exists() ? 'bg-red-50 text-red-500 border-red-100' : 'bg-white text-text-secondary hover:bg-gray-50' }}">
                <svg class="w-5 h-5" fill="{{ auth()->user()->favourites()->where('room_id', $room->id)->exists() ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                {{ auth()->user()->favourites()->where('room_id', $room->id)->exists() ? 'Liked' : 'Like Room' }}
            </button>
        </form>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-8">
            <!-- Image Gallery -->
            <div class="bg-white rounded-[2rem] border border-gray-100 overflow-hidden shadow-sm">
                <div class="relative h-[400px]">
                    @if($room->images->count() > 0)
                        <img id="mainImage" src="{{ asset('storage/' . $room->images->first()->image_path) }}" class="w-full h-full object-cover transition-opacity duration-300">
                    @else
                        <img id="mainImage" src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1200" class="w-full h-full object-cover transition-opacity duration-300">
                    @endif
                    <div class="absolute bottom-6 right-6 flex gap-2">
                        <span class="bg-white/90 backdrop-blur px-4 py-2 rounded-xl text-xs font-black uppercase text-text-primary shadow-sm border border-white/20">
                            {{ $room->images->count() > 0 ? $room->images->count() : 1 }} Photos
                        </span>
                    </div>
                </div>
                @if($room->images->count() > 1)
                <div class="p-4 flex gap-4 overflow-x-auto border-t border-gray-50">
                    @foreach($room->images as $image)
                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                             onclick="changeMainImage(this.src)"
                             class="w-20 h-20 rounded-2xl object-cover border-2 border-transparent cursor-pointer hover:border-primary transition-all gallery-thumb">
                    @endforeach
                </div>
                @endif
            </div>

            <!-- Details Card -->
            <div class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-sm space-y-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-xs font-black uppercase tracking-widest text-primary bg-primary/5 px-3 py-1.5 rounded-xl border border-primary/10">
                            {{ $room->room_type }}
                        </span>
                        @if($room->available)
                            <span class="text-xs font-black uppercase tracking-widest text-green-600 bg-green-50 px-3 py-1.5 rounded-xl border border-green-100">
                                Available
                            </span>
                        @endif
                    </div>
                    <h1 class="text-3xl font-black text-text-primary leading-tight">{{ $room->property->title }}</h1>
                    <p class="text-text-secondary mt-2 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $room->property->address }}, {{ $room->property->area }}, {{ $room->property->city }}
                    </p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 gap-6 py-8 border-y border-gray-50">
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-text-secondary uppercase">Electricity</p>
                        <p class="font-black text-text-primary uppercase tracking-tighter">{{ $room->electricity_type }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-text-secondary uppercase">Water Source</p>
                        <p class="font-black text-text-primary uppercase tracking-tighter">{{ $room->water_source }}</p>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs font-bold text-text-secondary uppercase">Security Deposit</p>
                        <p class="font-black text-text-primary uppercase tracking-tighter">1 Month</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <h3 class="text-xl font-black text-text-primary">About this room</h3>
                    <p class="text-text-secondary leading-relaxed font-medium">
                        {{ $room->description }}
                    </p>
                </div>

                @if($room->amenities->count() > 0)
                <div class="space-y-4">
                    <h3 class="text-xl font-black text-text-primary">Amenities</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach($room->amenities as $amenity)
                            <span class="px-4 py-2 bg-gray-50 rounded-xl text-sm font-bold text-text-primary border border-gray-100 flex items-center gap-2">
                                <svg class="w-4 h-4 text-primary" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                {{ $amenity->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Property Owner Card -->
            <div class="bg-primary/5 rounded-[2rem] p-8 border border-primary/10 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <div class="w-16 h-16 rounded-3xl bg-primary flex items-center justify-center text-white text-2xl font-black shadow-lg shadow-primary/20">
                        {{ strtoupper(substr($room->property->owner->name, 0, 1)) }}
                    </div>
                    <div>
                        <p class="text-xs font-bold text-primary uppercase">Owner</p>
                        <h4 class="text-xl font-black text-text-primary">{{ $room->property->owner->name }}</h4>
                    </div>
                </div>
                <a href="{{ route('tenant.rooms.chat', $room) }}" class="bg-white text-primary px-6 py-3 rounded-2xl font-black text-sm hover:shadow-lg transition-all border border-primary/10">
                    Contact Owner
                </a>
            </div>
        </div>

        <!-- Sidebar / Booking -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-sm space-y-6 sticky top-8">
                <div class="pb-6 border-b border-gray-50 text-center">
                    <p class="text-sm font-bold text-text-secondary">Monthly Rent</p>
                    <p class="text-4xl font-black text-primary mt-1">₹{{ number_format($room->rent) }}</p>
                </div>

                @if($activeBooking)
                    <div class="space-y-4">
                        <div class="p-6 bg-green-50 rounded-[2rem] border border-green-100 flex items-center gap-4">
                            <div class="w-12 h-12 rounded-2xl bg-green-500 text-white flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-black text-green-700 uppercase text-xs tracking-widest">Booking Accepted!</h4>
                                <p class="text-[10px] text-green-600 font-bold uppercase">Complete payment to finalize</p>
                            </div>
                        </div>
                        <a href="{{ route('tenant.payments.pay', $activeBooking) }}" class="w-full bg-primary text-white py-5 rounded-2xl font-black uppercase tracking-wider hover:shadow-2xl hover:shadow-primary/30 transition-all block text-center">
                            Proceed to Pay
                        </a>
                    </div>
                @else
                    <form action="{{ route('tenant.bookings.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="room_id" value="{{ $room->id }}">
                        
                        <div class="space-y-2">
                            <label class="text-xs font-black uppercase text-text-secondary tracking-widest pl-1">Move-in Date</label>
                            <input type="date" name="start_date" required min="{{ date('Y-m-d') }}" class="w-full px-5 py-4 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-primary/20 font-bold text-text-primary">
                            @error('start_date') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                        </div>

                        <div class="p-6 bg-gray-50 rounded-2xl space-y-3">
                            <div class="flex justify-between text-sm font-bold">
                                <span class="text-text-secondary">Monthly Rent</span>
                                <span class="text-text-primary">₹{{ number_format($room->rent) }}</span>
                            </div>
                            <div class="flex justify-between text-sm font-bold">
                                <span class="text-text-secondary">Security Deposit</span>
                                <span class="text-text-primary">₹{{ number_format($room->rent) }}</span>
                            </div>
                            <div class="pt-3 border-t border-gray-200 flex justify-between font-black">
                                <span class="text-text-primary uppercase">Total Initial</span>
                                <span class="text-primary text-xl">₹{{ number_format($room->rent * 2) }}</span>
                            </div>
                        </div>

                        <button type="submit" class="w-full bg-primary text-white py-5 rounded-2xl font-black uppercase tracking-wider hover:shadow-2xl hover:shadow-primary/30 transition-all transform hover:-translate-y-1 active:scale-[0.98]" {{ !$room->available ? 'disabled' : '' }}>
                            {{ $room->available ? 'Book this Room' : 'Unavailable' }}
                        </button>
                        
                        <p class="text-[10px] text-center text-text-secondary font-bold uppercase tracking-widest">No charges until accepted</p>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
<script>
function changeMainImage(src) {
    const mainImg = document.getElementById('mainImage');
    mainImg.style.opacity = '0';
    setTimeout(() => {
        mainImg.src = src;
        mainImg.style.opacity = '1';
    }, 200);
}
</script>
@endsection
