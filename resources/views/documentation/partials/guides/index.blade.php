<section class="doc-section" id="guides">
    <div class="doc-wrap">
        <div class="doc-reveal">
            <span class="doc-eyebrow">User guides</span>
            <h2 class="doc-title">Choose your role.<br><span class="doc-gradient-text">Follow the path.</span></h2>
            <p class="doc-subtitle">
                Every guide includes a custom animated illustration of the actual step. Search all guides, or jump straight to the tenant, owner or admin journey.
            </p>
        </div>

        <div class="doc-guide-toolbar">
            <label class="doc-guide-search" for="docGuideSearch">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true"><circle cx="11" cy="11" r="7"/><path d="M20 20l-4-4" stroke-linecap="round"/></svg>
                <span class="sr-only">Search user guides</span>
                <input id="docGuideSearch" type="search" placeholder="Search guides: payment, agreement, KYC, chat..." autocomplete="off">
            </label>
            <div class="doc-guide-count">
                <span id="docGuideCount">40</span> guides
                <span style="color:#d8d2e8;padding:0 .35rem;">·</span>
                <span class="doc-tag doc-tag--live">Live</span>
                <span class="doc-tag doc-tag--guide">Guide</span>
            </div>
        </div>

        <p class="doc-reveal" style="font-size:.72rem;color:#9a97ad;margin:-.6rem 0 1.4rem;">
            <strong style="color:#6d4bd8;">Live</strong> flows are available in the current build.
            <strong style="color:#be3d80;">Guide</strong> flows show the recommended process, including features that may be rolled out over time.
        </p>

        <div id="docGuideEmpty" class="doc-guide-empty">
            No guides match that search yet. Try “payment”, “owner”, “booking” or “KYC”.
        </div>

        @include('documentation.partials.guides.tenant')
        @include('documentation.partials.guides.owner')
        @include('documentation.partials.guides.admin')
    </div>
</section>
