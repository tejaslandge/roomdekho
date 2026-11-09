@php
    $ownerGuides = [
        ['title' => 'Register as an owner', 'description' => 'Create an owner account to unlock the listing workspace, tenant enquiries and booking controls.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'owner'],
        ['title' => 'Complete identity verification', 'description' => 'Submit your Aadhaar and PAN or driving licence. Verified owners can add properties and rooms.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'kyc'],
        ['title' => 'Add a property', 'description' => 'Add the property title, city, area, full address and a clear description that helps tenants understand the home.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'listing'],
        ['title' => 'Upload property photos', 'description' => 'Add real photos of the building, entrance, common areas and surroundings to build trust before a visit.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'photos'],
        ['title' => 'Add rooms to the property', 'description' => 'Create each rentable room under the property with its room type and a helpful description.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'details'],
        ['title' => 'Set rent and availability', 'description' => 'Choose the monthly rent, electricity type, water source and availability so tenants see accurate pricing.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'price'],
        ['title' => 'Select amenities', 'description' => 'Highlight the facilities that matter to tenants, such as parking, power backup, water supply and security.', 'tag' => 'Guide', 'tone' => 'guide', 'visual' => 'amenities'],
        ['title' => 'Submit the listing for approval', 'description' => 'Send the completed property to the admin team. Approved listings become visible in tenant search results.', 'tag' => 'Guide', 'tone' => 'guide', 'visual' => 'submit'],
        ['title' => 'Manage enquiries', 'description' => 'See new tenant questions in one inbox and keep track of which conversations need a reply.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'inbox'],
        ['title' => 'Respond to tenants', 'description' => 'Answer questions, share visit details and agree on next steps without losing the conversation history.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'reply'],
        ['title' => 'Approve or reject bookings', 'description' => 'Review each booking request and accept or decline it. Accepting marks the room unavailable and creates an agreement.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'approve'],
        ['title' => 'Track your earnings', 'description' => 'Follow rent payments, deposits and booking income from the owner payments dashboard.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'earnings'],
        ['title' => 'Manage agreements', 'description' => 'Open the agreement attached to each accepted booking and keep tenancy terms in one place.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'agreement'],
        ['title' => 'Build your reputation', 'description' => 'Fast replies, accurate listings and smooth move-ins lead to better reviews and more booking requests.', 'tag' => 'Guide', 'tone' => 'guide', 'visual' => 'rating'],
    ];
@endphp

<div class="doc-guide-section" id="owner-guide" data-guide-section>
    <div class="doc-guide-head">
        <div>
            <span class="doc-guide-badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M3 21h18M5 21V8l7-5 7 5v13M9 21v-6h6v6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Owner guide
            </span>
            <h2>Turn a property into a thriving rental</h2>
            <p>Set up your listings, respond to demand and manage every accepted booking.</p>
        </div>
        <span class="doc-guide-badge">{{ count($ownerGuides) }} steps</span>
    </div>

    <div class="doc-guide-grid">
        @foreach ($ownerGuides as $index => $guide)
            <x-docs.guide-card
                :title="$guide['title']"
                :description="$guide['description']"
                :tag="$guide['tag']"
                :tone="$guide['tone']"
                style="transition-delay: {{ min($index * 35, 350) }}ms"
            >
                <x-docs.visual :type="$guide['visual']" />
            </x-docs.guide-card>
        @endforeach
    </div>
</div>
