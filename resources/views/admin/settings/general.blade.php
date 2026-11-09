@extends('layouts.dashboard')

@section('title', 'Settings')

@section('content')
@php
    $timezoneOptions = [
        'Asia/Kolkata' => 'Asia/Kolkata (IST)',
        'UTC' => 'UTC',
        'Asia/Dubai' => 'Asia/Dubai',
        'Asia/Singapore' => 'Asia/Singapore',
        'Europe/London' => 'Europe/London',
        'America/New_York' => 'America/New_York',
        'America/Los_Angeles' => 'America/Los_Angeles',
        'Australia/Sydney' => 'Australia/Sydney',
    ];
    $currentTimezone = old('timezone', $settings['timezone'] ?? 'Asia/Kolkata');
    if (! isset($timezoneOptions[$currentTimezone])) {
        $timezoneOptions = [$currentTimezone => $currentTimezone] + $timezoneOptions;
    }
    $languageOptions = ['en' => 'English', 'hi' => 'हिन्दी (Hindi)', 'mr' => 'मराठी (Marathi)'];
@endphp

<div class="mx-auto max-w-6xl space-y-6">
    <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
        <div>
            <p class="text-xs font-bold uppercase tracking-[.18em] text-primary">Admin · Settings</p>
            <h1 class="mt-1 font-display text-2xl font-bold text-text-primary">Site Settings & Branding</h1>
            <p class="mt-1 text-sm text-text-secondary">Manage the public identity, PWA, appearance and SEO of {{ $settings['site_name'] ?? 'RoomDekho' }}.</p>
        </div>
        <a href="{{ route('home') }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-2xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-bold text-text-secondary hover:border-primary/30 hover:text-primary">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            View website
        </a>
    </div>

    @include('admin.settings.partials.tabs')
    @include('admin.settings.partials.errors')

    <form method="POST" action="{{ route('admin.settings.update') }}" class="space-y-6" x-data="{ saving: false }" @submit="saving = true">
        @csrf
        @method('PUT')

        <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <div class="mb-6 flex items-start justify-between gap-4">
                <div>
                    <h2 class="text-xl font-bold text-text-primary">General Configuration</h2>
                    <p class="mt-1 text-sm text-text-secondary">These values are stored in MySQL and rendered across every public page.</p>
                </div>
                <span class="rounded-lg bg-primary/10 px-3 py-1 text-[10px] font-bold uppercase text-primary">Live</span>
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="site_name" class="mb-1.5 block text-sm font-bold text-text-primary">Website Name <span class="text-red-500">*</span></label>
                    <input id="site_name" name="site_name" type="text" required maxlength="100" value="{{ old('site_name', $settings['site_name'] ?? '') }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20" />
                    @error('site_name')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="website_tagline" class="mb-1.5 block text-sm font-bold text-text-primary">Website Tagline</label>
                    <input id="website_tagline" name="website_tagline" type="text" maxlength="150" value="{{ old('website_tagline', $settings['website_tagline'] ?? '') }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20" />
                    @error('website_tagline')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="website_url" class="mb-1.5 block text-sm font-bold text-text-primary">Website URL</label>
                    <input id="website_url" name="website_url" type="url" maxlength="255" placeholder="https://roomdekho.test" value="{{ old('website_url', $settings['website_url'] ?? '') }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20" />
                    @error('website_url')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="support_email" class="mb-1.5 block text-sm font-bold text-text-primary">Contact Email</label>
                    <input id="support_email" name="support_email" type="email" maxlength="150" value="{{ old('support_email', $settings['support_email'] ?? '') }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20" />
                    @error('support_email')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="md:col-span-2">
                    <label for="website_description" class="mb-1.5 block text-sm font-bold text-text-primary">Website Description</label>
                    <textarea id="website_description" name="website_description" rows="3" maxlength="1000"
                              class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('website_description', $settings['website_description'] ?? '') }}</textarea>
                    <p class="mt-1 text-xs text-text-secondary">Used in the footer and as the fallback SEO description.</p>
                    @error('website_description')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <h2 class="mb-6 text-xl font-bold text-text-primary">Contact & Legal</h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="contact_phone" class="mb-1.5 block text-sm font-bold text-text-primary">Contact Phone</label>
                    <input id="contact_phone" name="contact_phone" type="text" maxlength="30" value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20" />
                    @error('contact_phone')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="copyright_text" class="mb-1.5 block text-sm font-bold text-text-primary">Copyright Text</label>
                    <input id="copyright_text" name="copyright_text" type="text" maxlength="255" placeholder="© {year} RoomDekho. All rights reserved." value="{{ old('copyright_text', $settings['copyright_text'] ?? '') }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20" />
                    <p class="mt-1 text-xs text-text-secondary">Use <code class="rounded bg-soft px-1">{year}</code> to insert the current year.</p>
                    @error('copyright_text')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="md:col-span-2">
                    <label for="contact_address" class="mb-1.5 block text-sm font-bold text-text-primary">Contact Address</label>
                    <textarea id="contact_address" name="contact_address" rows="2" maxlength="500"
                              class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('contact_address', $settings['contact_address'] ?? '') }}</textarea>
                    @error('contact_address')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <h2 class="mb-6 text-xl font-bold text-text-primary">Localization & Operations</h2>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                <div>
                    <label for="default_language" class="mb-1.5 block text-sm font-bold text-text-primary">Default Language</label>
                    <select id="default_language" name="default_language" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                        @foreach ($languageOptions as $value => $label)
                            <option value="{{ $value }}" @selected(old('default_language', $settings['default_language'] ?? 'en') === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('default_language')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="timezone" class="mb-1.5 block text-sm font-bold text-text-primary">Timezone</label>
                    <select id="timezone" name="timezone" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                        @foreach ($timezoneOptions as $value => $label)
                            <option value="{{ $value }}" @selected($currentTimezone === $value)>{{ $label }}</option>
                        @endforeach
                    </select>
                    @error('timezone')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="commission_rate" class="mb-1.5 block text-sm font-bold text-text-primary">Commission Rate (%) <span class="text-red-500">*</span></label>
                    <input id="commission_rate" name="commission_rate" type="number" min="0" max="100" step="0.01" required value="{{ old('commission_rate', $settings['commission_rate'] ?? '10') }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20" />
                    @error('commission_rate')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mt-6 flex items-center justify-between gap-4 rounded-2xl border border-gray-100 bg-soft/60 p-4">
                <div>
                    <h3 class="text-sm font-bold text-text-primary">Maintenance Mode</h3>
                    <p class="text-xs text-text-secondary">Temporarily block public access while keeping admin login available.</p>
                </div>
                <label class="relative inline-flex cursor-pointer items-center">
                    <input type="checkbox" name="maintenance_mode" value="1" class="peer sr-only" @checked(old('maintenance_mode', $settings['maintenance_mode'] ?? '0') === '1')>
                    <div class="h-6 w-11 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-primary peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                </label>
            </div>
        </section>

        <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <h2 class="mb-6 text-xl font-bold text-text-primary">Razorpay</h2>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="rounded-2xl border-2 p-6 {{ $razorpay['configured'] ? 'border-primary/10 bg-primary/5' : 'border-amber-100 bg-amber-50/50' }}">
                    <div class="mb-4 flex items-center justify-between">
                        <span class="font-bold text-text-primary">Payment Gateway</span>
                        @if ($razorpay['configured'])
                            <span class="rounded-lg bg-green-100 px-2 py-1 text-[10px] font-bold uppercase text-green-700">Connected</span>
                        @else
                            <span class="rounded-lg bg-amber-100 px-2 py-1 text-[10px] font-bold uppercase text-amber-700">Not configured</span>
                        @endif
                    </div>
                    <p class="mb-4 text-xs text-text-secondary">UPI, cards, net banking and wallet payments for bookings and rent.</p>

                    @if ($razorpay['configured'])
                        <dl class="space-y-2 text-xs">
                            <div class="flex justify-between gap-4">
                                <dt class="text-text-secondary">Key ID</dt>
                                <dd class="font-mono font-bold text-text-primary">{{ substr($razorpay['key_id'], 0, 8) }}••••••••</dd>
                            </div>
                            <div class="flex justify-between gap-4">
                                <dt class="text-text-secondary">Mode</dt>
                                <dd class="font-bold text-text-primary">{{ str_starts_with($razorpay['key_id'], 'rzp_test_') ? 'Test' : 'Live' }}</dd>
                            </div>
                            <div class="flex justify-between gap-4">
                                <dt class="text-text-secondary">Webhook</dt>
                                <dd class="font-bold {{ $razorpay['webhook_configured'] ? 'text-green-600' : 'text-amber-600' }}">{{ $razorpay['webhook_configured'] ? 'Verified' : 'Secret missing' }}</dd>
                            </div>
                        </dl>
                    @else
                        <p class="text-xs leading-relaxed text-amber-700">
                            Add <code class="font-mono">RAZORPAY_KEY_ID</code> and <code class="font-mono">RAZORPAY_KEY_SECRET</code> to your <code class="font-mono">.env</code> file, then clear the config cache. Secrets are never stored in the database or shown here.
                        </p>
                    @endif
                </div>

                <div class="rounded-2xl border border-gray-100 p-6">
                    <span class="font-bold text-text-primary">Environment Checklist</span>
                    <ul class="mt-4 space-y-2 text-xs">
                        @foreach (['RAZORPAY_KEY_ID' => config('services.razorpay.key_id'), 'RAZORPAY_KEY_SECRET' => config('services.razorpay.key_secret'), 'RAZORPAY_WEBHOOK_SECRET' => config('services.razorpay.webhook_secret')] as $variable => $value)
                            <li class="flex items-center gap-2">
                                <span class="h-2 w-2 rounded-full {{ filled($value) ? 'bg-green-500' : 'bg-gray-300' }}"></span>
                                <code class="font-mono text-text-secondary">{{ $variable }}</code>
                            </li>
                        @endforeach
                    </ul>
                    <p class="mt-4 text-[11px] leading-relaxed text-text-secondary">Payment success must be verified server-side using Razorpay signatures before a booking is confirmed.</p>
                </div>
            </div>
        </section>

        <div class="sticky bottom-4 flex items-center justify-end gap-3 rounded-3xl border border-gray-100 bg-white/90 p-4 shadow-lg backdrop-blur">
            <a href="{{ route('admin.dashboard') }}" class="rounded-2xl border border-transparent px-6 py-3 text-sm font-bold text-text-secondary transition-all hover:border-gray-200 hover:bg-white">Cancel</a>
            <button type="submit" :disabled="saving" class="rd-button inline-flex items-center gap-2 rounded-2xl bg-primary px-8 py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 transition-all hover:bg-primary/90 disabled:opacity-60">
                <svg x-show="saving" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                <span x-text="saving ? 'Saving...' : 'Save Settings'">Save Settings</span>
            </button>
        </div>
    </form>
</div>
@endsection
