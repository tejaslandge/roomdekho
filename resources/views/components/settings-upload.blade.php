@props([
    'name',
    'label',
    'value' => '',
    'hasCustom' => false,
    'accept' => 'image/png,image/jpeg,image/webp,image/svg+xml',
    'hint' => '',
    'recommended' => '',
    'removeKey' => null,
])

<div {{ $attributes->merge(['class' => 'rounded-2xl border border-gray-100 bg-white p-4']) }} x-data="{ dragging: false, preview: @js($value), filename: null }">
    <div class="mb-3 flex items-start justify-between gap-3">
        <div>
            <p class="text-sm font-bold text-text-primary">{{ $label }}</p>
            @if ($recommended)
                <p class="mt-0.5 text-[11px] font-medium text-primary">{{ $recommended }}</p>
            @endif
        </div>
        @if ($hasCustom)
            <span class="rounded-lg bg-green-50 px-2 py-1 text-[10px] font-bold uppercase text-green-700">Custom</span>
        @endif
    </div>

    <div
        class="relative flex min-h-[138px] cursor-pointer flex-col items-center justify-center gap-3 rounded-xl border-2 border-dashed p-4 text-center transition"
        :class="dragging ? 'border-primary bg-primary/5' : 'border-gray-200 bg-soft/40 hover:border-primary/40'"
        @dragover.prevent="dragging = true"
        @dragleave.prevent="dragging = false"
        @drop.prevent="
            dragging = false;
            if ($event.dataTransfer.files.length) {
                $refs.file.files = $event.dataTransfer.files;
                $refs.file.dispatchEvent(new Event('change'));
            }
        "
        @click="$refs.file.click()"
        role="button"
        tabindex="0"
        @keydown.enter.prevent="$refs.file.click()"
        @keydown.space.prevent="$refs.file.click()"
    >
        <input x-ref="file" type="file" name="{{ $name }}" accept="{{ $accept }}" class="hidden"
               @change="
                   if ($event.target.files.length) {
                       filename = $event.target.files[0].name;
                       preview = URL.createObjectURL($event.target.files[0]);
                   }
               ">

        <template x-if="preview">
            <img :src="preview" alt="{{ $label }} preview" class="max-h-16 max-w-[85%] rounded-lg object-contain">
        </template>
        <template x-if="!preview">
            <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-white text-primary shadow-sm">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
            </div>
        </template>

        <div>
            <p class="text-xs font-bold text-primary" x-text="filename || 'Click to browse or drag & drop'"></p>
            <p class="mt-1 text-[10px] text-text-secondary">{{ $hint }}</p>
        </div>
    </div>

    @if ($hasCustom && $removeKey)
        <label class="mt-3 flex cursor-pointer items-center gap-2 text-xs font-medium text-red-600">
            <input type="checkbox" name="remove[]" value="{{ $removeKey }}" class="rounded border-gray-300 text-red-500 focus:ring-red-400">
            Remove this image and use the default
        </label>
    @endif
</div>
