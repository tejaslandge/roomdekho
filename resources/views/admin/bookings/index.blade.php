@extends('layouts.dashboard')

@section('title', 'All Bookings')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-text-primary">System Bookings</h1>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-text-secondary text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">Tenant</th>
                        <th class="px-6 py-4">Property</th>
                        <th class="px-6 py-4">Owner</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($bookings as $booking)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                             <p class="text-sm font-bold text-text-primary">{{ $booking->tenant->name }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">
                            {{ $booking->room->property->title }}
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">
                            {{ $booking->room->property->owner->name }}
                        </td>
                        <td class="px-6 py-4">
                            <x-status-badge :status="$booking->status" />
                        </td>
                        <td class="px-6 py-4 text-right">
                            <button class="text-primary hover:underline text-sm font-bold">Details</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-text-secondary">No bookings found in the system</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
