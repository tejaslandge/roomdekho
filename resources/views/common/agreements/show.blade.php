@extends('layouts.dashboard')

@section('title', 'Rental Agreement')

@section('content')
<div class="max-w-4xl mx-auto space-y-8 pb-12">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-black text-text-primary uppercase tracking-tighter">Tenancy Agreement</h1>
        <div class="flex gap-2">
            <button onclick="window.print()" class="bg-white border border-gray-200 text-text-primary px-6 py-2.5 rounded-xl font-bold text-sm hover:bg-gray-50 transition-all flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Print PDF
            </button>
        </div>
    </div>

    <div class="bg-white rounded-[2rem] border border-gray-100 p-12 shadow-sm space-y-12 relative overflow-hidden">
        <!-- Watermark -->
        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 opacity-[0.03] pointer-events-none select-none">
            <h1 class="text-[12rem] font-black uppercase -rotate-45">RoomDekho</h1>
        </div>

        <!-- Header -->
        <div class="text-center space-y-2 relative">
            <h2 class="text-3xl font-black text-text-primary uppercase tracking-tighter">Residential Lease Agreement</h2>
            <p class="text-text-secondary font-bold text-sm">Agreement ID: #AGR-{{ str_pad($agreement->id, 5, '0', STR_PAD_LEFT) }}</p>
        </div>

        <div class="grid grid-cols-2 gap-12 relative">
            <div class="space-y-4">
                <h4 class="text-xs font-black text-primary uppercase tracking-[0.2em] border-b border-primary/10 pb-2">The Lessor (Owner)</h4>
                <div class="space-y-1">
                    <p class="font-black text-lg text-text-primary">{{ $agreement->owner->name }}</p>
                    <p class="text-sm text-text-secondary font-medium">{{ $agreement->owner->email }}</p>
                </div>
            </div>
            <div class="space-y-4">
                <h4 class="text-xs font-black text-primary uppercase tracking-[0.2em] border-b border-primary/10 pb-2">The Lessee (Tenant)</h4>
                <div class="space-y-1">
                    <p class="font-black text-lg text-text-primary">{{ $agreement->tenant->name }}</p>
                    <p class="text-sm text-text-secondary font-medium">{{ $agreement->tenant->email }}</p>
                </div>
            </div>
        </div>

        <div class="space-y-6 relative">
            <h4 class="text-xs font-black text-primary uppercase tracking-[0.2em] border-b border-primary/10 pb-2">1. The Property</h4>
            <p class="text-text-primary font-medium leading-relaxed">
                The Lessor hereby agrees to lease the following premises to the Lessee:
                <br>
                <span class="font-black">{{ $agreement->booking->room->room_type }}</span> at 
                <span class="font-black">{{ $agreement->booking->room->property->title }}, {{ $agreement->booking->room->property->address }}, {{ $agreement->booking->room->property->city }}</span>.
            </p>
        </div>

        <div class="space-y-6 relative">
            <h4 class="text-xs font-black text-primary uppercase tracking-[0.2em] border-b border-primary/10 pb-2">2. Term & Payment</h4>
            <div class="grid grid-cols-2 gap-8">
                <div class="bg-gray-50 p-6 rounded-2xl">
                    <p class="text-[10px] font-black text-text-secondary uppercase">Rent Amount</p>
                    <p class="text-2xl font-black text-primary">₹{{ number_format($agreement->booking->amount) }} / mo</p>
                </div>
                <div class="bg-gray-50 p-6 rounded-2xl">
                    <p class="text-[10px] font-black text-text-secondary uppercase">Commencement Date</p>
                    <p class="text-xl font-black text-text-primary">{{ \Carbon\Carbon::parse($agreement->start_date)->format('d M, Y') }}</p>
                </div>
            </div>
        </div>

        <div class="space-y-4 relative">
            <h4 class="text-xs font-black text-primary uppercase tracking-[0.2em] border-b border-primary/10 pb-2">3. Standard Terms</h4>
            <ul class="space-y-3 text-sm text-text-secondary font-medium list-disc pl-5">
                <li>The Lessee shall pay the monthly rent on or before the 5th of every month.</li>
                <li>The security deposit shall be refundable at the end of the tenancy after deducting any damages.</li>
                <li>Electricity and Water charges are to be paid as per consumption ({{ $agreement->booking->room->electricity_type }}).</li>
                <li>Sub-letting of the premises is strictly prohibited without written consent.</li>
            </ul>
        </div>

        <div class="pt-12 flex justify-between items-end relative border-t border-gray-100">
            <div class="text-center space-y-4">
                <div class="w-48 border-b-2 border-gray-100 pb-2 text-primary font-black italic">
                    {{ $agreement->owner->name }}
                </div>
                <p class="text-[10px] font-black text-text-secondary uppercase">Owner Signature</p>
            </div>
            
            <div class="flex flex-col items-center">
                <div class="w-24 h-24 rounded-full border-4 border-green-100 flex items-center justify-center text-green-500 mb-2">
                    <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                </div>
                <p class="text-[10px] font-black text-green-600 uppercase">Electronically Verified</p>
            </div>

            <div class="text-center space-y-4">
                <div class="w-48 border-b-2 border-gray-100 pb-2 text-primary font-black italic">
                    {{ $agreement->tenant->name }}
                </div>
                <p class="text-[10px] font-black text-text-secondary uppercase">Tenant Signature</p>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .bg-white { border: none !important; shadow: none !important; }
    button, .flex.items-center.justify-between:first-child { display: none !important; }
    .max-w-4xl { max-width: 100% !important; margin: 0 !important; }
}
</style>
@endsection
