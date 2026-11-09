@php($logoBrand = site_branding())

@if ($logoBrand['has_logo'])
    <img src="{{ $logoBrand['logo_url'] }}" alt="{{ $logoBrand['site_name'] }}" {{ $attributes->merge(['class' => 'h-10 w-auto']) }}>
@else
    <div {{ $attributes->merge(['class' => 'text-3xl font-black tracking-tighter']) }}>
        @if ($logoBrand['site_name'] === 'RoomDekho')
            <span class="text-purple-600">Room</span><span class="text-pink-500">Dekho</span>
        @else
            <span class="text-purple-600">{{ $logoBrand['site_name'] }}</span>
        @endif
    </div>
@endif
