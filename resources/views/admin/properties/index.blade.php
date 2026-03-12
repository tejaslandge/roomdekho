@extends('layouts.dashboard')

@section('title', 'Properties Management')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-text-primary">All Properties</h1>
        <div class="flex gap-2">
            <button class="px-4 py-2 bg-white border border-gray-100 text-text-secondary text-sm font-bold rounded-xl hover:bg-gray-50 transition-colors">Export</button>
            <button class="px-4 py-2 bg-primary text-white text-sm font-bold rounded-xl shadow-sm shadow-primary/20 hover:shadow-lg transition-all">Add Property</button>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Property</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Owner</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Location</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Rooms</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-text-secondary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($properties as $property)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-primary/10 flex items-center justify-center text-primary">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                                    </div>
                                    <p class="text-sm font-bold text-text-primary">{{ $property->title }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-text-secondary">{{ $property->owner->name }}</td>
                            <td class="px-6 py-4 text-sm text-text-secondary">{{ $property->city }}, {{ $property->area }}</td>
                            <td class="px-6 py-4 text-sm text-text-secondary font-bold">{{ $property->rooms_count }}</td>
                            <td class="px-6 py-4"><x-status-badge :status="$property->status" /></td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.properties.edit', $property) }}" class="text-primary font-bold text-xs hover:underline text-right">Edit</a>
                                <form action="{{ route('admin.properties.destroy', $property) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 font-bold text-xs hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-text-secondary text-sm italic">No properties found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($properties->hasPages())
        <div class="px-6 py-4 border-t border-gray-50 text-right">
            {{ $properties->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
