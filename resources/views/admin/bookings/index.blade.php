@extends('layouts.dashboard')

@section('title', 'System Bookings')

@section('content')
<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-black text-text-primary uppercase tracking-tighter">Booking Oversight</h1>
        <p class="text-text-secondary text-sm font-bold">{{ $bookings->count() }} total records</p>
    </div>

    <div class="bg-white rounded-[2rem] border border-gray-100 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100">
                    <tr>
                        <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest">Room / Property</th>
                        <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest">Tenant</th>
                        <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest">Owner</th>
                        <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest">Status</th>
                        <th class="px-8 py-5 text-xs font-black text-text-secondary uppercase tracking-widest text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($bookings as $booking)
                        <tr class="group hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-primary/5 flex items-center justify-center text-primary font-black uppercase">
                                        {{ substr($booking->room->room_type, 0, 1) }}
                                    </div>
                                    <div>
                                        <p class="font-black text-text-primary truncate max-w-[200px]">{{ $booking->room->property->title }}</p>
                                        <p class="text-[10px] text-text-secondary font-bold uppercase">{{ $booking->room->room_type }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-black text-text-primary">{{ $booking->tenant->name }}</p>
                                <p class="text-[10px] text-text-secondary font-bold">{{ $booking->tenant->email }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <p class="text-sm font-black text-text-primary">{{ $booking->room->property->owner->name }}</p>
                                <p class="text-[10px] text-text-secondary font-bold uppercase">Lessor</p>
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
                                    <a href="{{ route('admin.rooms.show', $booking->room_id) }}" class="p-2.5 bg-white border border-gray-100 rounded-xl text-text-secondary hover:text-primary hover:border-primary/20 transition-all shadow-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    @if($booking->status === 'pending')
                                        <form action="{{ route('admin.bookings.update-status', [$booking, 'active']) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="p-2.5 bg-green-500 text-white rounded-xl hover:shadow-lg hover:shadow-green-200 transition-all">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-8 py-16 text-center">
                                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                </div>
                                <p class="text-text-secondary font-bold">No bookings found in the system yet.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
