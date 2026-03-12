@extends('layouts.dashboard')

@section('title', 'Property Earnings')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-text-primary">Record of Earnings</h1>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-text-secondary text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">Tenant</th>
                        <th class="px-6 py-4">Property / Room</th>
                        <th class="px-6 py-4">Rent Amount</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($transactions as $transaction)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm font-bold text-text-primary capitalize">
                            {{ $transaction->tenant->name }}
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-text-primary">{{ $transaction->room->property->title }}</p>
                            <p class="text-xs text-text-secondary">{{ $transaction->room->room_type }}</p>
                        </td>
                        <td class="px-6 py-4 font-bold text-text-primary">
                            ₹{{ number_format($transaction->amount, 0) }}
                        </td>
                        <td class="px-6 py-4">
                            <x-status-badge :status="$transaction->status" />
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">
                            {{ $transaction->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-right">
                             <button class="text-primary hover:underline text-sm font-bold">Details</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-text-secondary">No earnings records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
