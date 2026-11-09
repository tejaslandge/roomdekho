<section class="doc-section" id="trust">
    <div class="doc-wrap">
        <div class="doc-reveal">
            <span class="doc-eyebrow">Trust &amp; safety</span>
            <h2 class="doc-title">Trust is built into<br><span class="doc-gradient-text">every step.</span></h2>
            <p class="doc-subtitle">
                RoomDekho is designed around verified people, protected data and predictable booking outcomes. Here is what keeps the marketplace accountable.
            </p>
        </div>

        <div class="doc-trust-grid">
            <article class="doc-trust-card doc-reveal">
                <div class="doc-trust-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 3l7 4v5c0 4.5-3 8-7 9-4-1-7-4.5-7-9V7l7-4z" stroke-linejoin="round"/><path d="M9.5 12l1.8 1.8 3.4-3.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <h3>Verified identities</h3>
                <p>Owners submit Aadhaar and PAN or driving licence documents. Admins review each request before verification.</p>
            </article>

            <article class="doc-trust-card doc-reveal" style="transition-delay:60ms;">
                <div class="doc-trust-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h10" stroke-linecap="round"/><circle cx="19" cy="18" r="2"/></svg>
                </div>
                <h3>Role-scoped dashboards</h3>
                <p>Tenant, owner and admin areas are protected by role middleware. Each account only reaches the tools it needs.</p>
            </article>

            <article class="doc-trust-card doc-reveal" style="transition-delay:120ms;">
                <div class="doc-trust-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M3 21h18M5 21V8l7-5 7 5v13M9 21v-6h6v6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <h3>Owner-controlled listings</h3>
                <p>Only the owner who created a property can edit its rooms. Cross-account access is blocked on the server.</p>
            </article>

            <article class="doc-trust-card doc-reveal" style="transition-delay:180ms;">
                <div class="doc-trust-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="4" y="5" width="16" height="16" rx="3"/><path d="M8 3v4M16 3v4M8 11h8M8 15h5" stroke-linecap="round"/></svg>
                </div>
                <h3>Booking integrity</h3>
                <p>Room availability is locked during booking creation, so two tenants cannot confirm the same room at the same time.</p>
            </article>

            <article class="doc-trust-card doc-reveal">
                <div class="doc-trust-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><rect x="3" y="6" width="18" height="13" rx="3"/><path d="M3 10h18M7 15h4" stroke-linecap="round"/></svg>
                </div>
                <h3>Payment records</h3>
                <p>Every payment is stored against a booking with its method, amount, status, transaction reference and paid date.</p>
            </article>

            <article class="doc-trust-card doc-reveal" style="transition-delay:60ms;">
                <div class="doc-trust-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M7 3h7l4 4v14H7V3z" stroke-linejoin="round"/><path d="M14 3v4h4M10 12h5M10 16h5" stroke-linecap="round"/></svg>
                </div>
                <h3>Agreement trail</h3>
                <p>When an owner accepts a booking, an agreement is created and linked to the tenant, owner and booking dates.</p>
            </article>

            <article class="doc-trust-card doc-reveal" style="transition-delay:120ms;">
                <div class="doc-trust-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M14 6a5 5 0 00-6 6L3 17l4 4 5-5a5 5 0 006-6l-3 3-3-3 3-3z" stroke-linejoin="round"/></svg>
                </div>
                <h3>Maintenance accountability</h3>
                <p>Tenants raise room-specific requests while owners and admins track status from open to resolved.</p>
            </article>

            <article class="doc-trust-card doc-reveal" style="transition-delay:180ms;">
                <div class="doc-trust-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 19V5M4 19h16M8 15l4-5 3 3 5-7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <h3>Admin oversight</h3>
                <p>Admins can review users, payments, bookings, reports and platform settings from a single command centre.</p>
            </article>
        </div>

        <div class="doc-reveal" style="margin-top:2rem;border:1px solid #eee9f9;background:#fff;border-radius:1.8rem;padding:1.4rem;box-shadow:0 12px 34px rgba(92,66,160,.05);">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <span class="doc-eyebrow">Payment journey</span>
                    <h3 class="font-display font-extrabold text-lg mt-2" style="color:#2a3342;">From booking request to an active tenancy</h3>
                </div>
                <div class="doc-stack" style="margin-top:0;">
                    <span>Booking request</span>
                    <span>Owner approval</span>
                    <span>Payment recorded</span>
                    <span>Agreement active</span>
                </div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-4">
                @foreach ([['01', 'Request', 'Tenant picks a move-in date'], ['02', 'Approve', 'Owner accepts the request'], ['03', 'Pay', 'Deposit + first month rent'], ['04', 'Activate', 'Room locked and agreement created']] as $item)
                    <div style="border:1px solid #f0ecf9;background:#fbfaff;border-radius:1rem;padding:.85rem;">
                        <span style="font-size:.62rem;font-weight:800;letter-spacing:.1em;color:#a78bfa;">{{ $item[0] }}</span>
                        <p style="font-weight:800;font-size:.82rem;color:#3b2f67;margin-top:.2rem;">{{ $item[1] }}</p>
                        <p style="font-size:.7rem;color:#8b8aa0;line-height:1.5;margin-top:.2rem;">{{ $item[2] }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="doc-stack" aria-label="Technology stack">
            <span>Laravel 12</span>
            <span>MySQL</span>
            <span>Blade templates</span>
            <span>Vite</span>
            <span>Tailwind CSS</span>
            <span>Alpine.js</span>
            <span>Role middleware</span>
            <span>Responsive SVG</span>
        </div>
    </div>
</section>
