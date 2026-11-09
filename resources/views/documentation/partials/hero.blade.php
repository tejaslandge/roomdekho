@php
    $tenantGuideCount = 15;
    $ownerGuideCount = 14;
    $adminGuideCount = 11;
@endphp

<section class="doc-hero">
    <div class="doc-wrap doc-hero-grid">
        <div class="doc-reveal is-visible">
            <span class="doc-eyebrow">RoomDekho product tour</span>
            <h1>Discover How <span class="doc-gradient-text">RoomDekho</span> Works</h1>
            <p class="doc-hero-lead">
                Your complete visual guide to finding rooms, managing properties, and building better rental experiences.
            </p>

            <div class="doc-hero-actions">
                <a href="{{ route('rooms.search') }}" class="doc-btn doc-btn-primary">
                    Explore Platform
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true">
                        <path d="M5 12h14M13 6l6 6-6 6" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <a href="#guides" class="doc-btn doc-btn-ghost">
                    Explore User Guides
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" aria-hidden="true">
                        <path d="M12 5v14M5 12l7 7 7-7" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
            </div>

            <div class="doc-hero-chips">
                <span class="doc-chip">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Verified listings
                </span>
                <span class="doc-chip">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M12 3l7 4v5c0 4.5-3 8-7 9-4-1-7-4.5-7-9V7l7-4z" stroke-linejoin="round"/></svg>
                    Role-based access
                </span>
                <span class="doc-chip">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h10" stroke-linecap="round"/></svg>
                    Guided journeys
                </span>
            </div>

            <div class="doc-hero-metrics" aria-label="Documentation at a glance">
                <div class="doc-hero-metric"><strong>3</strong><span>User roles</span></div>
                <div class="doc-hero-metric"><strong>6</strong><span>Workflow steps</span></div>
                <div class="doc-hero-metric"><strong>{{ $tenantGuideCount + $ownerGuideCount + $adminGuideCount }}</strong><span>Visual guides</span></div>
            </div>
        </div>

        <div class="doc-hero-art doc-reveal is-visible">
            <div class="doc-hero-badge doc-hero-badge--top">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M4 6h16v10H7l-3 3V6z" stroke-linejoin="round"/></svg>
                Owner replied
            </div>
            <div class="doc-hero-badge doc-hero-badge--bottom">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Booking verified
            </div>

            <svg class="doc-hero-svg" viewBox="0 0 880 600" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="docHeroTitle docHeroDesc">
                <title id="docHeroTitle">A tenant searching for a room, connecting with an owner, booking and paying, then moving in</title>
                <desc id="docHeroDesc">Animated illustration of the RoomDekho rental journey from search to move-in.</desc>
                <defs>
                    <filter id="docHeroShadow" x="-30%" y="-30%" width="160%" height="170%">
                        <feDropShadow dx="0" dy="14" stdDeviation="16" flood-color="#5B4A91" flood-opacity=".14"/>
                    </filter>
                    <linearGradient id="docHeroScreen" x1="300" y1="100" x2="610" y2="390" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#FFFFFF"/>
                        <stop offset="1" stop-color="#FBFAFF"/>
                    </linearGradient>
                    <linearGradient id="docHeroHouse" x1="540" y1="420" x2="680" y2="540" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#C4B5FD"/>
                        <stop offset=".55" stop-color="#A78BFA"/>
                        <stop offset="1" stop-color="#F9A8D4"/>
                    </linearGradient>
                    <linearGradient id="docHeroChip" x1="130" y1="430" x2="420" y2="500" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#8B5CF6"/>
                        <stop offset="1" stop-color="#F472B6"/>
                    </linearGradient>
                </defs>

                <rect x="12" y="12" width="856" height="576" rx="34" fill="#FBFAFF"/>
                <circle cx="160" cy="110" r="104" fill="#EAF2FF" fill-opacity=".75"/>
                <circle cx="714" cy="128" r="118" fill="#FDF2F8" fill-opacity=".9"/>
                <circle cx="452" cy="512" r="150" fill="#F3EFFF" fill-opacity=".8"/>
                <path d="M42 470c120-46 200 24 296-24s142-100 250-72 170 22 240-30" stroke="#EEE9F8" stroke-width="1.4" stroke-dasharray="5 8"/>

                {{-- Journey route --}}
                <path d="M214 296h84" stroke="#C4B5FD" stroke-width="2.4" stroke-linecap="round" class="h-route"/>
                <path d="M612 298c42 0 26 82 74 82h38" stroke="#C4B5FD" stroke-width="2.4" stroke-linecap="round" class="h-route" style="animation-delay:2.4s"/>
                <path d="M470 396v34" stroke="#C4B5FD" stroke-width="2.4" stroke-linecap="round" stroke-dasharray="5 7"/>

                {{-- Tenant --}}
                <g class="h-float">
                    <circle cx="160" cy="242" r="25" fill="#FDE7D7"/>
                    <path d="M137 238c0-18 11-29 23-29s23 11 23 29c-7-5-15-7-23-7s-16 2-23 7z" fill="#6D4BD8"/>
                    <circle cx="151" cy="244" r="2.2" fill="#4C3A85"/>
                    <circle cx="169" cy="244" r="2.2" fill="#4C3A85"/>
                    <path d="M153 253c4 3 10 3 14 0" stroke="#BE3D80" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M128 306c0-30 14-42 32-42s32 12 32 42v14h-64v-14z" fill="#A78BFA"/>
                    <path d="M142 278c-9 8-14 20-14 34" stroke="#8B5CF6" stroke-width="8" stroke-linecap="round"/>
                    <path d="M180 276c9 7 12 16 12 24" stroke="#8B5CF6" stroke-width="8" stroke-linecap="round"/>
                    <rect x="132" y="318" width="56" height="8" rx="4" fill="#8B5CF6" fill-opacity=".22"/>
                </g>

                {{-- Search magnifier moving toward the listings --}}
                <g class="h-search">
                    <circle cx="204" cy="278" r="13" fill="#fff" stroke="#7C5CE5" stroke-width="3"/>
                    <path d="M214 288l12 12" stroke="#7C5CE5" stroke-width="3.2" stroke-linecap="round"/>
                    <circle cx="204" cy="278" r="13" fill="none" stroke="#C4B5FD" stroke-width="1.4"/>
                </g>

                {{-- Browser / listing screen --}}
                <g filter="url(#docHeroShadow)">
                    <rect x="300" y="104" width="310" height="292" rx="24" fill="url(#docHeroScreen)" stroke="#EEE9F8"/>
                    <path d="M300 128c0-13 11-24 24-24h262c13 0 24 11 24 24v28H300v-28z" fill="#F7F3FF"/>
                    <circle cx="322" cy="128" r="4" fill="#F9A8D4"/>
                    <circle cx="336" cy="128" r="4" fill="#FCD34D"/>
                    <circle cx="350" cy="128" r="4" fill="#6EE7B7"/>
                    <rect x="368" y="120" width="176" height="16" rx="8" fill="#fff" stroke="#EEE9F8"/>
                    <text x="380" y="131" fill="#A9A2BE" font-size="7.5" font-weight="600">roomdekho.in / find-rooms</text>

                    <rect x="322" y="176" width="266" height="36" rx="12" fill="#fff" stroke="#E9E3F7"/>
                    <circle cx="342" cy="194" r="6.5" stroke="#8B5CF6" stroke-width="2"/>
                    <path d="M347 199l5 5" stroke="#8B5CF6" stroke-width="2" stroke-linecap="round"/>
                    <text x="360" y="197" fill="#9B96AE" font-size="8.5">Search by city, area or property</text>
                    <rect x="512" y="184" width="66" height="20" rx="8" fill="#A78BFA"/>
                    <text x="527" y="197" fill="#fff" font-size="7.5" font-weight="800">SEARCH</text>

                    {{-- Property card 1 --}}
                    <g class="h-card">
                        <rect x="322" y="230" width="126" height="76" rx="12" fill="#fff" stroke="#EEE9F8"/>
                        <rect x="330" y="238" width="46" height="34" rx="7" fill="#EAF2FF"/>
                        <path d="M336 266l10-12 8 8 6-5 12 9v4h-36z" fill="#93C5FD"/>
                        <rect x="384" y="240" width="52" height="6" rx="3" fill="#D8D2E8"/>
                        <rect x="384" y="252" width="38" height="5" rx="2.5" fill="#ECE8F7"/>
                        <text x="384" y="278" fill="#6D4BD8" font-size="10" font-weight="800">₹8,500</text>
                        <text x="420" y="278" fill="#A9A2BE" font-size="6.5">/mo</text>
                        <rect x="330" y="286" width="30" height="10" rx="5" fill="#F3EFFF"/>
                        <rect x="366" y="286" width="36" height="10" rx="5" fill="#FDF2F8"/>
                    </g>

                    {{-- Property card 2 --}}
                    <g class="h-card" style="animation-delay:.18s">
                        <rect x="462" y="230" width="126" height="76" rx="12" fill="#fff" stroke="#EEE9F8"/>
                        <rect x="470" y="238" width="46" height="34" rx="7" fill="#FDF2F8"/>
                        <path d="M476 266l10-12 8 8 6-5 12 9v4h-36z" fill="#F9A8D4"/>
                        <rect x="524" y="240" width="52" height="6" rx="3" fill="#D8D2E8"/>
                        <rect x="524" y="252" width="38" height="5" rx="2.5" fill="#ECE8F7"/>
                        <text x="524" y="278" fill="#BE3D80" font-size="10" font-weight="800">₹6,200</text>
                        <text x="560" y="278" fill="#A9A2BE" font-size="6.5">/mo</text>
                        <rect x="470" y="286" width="36" height="10" rx="5" fill="#F3EFFF"/>
                        <rect x="512" y="286" width="30" height="10" rx="5" fill="#FDF2F8"/>
                    </g>

                    {{-- Property card 3 --}}
                    <g class="h-card" style="animation-delay:.36s">
                        <rect x="322" y="318" width="126" height="56" rx="12" fill="#fff" stroke="#EEE9F8"/>
                        <rect x="330" y="326" width="38" height="28" rx="7" fill="#F3EFFF"/>
                        <path d="M336 348l8-9 6 7 5-4 8 6v4h-27z" fill="#C4B5FD"/>
                        <rect x="376" y="328" width="52" height="6" rx="3" fill="#D8D2E8"/>
                        <rect x="376" y="340" width="40" height="5" rx="2.5" fill="#ECE8F7"/>
                        <text x="376" y="360" fill="#6D4BD8" font-size="9" font-weight="800">₹11,000</text>
                    </g>

                    <g class="h-card" style="animation-delay:.5s">
                        <rect x="462" y="318" width="126" height="56" rx="12" fill="#F8F6FF" stroke="#EEE9F8"/>
                        <circle cx="486" cy="342" r="12" fill="#F3EFFF"/>
                        <path d="M481 342l4 4 7-8" stroke="#8B5CF6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <rect x="506" y="332" width="66" height="6" rx="3" fill="#D8D2E8"/>
                        <rect x="506" y="344" width="48" height="5" rx="2.5" fill="#ECE8F7"/>
                        <rect x="506" y="356" width="30" height="8" rx="4" fill="#ECFDF5"/>
                    </g>
                </g>

                {{-- Owner --}}
                <g class="h-float" style="animation-delay:.7s">
                    <circle cx="724" cy="246" r="26" fill="#FDE7D7"/>
                    <path d="M700 242c0-19 11-30 24-30s24 11 24 30c-7-5-15-7-24-7s-17 2-24 7z" fill="#4C3A85"/>
                    <circle cx="715" cy="248" r="2.2" fill="#4C3A85"/>
                    <circle cx="733" cy="248" r="2.2" fill="#4C3A85"/>
                    <path d="M717 257c4 3 10 3 14 0" stroke="#BE3D80" stroke-width="1.8" stroke-linecap="round"/>
                    <path d="M692 312c0-31 14-44 32-44s32 13 32 44v14h-64v-14z" fill="#F9A8D4"/>
                    <path d="M706 284c-8 7-11 15-11 24" stroke="#F472B6" stroke-width="8" stroke-linecap="round"/>
                    <path d="M743 282c9 7 12 18 12 28" stroke="#F472B6" stroke-width="8" stroke-linecap="round"/>
                    <rect x="696" y="326" width="56" height="8" rx="4" fill="#F472B6" fill-opacity=".22"/>
                </g>

                <g class="h-enquiry">
                    <rect x="636" y="96" width="164" height="46" rx="14" fill="#fff" stroke="#EEE9F8" filter="url(#docHeroShadow)"/>
                    <circle cx="660" cy="119" r="12" fill="#ECFDF5"/>
                    <path d="M655 119l4 4 7-8" stroke="#10B981" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    <text x="680" y="115" fill="#4C3A85" font-size="9" font-weight="800">New enquiry</text>
                    <text x="680" y="128" fill="#A9A2BE" font-size="7.5">Tenant is interested</text>
                    <circle cx="790" cy="111" r="4" fill="#F472B6" class="h-float"/>
                </g>

                {{-- Booking chip --}}
                <g class="h-booking">
                    <rect x="130" y="430" width="172" height="58" rx="16" fill="#fff" stroke="#EEE9F8" filter="url(#docHeroShadow)"/>
                    <rect x="142" y="442" width="34" height="34" rx="10" fill="#F3EFFF"/>
                    <rect x="151" y="450" width="16" height="16" rx="4" stroke="#8B5CF6" stroke-width="1.8"/>
                    <path d="M155 454h8M155 458h8M155 462h5" stroke="#8B5CF6" stroke-width="1.4" stroke-linecap="round"/>
                    <text x="186" y="456" fill="#4C3A85" font-size="9" font-weight="800">Booking confirmed</text>
                    <text x="186" y="469" fill="#A9A2BE" font-size="7.5">Owner accepted your request</text>
                </g>

                {{-- Payment chip --}}
                <g class="h-payment">
                    <rect x="306" y="458" width="172" height="58" rx="16" fill="#fff" stroke="#EEE9F8" filter="url(#docHeroShadow)"/>
                    <rect x="318" y="470" width="34" height="34" rx="10" fill="#ECFDF5"/>
                    <rect x="326" y="480" width="18" height="12" rx="3" stroke="#10B981" stroke-width="1.8"/>
                    <path d="M326 484h18" stroke="#10B981" stroke-width="1.8"/>
                    <circle cx="344" cy="495" r="5" fill="#10B981"/>
                    <path d="M341.5 495l1.8 1.8 3.2-3.6" stroke="#fff" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/>
                    <text x="362" y="484" fill="#4C3A85" font-size="9" font-weight="800">Payment verified</text>
                    <text x="362" y="497" fill="#A9A2BE" font-size="7.5">Deposit + first month</text>
                </g>

                {{-- House / move-in --}}
                <g class="h-house">
                    <circle cx="612" cy="486" r="70" fill="#A78BFA" fill-opacity=".16" class="h-glow"/>
                    <path d="M548 480l64-50 64 50v62h-48v-38h-32v38h-48v-62z" fill="url(#docHeroHouse)"/>
                    <path d="M548 480l64-50 64 50" stroke="#7C5CE5" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                    <rect x="598" y="504" width="28" height="38" rx="4" fill="#fff" fill-opacity=".88"/>
                    <rect x="562" y="488" width="22" height="22" rx="5" fill="#fff" fill-opacity=".82"/>
                    <path d="M566 499h14M573 492v14" stroke="#A78BFA" stroke-width="1.8" stroke-linecap="round"/>
                    <circle cx="652" cy="468" r="18" fill="#10B981"/>
                    <path d="M644 468l5 5 10-11" stroke="#fff" stroke-width="2.6" stroke-linecap="round" stroke-linejoin="round"/>
                    <text x="580" y="566" fill="#6D4BD8" font-size="10" font-weight="800">Move-in ready</text>
                </g>
            </svg>
        </div>
    </div>
</section>
