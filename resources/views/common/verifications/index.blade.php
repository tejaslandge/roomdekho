@extends('layouts.dashboard')

@section('title', 'My Verifications')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-bold text-text-primary">Verification Status</h1>
            <p class="text-text-secondary">Mandatory for owners and tenants to become active users.</p>
        </div>
        @if(auth()->user()->status !== 'active')
            <a href="{{ route('verifications.create') }}" class="btn-primary flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Submit New Document
            </a>
        @endif
    </div>

    <!-- Mandatory Info -->
    <div class="p-6 bg-primary/5 border border-primary/10 rounded-3xl">
        <div class="flex items-start gap-4">
            <div class="p-3 bg-primary/10 rounded-2xl text-primary">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-primary">Verification Requirements</h3>
                <p class="text-sm text-primary/80 mt-1">To reach **Active** status, you must have two approved documents:</p>
                <ul class="list-disc list-inside text-sm text-primary/70 mt-2 space-y-1">
                    <li>1. Aadhaar Card (Approved)</li>
                    <li>2. PAN Card OR Driving License (Approved)</li>
                </ul>
                <div class="mt-4">
                    <span class="text-sm font-semibold">Current Status:</span>
                    <span class="px-3 py-1 rounded-full text-xs font-bold {{ auth()->user()->status === 'active' ? 'bg-green-100 text-green-600' : 'bg-yellow-100 text-yellow-600' }} capitalize">
                        {{ auth()->user()->status }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50/50 border-b border-gray-100 text-xs font-bold uppercase tracking-wider text-text-secondary">
                    <tr>
                        <th class="px-8 py-4">Document Type</th>
                        <th class="px-8 py-4">ID Number</th>
                        <th class="px-8 py-4">Date Submitted</th>
                        <th class="px-8 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($verifications as $verification)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-5">
                                <span class="font-semibold text-text-primary uppercase">{{ str_replace('_', ' ', $verification->id_type) }}</span>
                            </td>
                            <td class="px-8 py-5 text-sm text-text-secondary">
                                {{ $verification->id_number }}
                            </td>
                            <td class="px-8 py-5 text-sm text-text-secondary">
                                {{ $verification->created_at->format('M d, Y') }}
                            </td>
                            <td class="px-8 py-5">
                                <div class="flex flex-col gap-1">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold w-fit
                                        @if($verification->status === 'approved') bg-green-100 text-green-600 
                                        @elseif($verification->status === 'rejected') bg-red-100 text-red-600 
                                        @else bg-yellow-100 text-yellow-600 @endif capitalize">
                                        {{ $verification->status }}
                                    </span>
                                    @if($verification->status === 'rejected' && $verification->rejection_reason)
                                        <p class="text-[10px] text-red-500 font-medium">Reason: {{ $verification->rejection_reason }}</p>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-10 text-center text-text-secondary">
                                No verification documents found.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
