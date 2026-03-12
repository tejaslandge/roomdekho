@extends('layouts.dashboard')

@section('title', 'Secure Payment')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Summary Card -->
        <div class="space-y-6">
            <h2 class="text-2xl font-black text-text-primary uppercase tracking-tighter">Payment Summary</h2>
            <div class="bg-white rounded-[2rem] border border-gray-100 p-8 shadow-sm space-y-6">
                <div class="flex gap-4 pb-6 border-b border-gray-50">
                    <div class="w-20 h-20 rounded-2xl bg-gray-100 overflow-hidden shrink-0">
                        @if($booking->room->images->count() > 0)
                            <img src="{{ asset('storage/' . $booking->room->images->first()->image_path) }}" class="w-full h-full object-cover">
                        @else
                            <img src="https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=400" class="w-full h-full object-cover">
                        @endif
                    </div>
                    <div>
                        <h4 class="font-black text-text-primary">{{ $booking->room->property->title }}</h4>
                        <p class="text-xs font-bold text-text-secondary uppercase mt-1">{{ $booking->room->room_type }}</p>
                    </div>
                </div>

                <div class="space-y-4">
                    <div class="flex justify-between font-bold text-sm">
                        <span class="text-text-secondary">Security Deposit</span>
                        <span class="text-text-primary">₹{{ number_format($booking->amount) }}</span>
                    </div>
                    <div class="flex justify-between font-bold text-sm">
                        <span class="text-text-secondary">First Month Rent</span>
                        <span class="text-text-primary">₹{{ number_format($booking->amount) }}</span>
                    </div>
                    <div class="pt-4 border-t border-gray-50 flex justify-between">
                        <span class="font-black text-text-primary uppercase">Total Initial</span>
                        <span class="text-2xl font-black text-primary">₹{{ number_format($booking->amount * 2) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment Form -->
        <div class="space-y-6">
            <h2 class="text-2xl font-black text-text-primary uppercase tracking-tighter">Choose Method</h2>
            <form action="{{ route('tenant.payments.store') }}" method="POST" class="space-y-4">
                @csrf
                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                
                <label class="block relative group cursor-pointer">
                    <input type="radio" name="payment_method" value="upi" checked class="peer hidden">
                    <div class="p-6 bg-white border-2 border-gray-100 rounded-[2rem] peer-checked:border-primary peer-checked:bg-primary/5 transition-all group-hover:border-primary/50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
                                </div>
                                <div>
                                    <p class="font-black text-text-primary uppercase tracking-tighter">UPI / PhonePe</p>
                                    <p class="text-[10px] font-bold text-text-secondary uppercase">Instant activation</p>
                                </div>
                            </div>
                            <div class="w-6 h-6 rounded-full border-2 border-gray-200 peer-checked:border-primary flex items-center justify-center">
                                <div class="w-3 h-3 bg-primary rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                            </div>
                        </div>
                    </div>
                </label>

                <label class="block relative group cursor-pointer">
                    <input type="radio" name="payment_method" value="card" class="peer hidden">
                    <div class="p-6 bg-white border-2 border-gray-100 rounded-[2rem] peer-checked:border-primary peer-checked:bg-primary/5 transition-all group-hover:border-primary/50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H7a1 1 0 00-1 1v2a1 1 0 01-1 1H2a1 1 0 110-2V4zm2 2v2a1 1 0 001 1h6a1 1 0 001-1V6a1 1 0 00-1-1H7a1 1 0 00-1 1z" clip-rule="evenodd"></path></svg>
                                </div>
                                <div>
                                    <p class="font-black text-text-primary uppercase tracking-tighter">Debit / Credit Card</p>
                                    <p class="text-[10px] font-bold text-text-secondary uppercase">Secure Checkout</p>
                                </div>
                            </div>
                            <div class="w-6 h-6 rounded-full border-2 border-gray-200 peer-checked:border-primary flex items-center justify-center">
                                <div class="w-3 h-3 bg-primary rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                            </div>
                        </div>
                    </div>
                </label>

                <label class="block relative group cursor-pointer">
                    <input type="radio" name="payment_method" value="cash" class="peer hidden">
                    <div class="p-6 bg-white border-2 border-gray-100 rounded-[2rem] peer-checked:border-primary peer-checked:bg-primary/5 transition-all group-hover:border-primary/50">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-xl bg-gray-50 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-primary" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                </div>
                                <div>
                                    <p class="font-black text-text-primary uppercase tracking-tighter">Handover Cash</p>
                                    <p class="text-[10px] font-bold text-text-secondary uppercase">Pay directly to owner</p>
                                </div>
                            </div>
                            <div class="w-6 h-6 rounded-full border-2 border-gray-200 peer-checked:border-primary flex items-center justify-center">
                                <div class="w-3 h-3 bg-primary rounded-full opacity-0 peer-checked:opacity-100 transition-opacity"></div>
                            </div>
                        </div>
                    </div>
                </label>

                <button type="submit" class="w-full bg-primary text-white py-6 rounded-[2rem] font-black uppercase tracking-widest hover:shadow-2xl hover:shadow-primary/30 transition-all transform hover:-translate-y-1 active:scale-[0.98] mt-4">
                    Proceed to Pay ₹{{ number_format($booking->amount * 2) }}
                </button>
            </form>
            <p class="text-center text-[10px] font-black text-text-secondary uppercase tracking-[0.2em]">100% Secure SSL Encryption</p>
        </div>
    </div>
</div>
@endsection
