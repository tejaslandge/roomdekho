@php
    $faqs = [
        ['q' => 'Is RoomDekho free for tenants?', 'a' => 'Yes. Creating a tenant account, searching rooms, saving favourites and chatting with owners are free. Rent, security deposit and any applicable charges are shown before you confirm a booking.'],
        ['q' => 'How do I know a listing is genuine?', 'a' => 'Owners complete identity verification before listing, and admins can review listings and accounts. Keep conversations and bookings inside RoomDekho so there is a clear record of what was agreed.'],
        ['q' => 'How do I schedule a property visit?', 'a' => 'Open the property page, start a chat with the owner and agree on a convenient date and time. Confirm the visit before travelling and check the address and contact details in your conversation.'],
        ['q' => 'How does the payment step work?', 'a' => 'After the owner accepts your booking request, pay the security deposit and first month rent from the Rent & Payments area. The payment is recorded against your booking and appears in your payment history.'],
        ['q' => 'When is the rental agreement created?', 'a' => 'When an owner accepts a booking, it becomes active, the room is marked unavailable and an agreement is generated for that booking. You can open it from the agreements area of your dashboard.'],
        ['q' => 'Can an owner reject a booking request?', 'a' => 'Yes. An owner can accept or decline a request. If the request is declined, the room stays available and you can continue searching or contact the owner to discuss alternatives.'],
        ['q' => 'What should I do if I cannot log in?', 'a' => 'Use the “Forgot password” link on the login page and follow the reset instructions. If your account still needs email verification, use the verification link sent to your registered email address.'],
        ['q' => 'How do I list my property?', 'a' => 'Create an owner account, complete identity verification, add your property details and rooms, upload photos and submit the listing for review. Once approved, tenants can discover it in search.'],
    ];
@endphp

<section class="doc-section" id="faq">
    <div class="doc-wrap">
        <div class="doc-reveal">
            <span class="doc-eyebrow">Frequently asked</span>
            <h2 class="doc-title">Quick answers,<br><span class="doc-gradient-text">before you begin.</span></h2>
        </div>

        <div class="doc-faq-wrap">
            <div class="doc-reveal">
                <p class="doc-subtitle" style="margin-bottom:1.4rem;">
                    Still curious? Start with the journey that matches you — tenant, owner or admin — or jump into the live platform and explore at your own pace.
                </p>
                <div style="border:1px solid #eee9f9;background:linear-gradient(145deg,#fbfaff,#f7f2ff);border-radius:1.5rem;padding:1.4rem;">
                    <div class="flex items-center gap-3 mb-3">
                        <div style="width:42px;height:42px;border-radius:.9rem;background:#fff;border:1px solid #e8dfff;display:grid;place-items:center;color:#7c5ce5;">
                            <svg width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M8 10h8M8 14h5M21 12a9 9 0 11-4.5-7.79L21 3l-.5 4.5A8.96 8.96 0 0121 12z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <div>
                            <p style="font-weight:800;font-size:.9rem;color:#3b2f67;">Need a human answer?</p>
                            <p style="font-size:.72rem;color:#8b8aa0;">Use in-app chat for listing questions.</p>
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('rooms.search') }}" class="doc-btn doc-btn-primary doc-btn-sm">Browse rooms</a>
                        @guest
                            <a href="{{ route('register') }}" class="doc-btn doc-btn-ghost doc-btn-sm">Create account</a>
                        @else
                            <a href="{{ url('/dashboard') }}" class="doc-btn doc-btn-ghost doc-btn-sm">Go to dashboard</a>
                        @endguest
                    </div>
                </div>
            </div>

            <div>
                @foreach ($faqs as $index => $faq)
                    <details class="doc-faq doc-reveal" @if ($index === 0) open @endif>
                        <summary>
                            <span>{{ $faq['q'] }}</span>
                            <span aria-hidden="true">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 5v14M5 12h14" stroke-linecap="round"/></svg>
                            </span>
                        </summary>
                        <p>{{ $faq['a'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </div>
</section>
