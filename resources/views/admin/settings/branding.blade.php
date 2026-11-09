@extends('layouts.dashboard')

@section('title', 'Logo & Favicon')

@section('content')
<div class="mx-auto max-w-6xl space-y-6">
    <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
        <div>
            <p class="text-xs font-bold uppercase tracking-[.18em] text-primary">Admin · Branding</p>
            <h1 class="mt-1 font-display text-2xl font-bold text-text-primary">Logo & Favicon</h1>
            <p class="mt-1 text-sm text-text-secondary">Upload the RoomDekho identity once and it updates the website, dashboards, auth pages and PWA.</p>
        </div>
        <a href="{{ route('home') }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-2xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-bold text-text-secondary hover:border-primary/30 hover:text-primary">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            View website
        </a>
    </div>

    @include('admin.settings.partials.tabs')
    @include('admin.settings.partials.errors')

    <!-- Live previews -->
    <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
        <div class="mb-5 flex items-center justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-text-primary">Live Preview</h2>
                <p class="mt-1 text-sm text-text-secondary">Exactly how your branding appears after saving.</p>
            </div>
            <span class="rounded-lg bg-primary/10 px-3 py-1 text-[10px] font-bold uppercase text-primary">Dynamic</span>
        </div>

        <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
            <div class="rounded-2xl border border-gray-100 bg-soft/40 p-4">
                <p class="mb-3 text-[11px] font-bold uppercase tracking-wide text-text-secondary">Desktop header</p>
                <div class="flex items-center justify-between rounded-2xl border border-gray-100 bg-white px-5 py-3 shadow-sm">
                    <div class="flex items-center gap-2">
                        @if ($branding['has_logo'])
                            <img src="{{ $branding['logo_url'] }}" alt="{{ $branding['site_name'] }}" class="h-9 w-auto">
                        @else
                            <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-primary text-lg font-bold text-white">R</span>
                            <span class="font-display text-lg font-bold text-primary">{{ $branding['site_name'] }}</span>
                        @endif
                    </div>
                    <div class="hidden items-center gap-4 text-[11px] font-bold text-text-secondary sm:flex">
                        <span>Home</span><span>Find Rooms</span><span class="text-primary">How it Works</span>
                    </div>
                    <span class="rounded-xl bg-primary px-3 py-1.5 text-[11px] font-bold text-white">Join</span>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-soft/40 p-4">
                <p class="mb-3 text-[11px] font-bold uppercase tracking-wide text-text-secondary">Mobile header</p>
                <div class="flex max-w-xs items-center justify-between rounded-2xl border border-gray-100 bg-white px-4 py-3 shadow-sm">
                    <div class="flex items-center gap-2">
                        @if ($branding['has_mobile_logo'])
                            <img src="{{ $branding['logo_mobile_url'] }}" alt="{{ $branding['site_name'] }}" class="h-8 w-auto">
                        @elseif ($branding['has_logo'])
                            <img src="{{ $branding['logo_url'] }}" alt="{{ $branding['site_name'] }}" class="h-8 w-auto">
                        @else
                            <span class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary text-base font-bold text-white">R</span>
                            <span class="font-display text-base font-bold text-primary">{{ $branding['site_name'] }}</span>
                        @endif
                    </div>
                    <span class="rounded-lg bg-primary/10 px-2 py-1 text-[10px] font-bold text-primary">Menu</span>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-soft/40 p-4">
                <p class="mb-3 text-[11px] font-bold uppercase tracking-wide text-text-secondary">Browser tab</p>
                <div class="inline-flex max-w-full items-center gap-3 rounded-t-xl border border-gray-100 bg-white px-4 py-3 shadow-sm">
                    <img src="{{ $branding['favicon_png_url'] }}" alt="Favicon" class="h-5 w-5 rounded">
                    <span class="truncate text-xs font-medium text-text-primary">{{ $branding['site_name'] }} | {{ $branding['tagline'] }}</span>
                </div>
            </div>

            <div class="rounded-2xl border border-gray-100 bg-soft/40 p-4">
                <p class="mb-3 text-[11px] font-bold uppercase tracking-wide text-text-secondary">Social sharing image</p>
                <div class="overflow-hidden rounded-xl border border-gray-100 bg-white shadow-sm">
                    <img src="{{ $branding['social_image_url'] }}" alt="Social sharing preview" class="aspect-[1200/630] w-full object-cover">
                    <div class="p-3">
                        <p class="text-[10px] font-bold uppercase text-text-secondary">roomdekho.test</p>
                        <p class="mt-1 text-xs font-bold text-text-primary">{{ $branding['site_name'] }} — {{ $branding['tagline'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <form method="POST" action="{{ route('admin.settings.branding.update') }}" enctype="multipart/form-data" class="space-y-6" x-data="{ saving: false }" @submit="saving = true">
        @csrf
        @method('PUT')

        <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <div class="mb-6">
                <h2 class="text-xl font-bold text-text-primary">Brand Assets</h2>
                <p class="mt-1 text-sm text-text-secondary">PNG, JPG, WebP and sanitised SVG are supported. Maximum 2 MB per logo, 4 MB for social images.</p>
            </div>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 xl:grid-cols-3">
                <x-settings-upload
                    name="logo"
                    label="Main Website Logo"
                    :value="$branding['logo_url']"
                    :has-custom="$branding['has_logo']"
                    remove-key="logo"
                    recommended="PNG, SVG or WebP · transparent background"
                    hint="Shown in public header, dashboards and auth pages."
                />

                <x-settings-upload
                    name="logo_dark"
                    label="Dark Version Logo"
                    :value="$branding['logo_dark_url']"
                    :has-custom="$branding['has_dark_logo']"
                    remove-key="logo_dark"
                    recommended="Light logo for dark backgrounds"
                    hint="Used in dark footers and dark appearance mode."
                />

                <x-settings-upload
                    name="logo_mobile"
                    label="Mobile Logo"
                    :value="$branding['logo_mobile_url']"
                    :has-custom="$branding['has_mobile_logo']"
                    remove-key="logo_mobile"
                    recommended="Compact mark · PNG or SVG"
                    hint="Shown in the mobile navigation drawer."
                />

                <x-settings-upload
                    name="favicon_png"
                    label="Favicon PNG"
                    :value="$branding['favicon_png_url']"
                    :has-custom="site_settings()->hasCustomMedia('favicon_png')"
                    remove-key="favicon_png"
                    accept="image/png"
                    recommended="PNG · 32×32 or 192×192"
                    hint="Used by modern browsers and previews."
                />

                <x-settings-upload
                    name="favicon_ico"
                    label="Favicon ICO"
                    :value="$branding['favicon_ico_url']"
                    :has-custom="site_settings()->hasCustomMedia('favicon_ico')"
                    remove-key="favicon_ico"
                    accept="image/x-icon,image/vnd.microsoft.icon,image/png"
                    recommended="ICO · 16/32/48 multi-size"
                    hint="Legacy browser favicon."
                />

                <x-settings-upload
                    name="apple_touch_icon"
                    label="Apple Touch Icon"
                    :value="$branding['apple_touch_icon_url']"
                    :has-custom="site_settings()->hasCustomMedia('apple_touch_icon')"
                    remove-key="apple_touch_icon"
                    accept="image/png"
                    recommended="PNG · 180×180"
                    hint="Used when saved to an iPhone home screen."
                />

                <x-settings-upload
                    name="social_image"
                    label="Default Social Sharing Image"
                    :value="$branding['social_image_url']"
                    :has-custom="site_settings()->hasCustomMedia('social_image')"
                    remove-key="social_image"
                    accept="image/png,image/jpeg,image/webp"
                    recommended="PNG, JPG or WebP · 1200×630"
                    hint="Open Graph and Twitter sharing preview."
                    class="md:col-span-2 xl:col-span-3"
                />
            </div>
        </section>

        <div class="sticky bottom-4 flex flex-col-reverse items-stretch justify-between gap-3 rounded-3xl border border-gray-100 bg-white/90 p-4 shadow-lg backdrop-blur sm:flex-row sm:items-center">
            <button type="submit" name="reset_branding" value="1" onclick="return confirm('Reset every logo, favicon and social image to the default RoomDekho assets?')"
                    class="rounded-2xl border border-gray-200 px-5 py-3 text-sm font-bold text-text-secondary transition hover:border-red-200 hover:bg-red-50 hover:text-red-600">
                Reset to Default
            </button>
            <button type="submit" :disabled="saving" class="rd-button inline-flex items-center justify-center gap-2 rounded-2xl bg-primary px-8 py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 transition hover:bg-primary/90 disabled:opacity-60">
                <svg x-show="saving" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                <span x-text="saving ? 'Saving...' : 'Save Changes'">Save Changes</span>
            </button>
        </div>
    </form>
</div>
@endsection
