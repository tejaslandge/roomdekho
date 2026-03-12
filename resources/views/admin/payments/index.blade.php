@extends('layouts.dashboard')

@section('title', 'Payments & Transactions')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-text-primary">Global Transactions</h1>
        <div class="flex gap-3">
             <button class="bg-white border border-gray-100 px-4 py-2 rounded-xl text-sm font-bold text-text-secondary hover:bg-gray-50 transition-colors">Export CSV</button>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 text-text-secondary text-xs uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">Tenant</th>
                        <th class="px-6 py-4">Property / Owner</th>
                        <th class="px-6 py-4">Amount</th>
                        <th class="px-6 py-4">Date</th>
                        <th class="px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse($transactions as $transaction)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <p class="text-sm font-bold text-text-primary">{{ $transaction->tenant->name }}</p>
                            <p class="text-xs text-text-secondary">{{ $transaction->tenant->email }}</p>
                        </td>
                        <td class="px-6 py-4">
                            <p class="text-sm font-medium text-text-primary">{{ $transaction->room->property->title }}</p>
                            <p class="text-xs text-text-secondary">Owner: {{ $transaction->room->property->owner->name }}</p>
                        </td>
                        <td class="px-6 py-4 font-bold text-text-primary">
                            ₹{{ number_format($transaction->amount, 0) }}
                        </td>
                        <td class="px-6 py-4 text-sm text-text-secondary">
                            {{ $transaction->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4">
                            <x-status-badge :status="$transaction->status" />
                        </td>
                        <td class="px-6 py-4 text-right">
                             <button class="text-primary hover:underline text-sm font-bold">Receipt</button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-text-secondary">No transaction records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($transactions->hasPages())
        <div class="px-6 py-4 border-t border-gray-50 text-right">
            {{ $transactions->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
