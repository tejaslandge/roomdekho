@extends('layouts.dashboard')

@section('title', 'Edit Room')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-text-primary">Edit Room</h1>
            <x-status-badge :status="$room->available ? 'active' : 'inactive'" />
        </div>
        
        <form action="{{ route('owner.rooms.update', $room) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- existing fields ... -->
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Room Photos (Add More)</label>
                    <input type="file" name="images[]" multiple class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20">
                    
                    @if($room->images->count() > 0)
                        <div class="mt-4 flex gap-2 flex-wrap">
                            @foreach($room->images as $image)
                                <div class="relative w-20 h-20">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" class="w-20 h-20 object-cover rounded-lg border border-gray-100">
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Property</label>
                    <select name="property_id" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20 @error('property_id') ring-2 ring-red-500 @enderror">
                        @foreach($properties as $property)
                            <option value="{{ $property->id }}" {{ (old('property_id', $room->property_id) == $property->id) ? 'selected' : '' }}>{{ $property->title }}</option>
                        @endforeach
                    </select>
                    @error('property_id') <p class="text-red-500 text-xs font-bold">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Room Type</label>
                    <input type="text" name="room_type" value="{{ old('room_type', $room->room_type) }}" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20 @error('room_type') ring-2 ring-red-500 @enderror" placeholder="e.g. 1BHK, Single Room">
                    @error('room_type') <p class="text-red-500 text-xs font-bold">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Monthly Rent (₹)</label>
                    <input type="number" name="rent" value="{{ old('rent', $room->rent) }}" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20 @error('rent') ring-2 ring-red-500 @enderror" placeholder="e.g. 5000">
                    @error('rent') <p class="text-red-500 text-xs font-bold">{{ $message }}</p> @enderror
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Electricity Type</label>
                    <input type="text" name="electricity_type" value="{{ $room->electricity_type }}" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="e.g. Sub-meter, Included">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Water Source</label>
                    <input type="text" name="water_source" value="{{ $room->water_source }}" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="e.g. Municipal, Boring">
                </div>
                <div class="flex items-center space-x-3 pt-8">
                    <input type="checkbox" name="available" id="available" {{ $room->available ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary/20">
                    <label for="available" class="text-sm font-bold text-text-secondary cursor-pointer">Available for Booking</label>
                </div>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-bold text-text-secondary">Description</label>
                <textarea name="description" required rows="4" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20 @error('description') ring-2 ring-red-500 @enderror" placeholder="Describe the room features...">{{ old('description', $room->description) }}</textarea>
                @error('description') <p class="text-red-500 text-xs font-bold">{{ $message }}</p> @enderror
            </div>
            
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('owner.rooms.index') }}" class="text-text-secondary font-bold hover:text-text-primary transition-colors">Cancel</a>
                <button type="submit" class="bg-primary text-white px-8 py-3 rounded-2xl font-bold hover:shadow-lg hover:shadow-primary/20 transition-all">
                    Update Room
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
