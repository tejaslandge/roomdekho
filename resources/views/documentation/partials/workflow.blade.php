@php
    $steps = [
        [
            'kicker' => 'Step 01 · Owner',
            'title' => 'Owner lists the property',
            'summary' => 'A verified owner creates the property, adds room details and publishes the listing into the approval queue.',
            'points' => ['Register or sign in as an owner', 'Add property and room details', 'Upload photos and set monthly rent', 'Select amenities and submit for review'],
            'detail' => 'Owners must complete identity verification before a listing can go live. Each property can contain multiple rooms, and each room carries its own rent, availability, electricity type, water source and photos.',
            'visual' => 'listing',
        ],
        [
            'kicker' => 'Step 02 · Admin',
            'title' => 'Admin reviews and approves',
            'summary' => 'The admin team checks the property, owner identity and listing quality before tenants can discover it.',
            'points' => ['Listing arrives in the admin review queue', 'Owner KYC and property details are checked', 'Approve or reject with a clear reason', 'Approved rooms become visible to tenants'],
            'detail' => 'Approval protects tenants from incomplete or misleading listings. Rejected listings stay in the owner workspace so the owner can correct the details and resubmit.',
            'visual' => 'approvals',
        ],
        [
            'kicker' => 'Step 03 · Tenant',
            'title' => 'Tenant searches for a room',
            'summary' => 'Tenants search by location, set a budget and filter by room type, amenities and availability.',
            'points' => ['Search by city, area or property name', 'Set minimum and maximum rent', 'Choose room type and amenities', 'Sort by newest, lowest rent or popularity'],
            'detail' => 'Search results are powered by live room data. Every card shows the property, location, rent and key room facts, and opens into a full property detail page.',
            'visual' => 'search',
        ],
        [
            'kicker' => 'Step 04 · Tenant + Owner',
            'title' => 'Tenant contacts the owner',
            'summary' => 'Questions, visit planning and negotiation happen in a direct conversation between tenant and owner.',
            'points' => ['Start a chat from the property page', 'Ask about rent, rules and availability', 'Agree on a convenient visit time', 'Keep every message in the inbox'],
            'detail' => 'The conversation is scoped to the tenant and the property owner, so personal contact details stay private until both sides choose to share them.',
            'visual' => 'chat',
        ],
        [
            'kicker' => 'Step 05 · Booking',
            'title' => 'Booking and payment',
            'summary' => 'The tenant sends a booking request, the owner accepts, and payment unlocks the active tenancy.',
            'points' => ['Tenant selects a move-in date', 'Owner accepts or rejects the request', 'Tenant pays deposit and first month rent', 'Booking becomes active with an agreement'],
            'detail' => 'A room can only have one pending or active booking at a time. When the owner accepts, the room is marked unavailable, an agreement is created and the booking moves into the payment stage.',
            'visual' => 'payment',
        ],
        [
            'kicker' => 'Step 06 · Move-in',
            'title' => 'Move in and review',
            'summary' => 'The agreement is available online, rent is tracked from the dashboard and the tenant can share feedback.',
            'points' => ['Open and review the rental agreement', 'Confirm move-in details with the owner', 'Track rent and payment history', 'Rate the room and owner after move-in'],
            'detail' => 'The tenant dashboard keeps agreements, payments, maintenance requests and conversations together. Owners see the same booking from their side, so both parties always know the latest status.',
            'visual' => 'document',
        ],
    ];
@endphp

<section class="doc-section" id="workflow">
    <div class="doc-wrap">
        <div class="doc-reveal">
            <span class="doc-eyebrow">How RoomDekho works</span>
            <h2 class="doc-title">The complete rental journey,<br><span class="doc-gradient-text">step by step.</span></h2>
            <p class="doc-subtitle">
                Six connected stages take a room from a new listing to a happy move-in. Scroll through the story, or open any step to see what happens behind the scenes.
            </p>
        </div>

        <div class="doc-flow">
            @foreach ($steps as $index => $step)
                <article class="doc-step doc-reveal" id="workflow-step-{{ $index + 1 }}" data-workflow-step>
                    <div class="doc-step-num">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                    <div class="doc-step-body">
                        <div>
                            <span class="doc-step-kicker">{{ $step['kicker'] }}</span>
                            <h3>{{ $step['title'] }}</h3>
                            <p>{{ $step['summary'] }}</p>
                            <ul class="doc-step-points">
                                @foreach ($step['points'] as $point)
                                    <li>
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.6" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                        {{ $point }}
                                    </li>
                                @endforeach
                            </ul>

                            <button type="button" class="doc-step-toggle" data-step-toggle aria-expanded="false" aria-controls="step-detail-{{ $index + 1 }}">
                                <span data-step-label>Learn more</span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M6 9l6 6 6-6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </button>
                            <div class="doc-step-detail" id="step-detail-{{ $index + 1 }}">
                                <p><strong>How it works:</strong> {{ $step['detail'] }}</p>
                            </div>
                        </div>

                        <div class="doc-step-visual">
                            <x-docs.visual :type="$step['visual']" />
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
