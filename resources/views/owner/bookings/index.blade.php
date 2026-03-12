@extends('layouts.dashboard')

@section('title', 'Manage Bookings')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-text-primary">Booking Requests</h1>
        <div class="flex gap-3">
            <button class="bg-white border border-gray-100 px-4 py-2 rounded-xl text-sm font-bold text-text-secondary hover:bg-gray-50 transition-colors">Filters</button>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-text-secondary text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">Tenant</th>
                        <th class="px-6 py-4">Room</th>
                        <th class="px-6 py-4">Check-in</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-secondary/10 flex items-center justify-center text-secondary text-xs font-bold">{{ substr($booking->tenant->name, 0, 2) }}</div>
                                <div>
                                    <p class="text-sm font-bold text-text-primary">{{ $booking->tenant->name }}</p>
                                    <p class="text-xs text-text-secondary">{{ $booking->tenant->phone }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-text-primary">{{ $booking->room->property->title }}</p>
                            <p class="text-xs text-text-secondary capitalize">{{ $booking->room->room_type }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">
                            {{ $booking->start_date }}
                        </td>
                        <td class="px-6 py-4">
                            <x-status-badge :status="$booking->status" />
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                @if($booking->status === 'pending')
                                    <form action="{{ route('owner.bookings.update-status', [$booking, 'active']) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-green-500 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-green-600 transition-colors">Accept</button>
                                    </form>
                                    <form action="{{ route('owner.bookings.update-status', [$booking, 'cancelled']) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="bg-red-50 text-red-500 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-100 transition-colors">Reject</button>
                                    </form>
                                @else
                                    <span class="text-xs text-text-secondary">No actions available</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-text-secondary">No booking requests yet</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
