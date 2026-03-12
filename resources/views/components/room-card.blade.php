@props(['room'])

<div class="bg-white rounded-2xl border border-gray-100 overflow-hidden shadow-sm hover:shadow-md transition-all duration-300">
    <div class="relative h-48">
        <img src="{{ $room->images->first()?->image_path ?? 'https://via.placeholder.com/400x300?text=Room+Image' }}" alt="{{ $room->room_type }}" class="w-full h-full object-cover">
        <div class="absolute top-4 right-4">
            <x-status-badge :status="$room->available ? 'active' : 'inactive'" />
        </div>
        <div class="absolute bottom-4 left-4">
            <span class="bg-white/90 backdrop-blur-sm px-3 py-1 rounded-lg text-sm font-bold text-primary shadow-sm">
                ₹{{ number_format($room->rent, 2) }}/mo
            </span>
        </div>
    </div>
    
    <div class="p-5">
        <div class="flex items-center justify-between mb-2">
            <h4 class="font-display font-bold text-lg text-text-primary capitalize">{{ $room->room_type }}</h4>
            <div class="flex items-center gap-1 text-yellow-400">
                <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/></svg>
                <span class="text-xs font-semibold text-text-secondary">4.8</span>
            </div>
        </div>
        
        <p class="text-sm text-text-secondary flex items-center gap-1 mb-4">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            {{ $room->property->city }}, {{ $room->property->area }}
        </p>

        <div class="flex items-center gap-4 mb-5">
            <div class="flex items-center gap-1 text-xs text-text-secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ $room->electricity_type }} Elect.
            </div>
            <div class="flex items-center gap-1 text-xs text-text-secondary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ $room->water_source }} Water
            </div>
        </div>

        <div class="flex gap-2">
            <a href="#" class="flex-1 bg-primary text-white text-center py-2 rounded-xl text-sm font-semibold hover:bg-primary/90 transition-colors">
                View Details
            </a>
            <button class="w-10 h-10 border border-gray-100 rounded-xl flex items-center justify-center text-gray-400 hover:text-red-500 hover:bg-red-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
            </button>
        </div>
    </div>
</div>
