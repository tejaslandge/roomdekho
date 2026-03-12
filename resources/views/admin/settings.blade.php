@extends('layouts.dashboard')

@section('title', 'System Settings')

@section('content')
<div class="max-w-4xl space-y-8">
    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
        <h2 class="text-xl font-bold text-text-primary mb-6">General Configuration</h2>
        <div class="space-y-6">
            <div class="flex items-center justify-between p-4 bg-soft/50 rounded-2xl border border-gray-50">
                <div>
                    <h3 class="font-bold text-text-primary text-sm">Site Name</h3>
                    <p class="text-xs text-text-secondary">Display name for the application</p>
                </div>
                <input type="text" value="RoomDekho" class="px-4 py-2 rounded-xl border border-gray-100 text-sm outline-none focus:border-primary" />
            </div>

            <div class="flex items-center justify-between p-4 bg-soft/50 rounded-2xl border border-gray-50">
                <div>
                    <h3 class="font-bold text-text-primary text-sm">Maintenance Mode</h3>
                    <p class="text-xs text-text-secondary">Disable site access for all users except admins</p>
                </div>
                 <div class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" value="" class="sr-only peer">
                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                </div>
            </div>

            <div class="flex items-center justify-between p-4 bg-soft/50 rounded-2xl border border-gray-50">
                <div>
                    <h3 class="font-bold text-text-primary text-sm">Commission Rate (%)</h3>
                    <p class="text-xs text-text-secondary">Percentage taken from each booking</p>
                </div>
                <input type="number" value="10" class="w-20 px-4 py-2 rounded-xl border border-gray-100 text-sm outline-none focus:border-primary" />
            </div>
        </div>
    </div>

    <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
        <h2 class="text-xl font-bold text-text-primary mb-6">Payment Gateways</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="p-6 border-2 border-primary/10 rounded-2xl bg-primary/5">
                <div class="flex items-center justify-between mb-4">
                    <span class="font-bold text-text-primary">Stripe</span>
                    <span class="px-2 py-1 bg-green-100 text-green-700 text-[10px] uppercase font-bold rounded-lg">Connected</span>
                </div>
                <p class="text-xs text-text-secondary mb-4">Handling credit card transactions</p>
                <button class="text-primary text-sm font-bold hover:underline">Configure</button>
            </div>
            <div class="p-6 border border-gray-100 rounded-2xl">
                 <div class="flex items-center justify-between mb-4">
                    <span class="font-bold text-text-primary">PayPal</span>
                    <span class="px-2 py-1 bg-gray-100 text-gray-500 text-[10px] uppercase font-bold rounded-lg">Disabled</span>
                </div>
                <p class="text-xs text-text-secondary mb-4">Secondary payment method</p>
                <button class="text-primary text-sm font-bold hover:underline">Setup</button>
            </div>
        </div>
    </div>
</div>
@endsection
