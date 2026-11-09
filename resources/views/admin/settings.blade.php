@extends('layouts.dashboard')

@section('title', 'System Settings')

@section('content')
<div class="max-w-4xl space-y-8">
    @if ($errors->any())
        <div class="p-4 bg-red-50 text-red-700 rounded-2xl border border-red-100">
            <p class="font-bold text-sm mb-2">Please fix the following:</p>
            <ul class="text-sm list-disc list-inside space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-8">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
            <div class="flex items-start justify-between gap-4 mb-6">
                <div>
                    <h2 class="text-xl font-bold text-text-primary">General Configuration</h2>
                    <p class="text-sm text-text-secondary mt-1">These values are stored in the database and used across the platform.</p>
                </div>
                <span class="px-3 py-1 bg-primary/10 text-primary text-[10px] uppercase font-bold rounded-lg">Live</span>
            </div>

            <div class="space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 bg-soft/50 rounded-2xl border border-gray-50">
                    <div>
                        <label for="site_name" class="font-bold text-text-primary text-sm">Site Name</label>
                        <p class="text-xs text-text-secondary">Display name for the application</p>
                    </div>
                    <input id="site_name" name="site_name" type="text" required maxlength="100"
                           value="{{ old('site_name', $settings['site_name']) }}"
                           class="w-full sm:w-72 px-4 py-2 rounded-xl border border-gray-100 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 bg-soft/50 rounded-2xl border border-gray-50">
                    <div>
                        <label for="support_email" class="font-bold text-text-primary text-sm">Support Email</label>
                        <p class="text-xs text-text-secondary">Public contact address for tenant and owner queries</p>
                    </div>
                    <input id="support_email" name="support_email" type="email" maxlength="150"
                           value="{{ old('support_email', $settings['support_email']) }}"
                           class="w-full sm:w-72 px-4 py-2 rounded-xl border border-gray-100 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 p-4 bg-soft/50 rounded-2xl border border-gray-50">
                    <div>
                        <label for="commission_rate" class="font-bold text-text-primary text-sm">Commission Rate (%)</label>
                        <p class="text-xs text-text-secondary">Percentage taken from each booking</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <input id="commission_rate" name="commission_rate" type="number" min="0" max="100" step="0.01" required
                               value="{{ old('commission_rate', $settings['commission_rate']) }}"
                               class="w-28 px-4 py-2 rounded-xl border border-gray-100 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20" />
                        <span class="text-sm font-bold text-text-secondary">%</span>
                    </div>
                </div>

                <div class="flex items-center justify-between gap-4 p-4 bg-soft/50 rounded-2xl border border-gray-50">
                    <div>
                        <h3 class="font-bold text-text-primary text-sm">Maintenance Mode</h3>
                        <p class="text-xs text-text-secondary">Disable site access for everyone except admins</p>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" name="maintenance_mode" value="1" class="sr-only peer"
                               @checked(old('maintenance_mode', $settings['maintenance_mode']) === '1')>
                        <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:bg-primary after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                    </label>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8">
            <h2 class="text-xl font-bold text-text-primary mb-6">Payment Gateway</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="p-6 border-2 {{ $razorpay['configured'] ? 'border-primary/10 bg-primary/5' : 'border-amber-100 bg-amber-50/50' }} rounded-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <span class="font-bold text-text-primary">Razorpay</span>
                        @if ($razorpay['configured'])
                            <span class="px-2 py-1 bg-green-100 text-green-700 text-[10px] uppercase font-bold rounded-lg">Connected</span>
                        @else
                            <span class="px-2 py-1 bg-amber-100 text-amber-700 text-[10px] uppercase font-bold rounded-lg">Not configured</span>
                        @endif
                    </div>
                    <p class="text-xs text-text-secondary mb-4">UPI, cards, net banking and wallet payments for bookings and rent.</p>

                    @if ($razorpay['configured'])
                        <dl class="text-xs space-y-2">
                            <div class="flex justify-between gap-4">
                                <dt class="text-text-secondary">Key ID</dt>
                                <dd class="font-mono font-bold text-text-primary">{{ substr($razorpay['key_id'], 0, 8) }}••••••</dd>
                            </div>
                            <div class="flex justify-between gap-4">
                                <dt class="text-text-secondary">Mode</dt>
                                <dd class="font-bold text-text-primary">{{ str_starts_with($razorpay['key_id'], 'rzp_test_') ? 'Test' : 'Live' }}</dd>
                            </div>
                            <div class="flex justify-between gap-4">
                                <dt class="text-text-secondary">Webhook</dt>
                                <dd class="font-bold {{ $razorpay['webhook_configured'] ? 'text-green-600' : 'text-amber-600' }}">
                                    {{ $razorpay['webhook_configured'] ? 'Verified' : 'Secret missing' }}
                                </dd>
                            </div>
                        </dl>
                    @else
                        <p class="text-xs text-amber-700 leading-relaxed">
                            Add <code class="font-mono">RAZORPAY_KEY_ID</code> and
                            <code class="font-mono">RAZORPAY_KEY_SECRET</code> to your
                            <code class="font-mono">.env</code> file, then clear the config cache.
                            Secrets are never stored in the database or shown here.
                        </p>
                    @endif
                </div>

                <div class="p-6 border border-gray-100 rounded-2xl">
                    <div class="flex items-center justify-between mb-4">
                        <span class="font-bold text-text-primary">Environment Checklist</span>
                    </div>
                    <ul class="text-xs space-y-2">
                        @foreach (['RAZORPAY_KEY_ID' => config('services.razorpay.key_id'), 'RAZORPAY_KEY_SECRET' => config('services.razorpay.key_secret'), 'RAZORPAY_WEBHOOK_SECRET' => config('services.razorpay.webhook_secret')] as $variable => $value)
                            <li class="flex items-center gap-2">
                                <span class="w-2 h-2 rounded-full {{ filled($value) ? 'bg-green-500' : 'bg-gray-300' }}"></span>
                                <code class="font-mono text-text-secondary">{{ $variable }}</code>
                            </li>
                        @endforeach
                    </ul>
                    <p class="text-[11px] text-text-secondary mt-4 leading-relaxed">
                        Payment success must be verified server-side using Razorpay signatures before a booking is confirmed.
                    </p>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-end gap-3">
            <a href="{{ route('admin.dashboard') }}" class="px-6 py-3 rounded-2xl text-sm font-bold text-text-secondary hover:bg-white border border-transparent hover:border-gray-200 transition-all">Cancel</a>
            <button type="submit" class="bg-primary text-white px-8 py-3 rounded-2xl font-bold text-sm shadow-lg shadow-primary/20 hover:bg-primary/90 active:scale-95 transition-all">
                Save Settings
            </button>
        </div>
    </form>
</div>
@endsection
