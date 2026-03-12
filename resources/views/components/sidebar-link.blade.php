@props(['active' => false, 'icon' => ''])

<a {{ $attributes->merge(['class' => 'flex items-center gap-3 px-4 py-2.5 text-sm font-medium rounded-xl transition-all duration-200 ' . ($active ? 'bg-primary/10 text-primary' : 'text-text-secondary hover:bg-gray-50 hover:text-text-primary')]) }}>
    @if($icon)
        <div class="flex-shrink-0">
            {!! $icon !!}
        </div>
    @endif
    <span>{{ $slot }}</span>
</a>
