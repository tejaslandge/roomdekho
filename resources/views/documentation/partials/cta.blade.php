<section class="doc-section" id="start">
    <div class="doc-wrap">
        <div class="doc-cta doc-reveal">
            <h2>Ready to find your next room?</h2>
            <p>Explore verified listings, talk directly to owners and keep every booking detail in one calm, visual workspace.</p>
            <div class="doc-cta-actions">
                <a href="{{ route('rooms.search') }}" class="doc-btn doc-btn-primary">
                    Explore available rooms
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </a>
                @guest
                    <a href="{{ route('register') }}" class="doc-btn doc-btn-ghost">List your property</a>
                @else
                    <a href="{{ url('/dashboard') }}" class="doc-btn doc-btn-ghost">Open my dashboard</a>
                @endguest
            </div>
        </div>

        <div class="doc-footnote">
            <span>RoomDekho · Discover how the platform works</span>
            <a href="#docTop" style="color:#7c5ce5;font-weight:800;">Back to top ↑</a>
        </div>
    </div>
</section>
