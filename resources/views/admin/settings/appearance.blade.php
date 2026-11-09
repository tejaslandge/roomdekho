@extends('layouts.dashboard')

@section('title', 'Appearance')

@section('content')
<div class="mx-auto max-w-6xl space-y-6">
    <div>
        <p class="text-xs font-bold uppercase tracking-[.18em] text-primary">Admin · Appearance</p>
        <h1 class="mt-1 font-display text-2xl font-bold text-text-primary">Appearance Settings</h1>
        <p class="mt-1 text-sm text-text-secondary">Apply RoomDekho's purple, blue and pink identity through validated CSS custom properties.</p>
    </div>

    @include('admin.settings.partials.tabs')
    @include('admin.settings.partials.errors')

    <form method="POST" action="{{ route('admin.settings.appearance.update') }}" class="space-y-6"
          x-data="{
              primary: @js(old('primary_color', $appearance['primary_color'])),
              secondary: @js(old('secondary_color', $appearance['secondary_color'])),
              accent: @js(old('accent_color', $appearance['accent_color'])),
              header: @js(old('header_background', $appearance['header_background'])),
              footer: @js(old('footer_background', $appearance['footer_background'])),
              buttonStyle: @js(old('button_style', $appearance['button_style'])),
              theme: @js(old('theme', $appearance['theme'])),
              saving: false
          }" @submit="saving = true">
        @csrf
        @method('PUT')

        <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <h2 class="text-xl font-bold text-text-primary">Brand Colours</h2>
            <p class="mt-1 text-sm text-text-secondary">Only valid 6-digit hex values are accepted. Defaults preserve the existing RoomDekho palette.</p>

            <div class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-3">
                @foreach ([
                    ['model' => 'primary', 'name' => 'primary_color', 'label' => 'Primary Color', 'hint' => 'Buttons, links and highlights'],
                    ['model' => 'secondary', 'name' => 'secondary_color', 'label' => 'Secondary Color', 'hint' => 'Gradients and accents'],
                    ['model' => 'accent', 'name' => 'accent_color', 'label' => 'Accent Color', 'hint' => 'Supporting highlights'],
                ] as $color)
                    <div>
                        <label class="mb-1.5 block text-sm font-bold text-text-primary">{{ $color['label'] }}</label>
                        <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-2">
                            <input type="color" x-model="{{ $color['model'] }}" class="h-10 w-12 cursor-pointer rounded-lg border-0 bg-transparent p-0" aria-label="{{ $color['label'] }} picker">
                            <input name="{{ $color['name'] }}" x-model="{{ $color['model'] }}" type="text" required pattern="^#[0-9A-Fa-f]{6}$"
                                   class="w-full border-0 p-0 font-mono text-sm uppercase outline-none focus:ring-0">
                        </div>
                        <p class="mt-1 text-xs text-text-secondary">{{ $color['hint'] }}</p>
                        @error($color['name'])<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                    </div>
                @endforeach
            </div>

            <div class="mt-6 grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-text-primary">Header Background</label>
                    <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-2">
                        <input type="color" x-model="header" class="h-10 w-12 cursor-pointer rounded-lg border-0 bg-transparent p-0" aria-label="Header background picker">
                        <input name="header_background" x-model="header" type="text" required pattern="^#[0-9A-Fa-f]{6}$" class="w-full border-0 p-0 font-mono text-sm uppercase outline-none focus:ring-0">
                    </div>
                    @error('header_background')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label class="mb-1.5 block text-sm font-bold text-text-primary">Footer Background</label>
                    <div class="flex items-center gap-3 rounded-xl border border-gray-200 p-2">
                        <input type="color" x-model="footer" class="h-10 w-12 cursor-pointer rounded-lg border-0 bg-transparent p-0" aria-label="Footer background picker">
                        <input name="footer_background" x-model="footer" type="text" required pattern="^#[0-9A-Fa-f]{6}$" class="w-full border-0 p-0 font-mono text-sm uppercase outline-none focus:ring-0">
                    </div>
                    @error('footer_background')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <h2 class="text-xl font-bold text-text-primary">Shape & Theme</h2>

            <div class="mt-6 grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <p class="mb-2 text-sm font-bold text-text-primary">Button Style</p>
                    <div class="grid grid-cols-3 gap-2">
                        @foreach (['rounded' => 'Rounded', 'pill' => 'Pill', 'square' => 'Square'] as $value => $label)
                            <label class="cursor-pointer">
                                <input type="radio" name="button_style" value="{{ $value }}" x-model="buttonStyle" class="peer sr-only">
                                <span class="block rounded-xl border-2 border-gray-100 px-3 py-3 text-center text-xs font-bold text-text-secondary transition peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    @error('button_style')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <p class="mb-2 text-sm font-bold text-text-primary">Website Theme</p>
                    <div class="grid grid-cols-2 gap-2">
                        @foreach (['light' => 'Light', 'dark' => 'Dark'] as $value => $label)
                            <label class="cursor-pointer">
                                <input type="radio" name="theme" value="{{ $value }}" x-model="theme" class="peer sr-only">
                                <span class="block rounded-xl border-2 border-gray-100 px-3 py-3 text-center text-xs font-bold text-text-secondary transition peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary">{{ $label }}</span>
                            </label>
                        @endforeach
                    </div>
                    <p class="mt-2 text-xs text-text-secondary">Dark theme applies to the public website and installed app shell.</p>
                    @error('theme')<p class="mt-1 text-xs font-medium text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>
        </section>

        <section class="rounded-3xl border border-gray-100 bg-white p-6 shadow-sm md:p-8">
            <h2 class="text-xl font-bold text-text-primary">Live Preview</h2>
            <div class="mt-5 overflow-hidden rounded-2xl border border-gray-100" :style="'background:' + (theme === 'dark' ? '#0f1020' : '#f9f7ff')">
                <div class="flex items-center justify-between px-5 py-3" :style="'background:' + header">
                    <div class="flex items-center gap-2">
                        <span class="flex h-8 w-8 items-center justify-center rounded-lg text-sm font-bold text-white" :style="'background:' + primary">R</span>
                        <span class="font-display text-sm font-bold" :style="'color:' + primary">RoomDekho</span>
                    </div>
                    <div class="flex gap-2">
                        <span class="text-[11px] font-bold" :style="'color:' + (theme === 'dark' ? '#c4b5fd' : '#6b7280')">Find Rooms</span>
                        <span class="text-[11px] font-bold" :style="'color:' + primary">How it Works</span>
                    </div>
                </div>
                <div class="p-6">
                    <p class="font-display text-lg font-bold" :style="'color:' + (theme === 'dark' ? '#f5f3ff' : '#1f2937')">Find your next home</p>
                    <p class="mt-1 text-xs" :style="'color:' + (theme === 'dark' ? '#c4b5fd' : '#6b7280')">Verified rooms with transparent pricing.</p>
                    <div class="mt-4 flex gap-2">
                        <span class="inline-flex items-center px-4 py-2 text-xs font-bold text-white"
                              :class="{ 'rounded-xl': buttonStyle === 'rounded', 'rounded-full': buttonStyle === 'pill', 'rounded-sm': buttonStyle === 'square' }"
                              :style="'background:' + primary">Search Now</span>
                        <span class="inline-flex items-center px-4 py-2 text-xs font-bold text-white"
                              :class="{ 'rounded-xl': buttonStyle === 'rounded', 'rounded-full': buttonStyle === 'pill', 'rounded-sm': buttonStyle === 'square' }"
                              :style="'background:' + secondary">List a Room</span>
                    </div>
                </div>
                <div class="px-5 py-3 text-center text-[10px]" :style="'background:' + footer + '; color:' + (theme === 'dark' ? '#c4b5fd' : '#6b7280')">© {{ date('Y') }} RoomDekho. All rights reserved.</div>
            </div>
        </section>

        <div class="sticky bottom-4 flex items-center justify-end gap-3 rounded-3xl border border-gray-100 bg-white/90 p-4 shadow-lg backdrop-blur">
            <a href="{{ route('admin.dashboard') }}" class="rounded-2xl border border-transparent px-6 py-3 text-sm font-bold text-text-secondary transition hover:border-gray-200 hover:bg-white">Cancel</a>
            <button type="submit" :disabled="saving" class="rd-button inline-flex items-center gap-2 rounded-2xl bg-primary px-8 py-3 text-sm font-bold text-white shadow-lg shadow-primary/20 transition hover:bg-primary/90 disabled:opacity-60">
                <svg x-show="saving" class="h-4 w-4 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path></svg>
                <span x-text="saving ? 'Saving...' : 'Save Appearance'">Save Appearance</span>
            </button>
        </div>
    </form>
</div>
@endsection
