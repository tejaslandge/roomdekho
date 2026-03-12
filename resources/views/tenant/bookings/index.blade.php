@extends('layouts.dashboard')

@section('title', 'My Booking Requests')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-black text-text-primary uppercase tracking-tighter">My Requests</h1>
        <p class="text-text-secondary text-sm font-bold">{{ $bookings->count() }} bookings</p>
    </div>

    <div class="bg-white rounded-[2rem] border border-gray-100 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest">Property / Room</th>
                        <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest">Move-in</th>
                        <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest">Status</th>
                        <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($bookings as $booking)
                        <tr class="group hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-gray-100 overflow-hidden shrink-0">
                                        @if($booking->room->images->count() > 0)
                                            <img src="{{ asset('storage/' . $booking->room->images->first()->image_path) }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=200" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-black text-text-primary truncate max-w-[200px]">{{ $booking->room->property->title }}</p>
                                        <p class="text-[10px] text-text-secondary font-bold uppercase">{{ $booking->room->room_type }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm font-black text-text-secondary">{{ \Carbon\Carbon::parse($booking->start_date)->format('d M, Y') }}</span>
                            </td>
                            <td class="px-8 py-6">
                                @php
                                    $statusClasses = [
                                        'pending' => 'bg-orange-50 text-orange-600 border-orange-100',
                                        'active' => 'bg-green-50 text-green-600 border-green-100',
                                        'cancelled' => 'bg-red-50 text-red-600 border-red-100',
                                    ];
                                @endphp
                                <span class="px-3 py-1.5 rounded-xl border {{ $statusClasses[$booking->status] ?? 'bg-gray-50 text-gray-500 border-gray-100' }} text-[10px] font-black uppercase tracking-widest">
                                    {{ $booking->status }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('tenant.messages.index') }}" class="p-2.5 bg-white border border-gray-100 rounded-xl text-primary hover:bg-primary/5 hover:border-primary/20 transition-all shadow-sm" title="Chat with Owner">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                    </a>
                                    @if($booking->agreement)
                                        <a href="{{ route('tenant.agreements.show', $booking->agreement) }}" class="p-2.5 bg-white border border-gray-100 rounded-xl text-primary hover:bg-primary/5 hover:border-primary/20 transition-all shadow-sm" title="View Agreement">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        </a>
                                    @endif
                                    <a href="{{ route('tenant.rooms.show', $booking->room_id) }}" class="p-2.5 bg-white border border-gray-100 rounded-xl text-text-secondary hover:text-primary transition-all shadow-sm" title="Room Details">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-16 text-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <p class="text-text-secondary font-bold">You haven't requested any rooms yet.</p>
                                <a href="{{ route('tenant.rooms.search') }}" class="text-primary font-black uppercase text-xs mt-2 block hover:underline tracking-widest">Start Searching</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
