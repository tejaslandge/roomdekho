@extends('layouts.dashboard')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-8">
    <!-- Widgets Row -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-6">
        <x-stat-card 
            label="Total Users" 
            value="{{ number_format($stats['total_users']) }}" 
            trend="+0%" 
            icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>'
        />
        <x-stat-card 
            label="Total Properties" 
            value="{{ number_format($stats['total_properties']) }}" 
            trend="+0%" 
            icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2-2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>'
        />
        <x-stat-card 
            label="Active Rooms" 
            value="{{ number_format($stats['active_rooms']) }}" 
            trend="+0%" 
            icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>'
        />
        <x-stat-card 
            label="Pending Bookings" 
            value="{{ number_format($stats['pending_bookings']) }}" 
            trend="0" 
            icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>'
        />
        <x-stat-card 
            label="Total Revenue" 
            value="{{ $stats['total_revenue'] }}" 
            trend="+0%" 
            icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16V15"></path></svg>'
        />
    </div>

    <!-- Data Table Row -->
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
            <div>
                <h3 class="font-display font-bold text-xl text-text-primary">Recent Bookings</h3>
                <p class="text-sm text-text-secondary mt-1">Manage and track the latest room bookings</p>
            </div>
            <div class="flex items-center gap-3">
                <div class="relative">
                    <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 bg-gray-50 border-none rounded-xl text-sm focus:ring-2 focus:ring-primary/20 w-full sm:w-64">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <button class="bg-primary text-white px-4 py-2 rounded-xl text-sm font-semibold hover:bg-primary/90 transition-colors">
                    Export
                </button>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-text-secondary text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">Tenant</th>
                        <th class="px-6 py-4">Room Type</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($recent_bookings as $booking)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-secondary/10 flex items-center justify-center text-secondary text-xs font-bold">
                                    {{ strtoupper(substr($booking->tenant->name, 0, 2)) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-text-primary">{{ $booking->tenant->name }}</p>
                                    <p class="text-xs text-text-secondary">{{ $booking->tenant->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-medium text-text-primary">{{ $booking->room->room_type }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">
                            {{ $booking->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-sm font-bold text-text-primary">₹{{ number_format($booking->amount) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <x-status-badge :status="$booking->status" />
                        </td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('admin.bookings.index') }}" class="text-primary hover:text-primary/70 font-semibold text-sm">View</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-text-secondary italic">No recent bookings found</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="p-6 border-t border-gray-50 flex items-center justify-between">
            <p class="text-sm text-text-secondary truncate">Showing 1 to 5 of 43 entries</p>
            <div class="flex items-center gap-2">
                <button class="p-2 border border-gray-100 rounded-lg hover:bg-gray-50 disabled:opacity-50" disabled>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </button>
                <button class="px-3 py-1 bg-primary text-white rounded-lg text-sm font-bold">1</button>
                <button class="px-3 py-1 hover:bg-gray-50 rounded-lg text-sm font-bold">2</button>
                <button class="p-2 border border-gray-100 rounded-lg hover:bg-gray-50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
