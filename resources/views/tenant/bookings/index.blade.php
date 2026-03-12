@extends('layouts.dashboard')

@section('title', 'My Bookings')

@section('content')
<div class="space-y-6">
    <h1 class="text-2xl font-bold text-text-primary">My Bookings</h1>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-text-secondary text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">Property</th>
                        <th class="px-6 py-4">Check-in</th>
                        <th class="px-6 py-4">Check-out</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-gray-100 overflow-hidden">
                                    <img src="https://via.placeholder.com/100" class="w-full h-full object-cover">
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-text-primary">{{ $booking->room->property->title }}</p>
                                    <p class="text-xs text-text-secondary capitalize">{{ $booking->room->room_type }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">
                            {{ $booking->start_date }}
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">
                            {{ $booking->end_date ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4">
                            <x-status-badge :status="$booking->status" />
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="#" class="text-primary font-bold text-sm hover:underline">View Agreement</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <p class="text-text-secondary">You haven't made any bookings yet.</p>
                            <a href="{{ route('tenant.rooms.search') }}" class="text-primary font-bold text-sm mt-2 block hover:underline">Find a room now</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
