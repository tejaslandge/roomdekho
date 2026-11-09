@extends('layouts.dashboard')

@section('title', 'Rent & Tenancy')

@section('content')
    <div class="space-y-8">
        <div class="flex items-center justify-between">
            <h1 class="text-2xl font-black text-text-primary uppercase tracking-tighter">My Tenancies</h1>
            <p class="text-text-secondary text-sm font-bold">{{ $active_bookings->count() }} active bookings</p>
        </div>

        <div class="grid grid-cols-1 gap-6">
            @forelse($active_bookings as $booking)
                <div
                    class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-sm hover:shadow-xl hover:shadow-primary/5 transition-all duration-300">
                    <div class="flex flex-col lg:flex-row gap-8 items-start lg:items-center">
                        <!-- Room Info -->
                        <div class="flex items-center gap-6 flex-1">
                            <div class="w-24 h-24 rounded-3xl bg-gray-100 overflow-hidden shrink-0">
                                @if ($booking->room->images->count() > 0)
                                    <img src="{{ asset('storage/' . $booking->room->images->first()->image_path) }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=400"
                                        class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div>
                                <div class="flex items-center gap-2 mb-2">
                                    <span
                                        class="px-2 py-1 bg-primary/5 text-primary text-[10px] font-black uppercase rounded-lg border border-primary/10">{{ $booking->room->room_type }}</span>
                                    <span
                                        class="px-2 py-1 bg-green-50 text-green-600 text-[10px] font-black uppercase rounded-lg border border-green-100">Accepted</span>
                                </div>
                                <h3 class="text-xl font-black text-text-primary">{{ $booking->room->property->title }}</h3>
                                <p class="text-sm text-text-secondary font-medium">{{ $booking->room->property->address }}
                                </p>
                            </div>
                        </div>

                        <!-- Details -->
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-8 shrink-0">
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-text-secondary uppercase tracking-widest">Move-in Date
                                </p>
                                <p class="font-bold text-text-primary">
                                    {{ \Carbon\Carbon::parse($booking->start_date)->format('d M, Y') }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-text-secondary uppercase tracking-widest">Monthly Rent
                                </p>
                                <p class="font-bold text-primary">₹{{ number_format($booking->amount) }}</p>
                            </div>
                            <div class="space-y-1">
                                <p class="text-[10px] font-black text-text-secondary uppercase tracking-widest">Payment
                                    Status</p>
                                @if ($booking->payment)
                                    <div class="space-y-1">
                                        <span class="text-green-600 font-bold flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd"></path>
                                            </svg>
                                            Paid ₹{{ number_format($booking->payment->amount) }}
                                        </span>
                                        <p class="text-[9px] text-text-secondary font-bold uppercase">Incl. Deposit + 1st
                                            Month</p>
                                    </div>
                                @else
                                    <span class="text-orange-500 font-bold flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1 10a1 1 0 100-2 1 1 0 000 2zm1-8a1 1 0 00-2 0v4a1 1 0 002 0v-4z"
                                                clip-rule="evenodd"></path>
                                        </svg>
                                        Pending
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3 w-full lg:w-auto">
                            @if (!$booking->payment)
                                <a href="{{ route('tenant.payments.pay', $booking) }}"
                                    class="flex-1 lg:flex-none bg-primary text-white px-8 py-3 rounded-2xl font-black text-sm uppercase tracking-wider hover:shadow-lg hover:shadow-primary/20 transition-all text-center">
                                    Pay Now
                                </a>
                            @else
                                @if ($booking->agreement)
                                    <a href="{{ route('tenant.agreements.show', $booking->agreement) }}"
                                        class="flex-1 lg:flex-none bg-gray-50 text-text-primary border border-gray-100 px-8 py-3 rounded-2xl font-black text-sm uppercase tracking-wider hover:bg-gray-100 transition-all text-center">
                                        View Agreement
                                    </a>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="py-24 text-center space-y-4 bg-white rounded-[2rem] border border-gray-100">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto">
                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <p class="text-text-secondary font-bold">You don't have any active tenancies yet.</p>
                    <a href="{{ route('rooms.search') }}"
                        class="inline-block bg-primary text-white px-8 py-3 rounded-2xl font-bold hover:shadow-lg transition-all">Find
                        a Room</a>
                </div>
            @endforelse
        </div>
    </div>
@endsection
