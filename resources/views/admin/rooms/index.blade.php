@extends('layouts.dashboard')

@section('title', 'Rooms Management')

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold text-text-primary">All Rooms</h1>
        <div class="flex gap-2">
            <button class="px-4 py-2 bg-white border border-gray-100 text-text-secondary text-sm font-bold rounded-xl hover:bg-gray-50 transition-colors">Export</button>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Room Details</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Property</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Rent</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Owner</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Availability</th>
                        <th class="px-6 py-4 text-right text-xs font-bold text-text-secondary uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($rooms as $room)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <p class="text-sm font-bold text-text-primary">{{ $room->room_type }}</p>
                                <p class="text-[10px] text-text-secondary uppercase font-bold tracking-tight">{{ $room->electricity_type }} / {{ $room->water_source }}</p>
                            </td>
                            <td class="px-6 py-4 text-sm text-text-secondary">{{ $room->property->title }}</td>
                            <td class="px-6 py-4 text-sm font-bold text-text-primary">₹{{ number_format($room->rent) }}</td>
                            <td class="px-6 py-4 text-sm text-text-secondary">{{ $room->property->owner->name }}</td>
                            <td class="px-6 py-4"><x-status-badge :status="$room->available ? 'active' : 'inactive'" /></td>
                            <td class="px-6 py-4 text-right space-x-2">
                                <a href="{{ route('admin.rooms.edit', $room) }}" class="text-primary font-bold text-xs hover:underline">Edit</a>
                                <form action="{{ route('admin.rooms.destroy', $room) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 font-bold text-xs hover:underline" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-text-secondary text-sm italic">No rooms found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($rooms->hasPages())
        <div class="px-6 py-4 border-t border-gray-50 text-right">
            {{ $rooms->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
