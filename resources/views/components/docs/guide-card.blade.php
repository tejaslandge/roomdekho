@props(['title', 'description', 'tag' => null, 'tone' => 'live'])

<article {{ $attributes->merge(['class' => 'doc-guide-card doc-reveal']) }} data-guide-card data-search="{{ strtolower($title . ' ' . $description . ' ' . ($tag ?? '')) }}">
    <div class="doc-guide-visual">
        {{ $slot }}
    </div>
    <div class="doc-guide-body">
        <div class="doc-guide-meta">
            <span class="doc-guide-dot"></span>
            @if ($tag)
                <span class="doc-tag {{ $tone === 'guide' ? 'doc-tag--guide' : 'doc-tag--live' }}">{{ $tag }}</span>
            @endif
        </div>
        <h4>{{ $title }}</h4>
        <p>{{ $description }}</p>
    </div>
</article>
