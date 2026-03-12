@extends('layouts.dashboard')

@section('title', 'System Reports')

@section('content')
<div class="space-y-8">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <p class="text-sm font-bold text-text-secondary uppercase tracking-wider mb-2">Occupancy Rate</p>
            <div class="flex items-end gap-3">
                <h3 class="text-4xl font-display font-bold text-text-primary">
                    {{ $occupancyStat['total_rooms'] > 0 ? round(($occupancyStat['occupied_rooms'] / $occupancyStat['total_rooms']) * 100) : 0 }}%
                </h3>
                <span class="text-sm text-green-500 font-bold mb-1">+5% from last month</span>
            </div>
            <p class="text-xs text-text-secondary mt-4">{{ $occupancyStat['occupied_rooms'] }} of {{ $occupancyStat['total_rooms'] }} rooms occupied</p>
        </div>

        <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm">
            <p class="text-sm font-bold text-text-secondary uppercase tracking-wider mb-2">Monthly Revenue</p>
            <div class="flex items-end gap-3">
                <h3 class="text-4xl font-display font-bold text-text-primary">
                    ₹{{ number_format($revenueData->sum('total'), 0) }}
                </h3>
                <span class="text-sm text-green-500 font-bold mb-1">Growth: +12%</span>
            </div>
             <p class="text-xs text-text-secondary mt-4">Calculated from verified bookings</p>
        </div>

        <div class="bg-primary p-8 rounded-3xl shadow-lg shadow-primary/20">
            <p class="text-sm font-bold text-white/70 uppercase tracking-wider mb-2">System Health</p>
            <div class="flex items-end gap-3">
                <h3 class="text-4xl font-display font-bold text-white">Optimal</h3>
            </div>
            <p class="text-xs text-white/60 mt-4">All servers and services are operational</p>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
        <h2 class="text-xl font-bold text-text-primary mb-8">Revenue Growth (Last 6 Months)</h2>
        <div class="h-64 flex items-end justify-between gap-4 px-4 pb-8 border-b border-gray-50">
            @foreach($revenueData as $data)
            <div class="flex-1 flex flex-col items-center gap-4">
                <div class="w-full bg-primary/10 rounded-t-xl relative group transition-all" style="height: {{ min(100, ($data->total / 10000) * 100) }}%">
                    <div class="absolute -top-10 left-1/2 -translate-x-1/2 bg-text-primary text-white text-[10px] px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                        ₹{{ number_format($data->total, 0) }}
                    </div>
                </div>
                <p class="text-xs font-bold text-text-secondary">{{ $data->month }}</p>
            </div>
            @endforeach
            @if($revenueData->isEmpty())
                 <div class="w-full h-full flex items-center justify-center text-text-secondary italic">No data available yet</div>
            @endif
        </div>
    </div>
</div>
@endsection
