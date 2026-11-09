@php
    $adminGuides = [
        ['title' => 'Monitor the platform', 'description' => 'Start every day with a live view of users, listings, bookings, payments and platform health.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'monitor'],
        ['title' => 'Manage users and roles', 'description' => 'Search, review and update tenant, owner and admin accounts while keeping role access tightly scoped.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'users'],
        ['title' => 'Verify identities', 'description' => 'Review submitted Aadhaar and PAN or driving licence documents and approve or reject verification requests.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'kyc'],
        ['title' => 'Approve property listings', 'description' => 'Check listing accuracy, owner verification and room quality before making a property visible to tenants.', 'tag' => 'Guide', 'tone' => 'guide', 'visual' => 'approvals'],
        ['title' => 'Oversee bookings', 'description' => 'Follow every booking request from pending to active, and step in when a room or booking needs attention.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'track'],
        ['title' => 'Track payments', 'description' => 'Review payment records against bookings and keep a clear audit trail for every completed transaction.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'ledger'],
        ['title' => 'Handle refunds', 'description' => 'Review refund requests, confirm the original payment and record the resolution against the booking.', 'tag' => 'Guide', 'tone' => 'guide', 'visual' => 'refund'],
        ['title' => 'Review reports', 'description' => 'Use booking, revenue and user reports to understand growth and spot marketplace friction early.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'reports'],
        ['title' => 'Configure platform settings', 'description' => 'Update the public platform name, support email, booking rules, maintenance mode and payment status.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'settings'],
        ['title' => 'Protect the platform', 'description' => 'Role-based middleware, verified accounts and owner-scoped data keep each dashboard limited to the right people.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'shield'],
        ['title' => 'Monitor maintenance', 'description' => 'Track maintenance requests raised against active rooms and keep owners and tenants aligned on resolution.', 'tag' => 'Live', 'tone' => 'live', 'visual' => 'maintenance'],
    ];
@endphp

<div class="doc-guide-section" id="admin-guide" data-guide-section>
    <div class="doc-guide-head">
        <div>
            <span class="doc-guide-badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 3l7 4v5c0 4.5-3 8-7 9-4-1-7-4.5-7-9V7l7-4z" stroke-linejoin="round"/><path d="M9.5 12l1.8 1.8 3.4-3.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Admin guide
            </span>
            <h2>Keep the marketplace healthy</h2>
            <p>The controls that protect quality, trust and smooth operations across RoomDekho.</p>
        </div>
        <span class="doc-guide-badge">{{ count($adminGuides) }} steps</span>
    </div>

    <div class="doc-guide-grid">
        @foreach ($adminGuides as $index => $guide)
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
