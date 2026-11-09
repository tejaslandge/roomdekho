@php
    $tenantGuides = [
        ['title' => 'Create your tenant account', 'description' => 'Register with your name, email and phone number, then choose the Tenant role to unlock the renter experience.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'account'],
        ['title' => 'Sign in securely', 'description' => 'Log in to return to your saved rooms, conversations, bookings and payment history from any device.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'login'],
        ['title' => 'Search properties', 'description' => 'Search by city, area or property name from the home page or the Find Rooms page to see matching listings.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'search'],
        ['title' => 'Apply smart filters', 'description' => 'Narrow the results by room type, minimum and maximum rent, amenities and sort order to find your fit faster.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'filters'],
        ['title' => 'View property details', 'description' => 'Open a listing to review rent, room type, electricity, water source, amenities, photos and owner information.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'details'],
        ['title' => 'Save favourite properties', 'description' => 'Tap the heart on any room to build a shortlist that stays available in your tenant dashboard.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'save'],
        ['title' => 'Compare shortlisted rooms', 'description' => 'Put saved rooms side by side on rent, location and amenities so the trade-offs are easy to see.', 'tag' => 'Guide', 'tone' => 'guide', 'visual' => 'compare'],
        ['title' => 'Contact the property owner', 'description' => 'Send an enquiry from the property page without sharing your personal phone number in public.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'contact'],
        ['title' => 'Chat with the owner', 'description' => 'Ask about rules, deposits, housekeeping and availability. Every reply stays organised in your inbox.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'chat'],
        ['title' => 'Schedule a property visit', 'description' => 'Agree on a date and time with the owner in chat, then confirm the visit before you travel.', 'tag' => 'Guide', 'tone' => 'guide', 'visual' => 'visit'],
        ['title' => 'Request a booking', 'description' => 'Choose your move-in date and send a booking request. The room is held while the owner reviews it.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'booking'],
        ['title' => 'Complete your payment', 'description' => 'Pay the security deposit and first month rent from the rent page, then keep the receipt in your account.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'payment'],
        ['title' => 'Track your booking', 'description' => 'Follow the booking from request to approval, payment and active tenancy from your dashboard.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'track'],
        ['title' => 'Download the rental agreement', 'description' => 'Open the agreement generated for your accepted booking, review the terms and keep a copy for your records.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'document'],
        ['title' => 'Write a review', 'description' => 'After move-in, rate the room and owner and share a short note to help the next tenant choose confidently.', 'tag' => 'Guide', 'tone' => 'guide', 'visual' => 'review'],
    ];
@endphp

<div class="doc-guide-section" id="tenant-guide" data-guide-section>
    <div class="doc-guide-head">
        <div>
            <span class="doc-guide-badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 016.5 17H20M4 19.5V5a2 2 0 012-2h12a2 2 0 012 2v12H6.5A2.5 2.5 0 004 19.5z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Tenant guide
            </span>
            <h2>From first search to move-in day</h2>
            <p>Everything a tenant can do on RoomDekho, in the order you will use it.</p>
        </div>
        <span class="doc-guide-badge">{{ count($tenantGuides) }} steps</span>
    </div>

    <div class="doc-guide-grid">
        @foreach ($tenantGuides as $index => $guide)
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
