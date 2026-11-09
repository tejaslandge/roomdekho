@extends('layouts.dashboard')

@section('title', 'SEO Settings')

@section('content')
@php
    $seoImage = site_settings()->mediaUrl('seo_og_image') ?: $branding['social_image_url'];
    $socialImage = $branding['social_image_url'];
@endphp

<div class="mx-auto max-w-6xl space-y-6">
    <div class="flex flex-col justify-between gap-3 sm:flex-row sm:items-end">
        <div>
            <p class="text-xs font-bold uppercase tracking-[.18em] text-primary">Admin · SEO</p>
            <h1 class="mt-1 font-display text-2xl font-bold text-text-primary">SEO Settings</h1>
            <p class="mt-1 text-sm text-text-secondary">Set global metadata defaults. Individual pages can override the title and description.</p>
        </div>
        <a href="{{ route('home') }}" target="_blank" rel="noopener" class="inline-flex items-center gap-2 rounded-2xl border border-gray-200 bg-white px-4 py-2.5 text-sm font-bold text-text-secondary hover:border-primary/30 hover:text-primary">
            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
            View website
        </a>
    </div>

    @include('admin.settings.partials.tabs')
    @include('admin.settings.partials.errors')

    <form method="POST" action="{{ route('admin.settings.seo.update') }}" enctype="multipart/form-data" class="space-y-6"
          x-data="{
              title: @js(old('seo_title', $settings['seo_title'] ?? '')),
              description: @js(old('seo_description', $settings['seo_description'] ?? '')),
              saving: false
          }" @submit="saving = true">
        @csrf
        @method('PUT')

        <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <h2 class="text-xl font-bold text-text-primary">Default Metadata</h2>
            <p class="mt-1 text-sm text-text-secondary">Used when a public page does not define its own metadata.</p>

            <div class="mt-6 space-y-5">
                <div>
                    <label for="seo_title" class="mb-1.5 block text-sm font-bold text-text-primary">Default Meta Title</label>
                    <input id="seo_title" name="seo_title" x-model="title" type="text" maxlength="255" value="{{ old('seo_title', $settings['seo_title'] ?? '') }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20">
                    <p class="mt-1 text-xs text-text-secondary">Recommended 50–60 characters. <span x-text="title.length"></span>/255</p>
                    @error('seo_title')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="seo_description" class="mb-1.5 block text-sm font-bold text-text-primary">Default Meta Description</label>
                    <textarea id="seo_description" name="seo_description" x-model="description" rows="3" maxlength="500"
                              class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20">{{ old('seo_description', $settings['seo_description'] ?? '') }}</textarea>
                    <p class="mt-1 text-xs text-text-secondary">Recommended 150–160 characters. <span x-text="description.length"></span>/500</p>
                    @error('seo_description')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="seo_keywords" class="mb-1.5 block text-sm font-bold text-text-primary">Meta Keywords</label>
                    <input id="seo_keywords" name="seo_keywords" type="text" maxlength="500" value="{{ old('seo_keywords', $settings['seo_keywords'] ?? '') }}"
                           class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none transition focus:border-primary focus:ring-2 focus:ring-primary/20">
                    <p class="mt-1 text-xs text-text-secondary">Comma-separated. Modern search engines treat this as a weak signal.</p>
                    @error('seo_keywords')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label for="seo_twitter_card" class="mb-1.5 block text-sm font-bold text-text-primary">Twitter Card</label>
                        <select id="seo_twitter_card" name="seo_twitter_card" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                            <option value="summary_large_image" @selected(old('seo_twitter_card', $settings['seo_twitter_card'] ?? 'summary_large_image') === 'summary_large_image')>Large image summary</option>
                            <option value="summary" @selected(old('seo_twitter_card', $settings['seo_twitter_card'] ?? '') === 'summary')>Summary</option>
                        </select>
                    </div>
                    <div>
                        <label for="seo_robots" class="mb-1.5 block text-sm font-bold text-text-primary">Search Engine Indexing</label>
                        <select id="seo_robots" name="seo_robots" class="w-full rounded-xl border border-gray-200 px-4 py-2.5 text-sm outline-none focus:border-primary focus:ring-2 focus:ring-primary/20">
                            <option value="index,follow" @selected(old('seo_robots', $settings['seo_robots'] ?? 'index,follow') === 'index,follow')>Index and follow</option>
                            <option value="noindex,nofollow" @selected(old('seo_robots', $settings['seo_robots'] ?? '') === 'noindex,nofollow')>No index, no follow</option>
                        </select>
                    </div>
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <h2 class="text-xl font-bold text-text-primary">Search Result Preview</h2>
            <div class="mt-5 max-w-2xl rounded-2xl border border-gray-100 bg-white p-5">
                <div class="flex items-center gap-2 text-xs text-text-secondary">
                    <img src="{{ $branding['favicon_png_url'] }}" alt="Favicon" class="h-4 w-4 rounded">
                    <span>roomdekho.test</span>
                </div>
                <p class="mt-2 truncate text-lg font-medium text-[#1a0dab]" x-text="title || '{{ $branding['site_name'] }} | {{ $branding['tagline'] }}'"></p>
                <p class="mt-1 line-clamp-2 text-sm text-[#4d5156]" x-text="description || '{{ $settings['website_description'] ?? '' }}'"></p>
            </div>
        </section>

        <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <h2 class="text-xl font-bold text-text-primary">Social Sharing Images</h2>
            <p class="mt-1 text-sm text-text-secondary">Open Graph and Twitter previews. The default social image also appears on the Logo & Favicon page.</p>

            <div class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-2">
                <x-settings-upload
                    name="seo_og_image"
                    label="Open Graph Image"
                    :value="$seoImage"
                    :has-custom="site_settings()->hasCustomMedia('seo_og_image')"
                    remove-key="seo_og_image"
                    accept="image/png,image/jpeg,image/webp"
                    recommended="PNG, JPG or WebP · 1200×630"
                    hint="Primary image for search and social previews."
                />
                <x-settings-upload
                    name="social_image"
                    label="Default Social Sharing Image"
                    :value="$socialImage"
                    :has-custom="site_settings()->hasCustomMedia('social_image')"
                    remove-key="social_image"
                    accept="image/png,image/jpeg,image/webp"
                    recommended="PNG, JPG or WebP · 1200×630"
                    hint="Fallback used by the PWA and all pages."
                />
            </div>
        </section>

        <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-center">
                <div>
                    <h2 class="text-xl font-bold text-text-primary">Favicon Configuration</h2>
                    <p class="mt-1 text-sm text-text-secondary">Browser favicons and the Apple touch icon are managed centrally.</p>
                </div>
                <a href="{{ route('admin.settings.branding') }}" class="inline-flex items-center gap-2 rounded-2xl border border-gray-200 px-4 py-2.5 text-sm font-bold text-text-secondary hover:border-primary/30 hover:text-primary">
                    Manage favicons
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="mt-5 flex flex-wrap items-center gap-4">
                <div class="flex items-center gap-3 rounded-2xl border border-gray-100 bg-soft/50 p-4">
                    <img src="{{ $branding['favicon_png_url'] }}" alt="Favicon PNG" class="h-8 w-8 rounded-lg">
                    <div>
                        <p class="text-xs font-bold text-text-primary">Favicon PNG</p>
                        <p class="font-mono text-[10px] text-text-secondary">/icons/favicon-32.png</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 rounded-2xl border border-gray-100 bg-soft/50 p-4">
                    <img src="{{ $branding['apple_touch_icon_url'] }}" alt="Apple touch icon" class="h-8 w-8 rounded-lg">
                    <div>
                        <p class="text-xs font-bold text-text-primary">Apple Touch Icon</p>
                        <p class="font-mono text-[10px] text-text-secondary">180×180 PNG</p>
                    </div>
                </div>
            </div>
        </section>

        <div class="sticky bottom-4 flex items-center justify-end gap-3 rounded-3xl border border-gray-100 bg-white/90 p-4 shadow-lg backdrop-blur">
            <a href="{{ route('admin.dashboard') }}" class="rounded-2xl border border-transparent px-6 py-3 text-sm font-bold text-text-secondary transition hover:border-gray-200 hover:bg-white">Cancel</a>
            <button type="submit" :disabled="saving" class="rd-button inline-flex items-center gap-2 rounded-2xl bg-primary px-8 py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 transition hover:bg-primary/90 disabled:opacity-60">
                <svg x-show="saving" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                <span x-text="saving ? 'Saving...' : 'Save SEO Settings'">Save SEO Settings</span>
            </button>
        </div>
    </form>
</div>
@endsection
