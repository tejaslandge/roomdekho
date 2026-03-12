@props(['label', 'value', 'icon', 'trend' => null, 'trendType' => 'up'])

<div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow duration-200">
    <div class="flex items-center justify-between mb-4">
        <div class="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center text-primary">
            {!! $icon !!}
        </div>
        @if($trend)
            <span class="text-xs font-semibold px-2 py-1 rounded-lg {{ $trendType === 'up' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                {{ $trend }}
            </span>
        @endif
    </div>
    <p class="text-sm font-medium text-text-secondary">{{ $label }}</p>
    <h3 class="text-2xl font-bold text-text-primary mt-1">{{ $value }}</h3>
</div>
