@php
    $tabs = [
        ['route' => 'admin.settings', 'label' => 'General Settings', 'icon' => 'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
        ['route' => 'admin.settings.branding', 'label' => 'Logo & Favicon', 'icon' => 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
        ['route' => 'admin.settings.pwa', 'label' => 'PWA / App Settings', 'icon' => 'M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z'],
        ['route' => 'admin.settings.appearance', 'label' => 'Appearance', 'icon' => 'M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01'],
        ['route' => 'admin.settings.seo', 'label' => 'SEO Settings', 'icon' => 'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
    ];
@endphp

<div class="mb-6 overflow-x-auto rounded-3xl border border-gray-100 bg-white p-2 shadow-sm">
    <nav class="flex min-w-max items-center gap-1" aria-label="Settings sections">
        @foreach ($tabs as $tab)
            @php($active = request()->routeIs($tab['route']))
            <a href="{{ route($tab['route']) }}"
               class="flex items-center gap-2 rounded-2xl px-4 py-3 text-sm font-bold transition-all {{ $active ? 'bg-primary text-white shadow-lg shadow-primary/20' : 'text-text-secondary hover:bg-soft hover:text-primary' }}">
                <svg class="h-4 w-4 flex-none" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $tab['icon'] }}"></path>
                </svg>
                {{ $tab['label'] }}
            </a>
        @endforeach
    </nav>
</div>
