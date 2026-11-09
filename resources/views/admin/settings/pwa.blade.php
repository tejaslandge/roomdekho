@extends('layouts.dashboard')

@section('title', 'PWA / App Settings')

@section('content')
@php
    $displayOptions = ['standalone' => 'Standalone (recommended)', 'fullscreen' => 'Fullscreen', 'minimal-ui' => 'Minimal UI', 'browser' => 'Browser'];
    $orientationOptions = ['portrait' => 'Portrait', 'any' => 'Any', 'landscape' => 'Landscape'];
@endphp

<div class="mx-auto max-w-6xl space-y-6">
    <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
        <div>
            <p class="text-xs font-bold uppercase tracking-[.18em] text-primary">Admin · PWA</p>
            <h1 class="mt-1 font-display text-2xl font-bold text-text-primary">PWA / App Settings</h1>
            <p class="mt-1 text-sm text-text-secondary">Control the installable app manifest, icons, colours and launch behaviour.</p>
        </div>
        <a href="{{ route('pwa.manifest') }}?v={{ $pwa['version'] }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-2xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-bold text-text-secondary hover:border-primary/30 hover:text-primary">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            View manifest
        </a>
    </div>

    @include('admin.settings.partials.tabs')
    @include('admin.settings.partials.errors')

    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-[11px] font-bold uppercase tracking-wide text-text-secondary">Manifest version</p>
            <p class="mt-1 font-display text-2xl font-bold text-text-primary">v{{ $pwa['version'] }}</p>
        </div>
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-[11px] font-bold uppercase tracking-wide text-text-secondary">PWA status</p>
            <p class="mt-1 inline-flex items-center gap-2 text-sm font-bold {{ $pwa['enabled'] ? 'text-green-600' : 'text-amber-600' }}">
                <span class="h-2 w-2 rounded-full {{ $pwa['enabled'] ? 'bg-green-500' : 'bg-amber-500' }}"></span>
                {{ $pwa['enabled'] ? 'Enabled' : 'Disabled' }}
            </p>
        </div>
        <div class="rounded-2xl border border-gray-100 bg-white p-5 shadow-sm">
            <p class="text-[11px] font-bold uppercase tracking-wide text-text-secondary">Service worker</p>
            <p class="mt-1 font-mono text-xs font-bold text-text-primary">/sw.js · scope /</p>
        </div>
    </div>

    <form method="POST" action="{{ route('admin.settings.pwa.update') }}" enctype="multipart/form-data" class="space-y-6" x-data="{ saving: false }" @submit="saving = true">
        @csrf
        @method('PUT')

        <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <div class="flex items-center justify-between gap-4 rounded-2xl border border-gray-100 bg-soft/60 p-4">
                <div>
                    <h2 class="text-lg font-bold text-text-primary">Enable PWA</h2>
                    <p class="mt-1 text-xs text-text-secondary">Publishes the manifest, registers the service worker and exposes install prompts.</p>
                </div>
                <label class="relative inline-flex cursor-pointer items-center">
                    <input type="checkbox" name="pwa_enabled" value="1" class="peer sr-only" @checked(old('pwa_enabled', $pwa['enabled'] ? '1' : '0') === '1')>
                    <div class="h-6 w-11 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-[2px] after:h-5 after:w-5 after:rounded-full after:border after:border-gray-300 after:bg-white after:transition-all after:content-[''] peer-checked:bg-primary peer-checked:after:translate-x-full peer-checked:after:border-white"></div>
                </label>
            </div>

            <div class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="pwa_name" class="mb-1.5 block text-sm font-bold text-text-primary">App Name <span class="text-red-500">*</span></label>
                    <input id="pwa_name" name="pwa_name" type="text" required maxlength="100" value="{{ old('pwa_name', $pwa['name']) }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('pwa_name')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="pwa_short_name" class="mb-1.5 block text-sm font-bold text-text-primary">Short App Name <span class="text-red-500">*</span></label>
                    <input id="pwa_short_name" name="pwa_short_name" type="text" required maxlength="32" value="{{ old('pwa_short_name', $pwa['short_name']) }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20">
                    <p class="mt-1 text-xs text-text-secondary">Keep this under 12 characters for the home screen.</p>
                    @error('pwa_short_name')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="md:col-span-2">
                    <label for="pwa_description" class="mb-1.5 block text-sm font-bold text-text-primary">App Description</label>
                    <input id="pwa_description" name="pwa_description" type="text" maxlength="500" value="{{ old('pwa_description', $pwa['description']) }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('pwa_description')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="pwa_start_url" class="mb-1.5 block text-sm font-bold text-text-primary">Start URL</label>
                    <input id="pwa_start_url" name="pwa_start_url" type="text" required maxlength="255" value="{{ old('pwa_start_url', $pwa['start_url']) }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 font-mono text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20">
                    @error('pwa_start_url')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="pwa_display" class="mb-1.5 block text-sm font-bold text-text-primary">Display Mode</label>
                        <select id="pwa_display" name="pwa_display" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                            @foreach ($displayOptions as $value => $label)
                                <option value="{{ $value }}" @selected(old('pwa_display', $pwa['display']) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="pwa_orientation" class="mb-1.5 block text-sm font-bold text-text-primary">Orientation</label>
                        <select id="pwa_orientation" name="pwa_orientation" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                            @foreach ($orientationOptions as $value => $label)
                                <option value="{{ $value }}" @selected(old('pwa_orientation', $pwa['orientation']) === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8" x-data="{ theme: @js(old('pwa_theme_color', $pwa['theme_color'])), background: @js(old('pwa_background_color', $pwa['background_color'])) }">
            <h2 class="text-xl font-bold text-text-primary">App Colours</h2>
            <p class="mt-1 text-sm text-text-secondary">These colours populate <code class="font-mono">theme_color</code> and <code class="font-mono">background_color</code> in the manifest.</p>

            <div class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-text-primary">Theme Color</label>
                    <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-2">
                        <input type="color" x-model="theme" class="h-10 w-12 cursor-pointer rounded-lg border-0 bg-transparent p-0" aria-label="Theme colour picker">
                        <input name="pwa_theme_color" x-model="theme" type="text" required pattern="^#[0-9A-Fa-f]{6}$" class="w-full border-0 p-0 font-mono text-sm uppercase outline-none focus:ring-0">
                    </div>
                    @error('pwa_theme_color')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-bold text-text-primary">Background Color</label>
                    <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-2">
                        <input type="color" x-model="background" class="h-10 w-12 cursor-pointer rounded-lg border-0 bg-transparent p-0" aria-label="Background colour picker">
                        <input name="pwa_background_color" x-model="background" type="text" required pattern="^#[0-9A-Fa-f]{6}$" class="w-full border-0 p-0 font-mono text-sm uppercase outline-none focus:ring-0">
                    </div>
                    @error('pwa_background_color')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div class="mt-5 rounded-2xl border border-primary/10 bg-primary/5 p-4">
                <div class="flex items-center gap-3">
                    <span class="flex h-11 w-11 items-center justify-center rounded-xl text-white" :style="'background:' + theme">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    </span>
                    <div>
                        <p class="text-sm font-bold text-text-primary">RoomDekho app badge preview</p>
                        <p class="text-xs text-text-secondary" x-text="'Theme ' + theme + ' · Background ' + background"></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <h2 class="text-xl font-bold text-text-primary">App Icons</h2>
            <p class="mt-1 text-sm text-text-secondary">Upload square PNG icons. Dimensions are validated on the server before saving.</p>

            <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-3">
                <x-settings-upload
                    name="pwa_icon_192"
                    label="App Icon 192×192"
                    :value="$pwa['icon_192']"
                    :has-custom="site_settings()->hasCustomMedia('pwa_icon_192')"
                    remove-key="pwa_icon_192"
                    accept="image/png"
                    recommended="Exact PNG · 192×192"
                    hint="Required for Chrome installability."
                />
                <x-settings-upload
                    name="pwa_icon_512"
                    label="App Icon 512×512"
                    :value="$pwa['icon_512']"
                    :has-custom="site_settings()->hasCustomMedia('pwa_icon_512')"
                    remove-key="pwa_icon_512"
                    accept="image/png"
                    recommended="Exact PNG · 512×512"
                    hint="Used on splash screens and stores."
                />
                <x-settings-upload
                    name="pwa_maskable_icon"
                    label="Maskable Icon"
                    :value="$pwa['maskable']"
                    :has-custom="site_settings()->hasCustomMedia('pwa_maskable_icon')"
                    remove-key="pwa_maskable_icon"
                    accept="image/png"
                    recommended="Exact PNG · 512×512"
                    hint="Keep the logo inside the centre safe zone."
                />
            </div>

            <div class="mt-5 rounded-2xl border border-amber-100 bg-amber-50 p-4 text-xs leading-relaxed text-amber-800">
                Removing a custom icon falls back to the bundled RoomDekho icon. PWA installation must be tested on a real browser over HTTPS; local <code class="font-mono">*.test</code> installs may be limited by Chrome.
            </div>
        </section>

        <div class="sticky bottom-4 flex items-center justify-end gap-3 rounded-3xl border border-gray-100 bg-white/90 p-4 shadow-lg backdrop-blur">
            <a href="{{ route('admin.dashboard') }}" class="rounded-2xl border border-transparent px-6 py-3 text-sm font-bold text-text-secondary transition hover:border-gray-200 hover:bg-white">Cancel</a>
            <button type="submit" :disabled="saving" class="rd-button inline-flex items-center gap-2 rounded-2xl bg-primary px-8 py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 transition hover:bg-primary/90 disabled:opacity-60">
                <svg x-show="saving" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                <span x-text="saving ? 'Saving...' : 'Save PWA Settings'">Save PWA Settings</span>
            </button>
        </div>
    </form>
</div>
@endsection
