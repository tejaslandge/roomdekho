@extends('layouts.dashboard')

@section('title', 'Add New Room')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
        <h1 class="text-2xl font-bold text-text-primary mb-6">Room Details</h1>
        
        <form action="{{ route('owner.rooms.store') }}" method="POST" class="space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Select Property</label>
                    <select name="property_id" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20">
                        <option value="" disabled selected>Choose a property</option>
                        @foreach($properties as $property)
                            <option value="{{ $property->id }}">{{ $property->title }}</p>
                        @endforeach
                    </select>
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Room Type</label>
                    <input type="text" name="room_type" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="e.g. 1BHK, Single Room">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Monthly Rent (₹)</label>
                    <input type="number" name="rent" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="e.g. 5000">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Electricity Type</label>
                    <input type="text" name="electricity_type" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="e.g. Sub-meter, Included">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Water Source</label>
                    <input type="text" name="water_source" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="e.g. Municipal, Boring">
                </div>
                <div class="flex items-center space-x-3 pt-8">
                    <input type="checkbox" name="available" id="available" checked class="w-5 h-5 rounded border-gray-300 text-primary focus:ring-primary/20">
                    <label for="available" class="text-sm font-bold text-text-secondary cursor-pointer">Available for Booking</label>
                </div>
            </div>
            
            <div class="space-y-2">
                <label class="text-sm font-bold text-text-secondary">Description</label>
                <textarea name="description" required rows="4" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="Describe the room features..."></textarea>
            </div>
            
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('owner.rooms.index') }}" class="text-text-secondary font-bold hover:text-text-primary transition-colors">Cancel</a>
                <button type="submit" class="bg-primary text-white px-8 py-3 rounded-2xl font-bold hover:shadow-lg hover:shadow-primary/20 transition-all">
                    Add Room
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
