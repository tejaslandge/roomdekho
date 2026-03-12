@extends('layouts.dashboard')

@section('title', 'Add New Property')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
        <h1 class="text-2xl font-bold text-text-primary mb-6">Property Details</h1>
        <form action="{{ route('owner.properties.store') }}" method="POST" class="space-y-6">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Property Title</label>
                    <input type="text" name="title" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="e.g. Modern Villa">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">City</label>
                    <input type="text" name="city" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="e.g. Bangalore">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Area</label>
                    <input type="text" name="area" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="e.g. Whitefield">
                </div>
                <div class="space-y-2">
                    <label class="text-sm font-bold text-text-secondary">Full Address</label>
                    <input type="text" name="address" required class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="e.g. 123 Main St, Whitefield">
                </div>
            </div>
            <div class="space-y-2">
                <label class="text-sm font-bold text-text-secondary">Description</label>
                <textarea name="description" required rows="4" class="w-full px-4 py-3 bg-gray-50 border-none rounded-xl focus:ring-2 focus:ring-primary/20" placeholder="Describe your property..."></textarea>
            </div>
            <div class="flex justify-end pt-4">
                <button type="submit" class="bg-primary text-white px-8 py-3 rounded-2xl font-bold hover:shadow-lg hover:shadow-primary/20 transition-all">
                    Create Property
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
