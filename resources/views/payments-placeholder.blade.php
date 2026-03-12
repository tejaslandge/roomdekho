@extends('layouts.dashboard')

@section('title', 'Payments History')

@section('content')
<div class="space-y-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-stat-card label="Total Revenue" value="₹45,250" icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M12 16V15"></path></svg>' trend="+12% this month" />
        <x-stat-card label="Pending Payouts" value="₹12,400" icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' />
        <x-stat-card label="Completed Payments" value="128" icon='<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' />
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-50 flex justify-between items-center">
            <h2 class="text-xl font-bold text-text-primary">Transaction History</h2>
            <div class="flex gap-2">
                <button class="px-4 py-2 bg-soft text-primary text-sm font-bold rounded-xl hover:bg-primary/10 transition-colors">Export CSV</button>
                <button class="px-4 py-2 bg-primary text-white text-sm font-bold rounded-xl shadow-sm shadow-primary/20 hover:shadow-lg transition-all">Filter</button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Transaction ID</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Property</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Date</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Amount</th>
                        <th class="px-6 py-4 text-xs font-bold text-text-secondary uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @forelse([] as $payment)
                        <!-- This would be populated from DB -->
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-text-secondary">
                                <div class="flex flex-col items-center">
                                    <svg class="w-12 h-12 text-gray-200 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                    <p>No transactions found</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                    <!-- Dummy Rows for High Fidelity -->
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-text-primary">#TRX-89021</td>
                        <td class="px-6 py-4 text-sm text-text-secondary">Modern Villa, Bangalore</td>
                        <td class="px-6 py-4 text-sm text-text-secondary">Oct 12, 2023</td>
                        <td class="px-6 py-4 text-sm font-bold text-text-primary">₹12,000</td>
                        <td class="px-6 py-4"><x-status-badge status="paid" /></td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 text-sm font-medium text-text-primary">#TRX-89019</td>
                        <td class="px-6 py-4 text-sm text-text-secondary">Skyline Apartment</td>
                        <td class="px-6 py-4 text-sm text-text-secondary">Oct 10, 2023</td>
                        <td class="px-6 py-4 text-sm font-bold text-text-primary">₹8,500</td>
                        <td class="px-6 py-4"><x-status-badge status="pending" /></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
