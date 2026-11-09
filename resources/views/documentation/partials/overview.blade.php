<section class="doc-section" id="overview">
    <div class="doc-wrap">
        <div class="doc-overview doc-reveal">
            <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between gap-4">
                <div>
                    <span class="doc-eyebrow">Platform overview</span>
                    <h2 class="doc-title">One platform.<br><span class="doc-gradient-text">Three connected journeys.</span></h2>
                    <p class="doc-subtitle">
                        RoomDekho brings tenants, property owners and administrators into a single rental ecosystem. Every role has its own dashboard, permissions and workflow, connected through one source of truth.
                    </p>
                </div>
                <div class="doc-stack" style="margin-top:0;">
                    <span>Laravel 12</span>
                    <span>MySQL</span>
                    <span>Blade + Vite</span>
                </div>
            </div>

            <div class="doc-role-layout">
                <div class="doc-role-stage">
                    <svg viewBox="0 0 560 380" fill="none" xmlns="http://www.w3.org/2000/svg" role="img" aria-labelledby="docRoleDiagramTitle">
                        <title id="docRoleDiagramTitle">Tenant, owner and admin connected to the RoomDekho platform</title>
                        <defs>
                            <linearGradient id="docRoleCenter" x1="190" y1="150" x2="370" y2="234" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#7C6CF2"/>
                                <stop offset=".55" stop-color="#A78BFA"/>
                                <stop offset="1" stop-color="#F0A3CD"/>
                            </linearGradient>
                            <filter id="docRoleShadow" x="-30%" y="-30%" width="160%" height="170%">
                                <feDropShadow dx="0" dy="10" stdDeviation="12" flood-color="#5B4A91" flood-opacity=".15"/>
                            </filter>
                        </defs>

                        <circle cx="280" cy="190" r="146" fill="#F8F6FF"/>
                        <circle cx="280" cy="190" r="112" fill="none" stroke="#EEE9F8" stroke-dasharray="4 8"/>
                        <circle cx="280" cy="190" r="76" fill="#fff" fill-opacity=".62"/>

                        <path d="M140 116L232 168" stroke="#C4B5FD" stroke-width="2.4" stroke-linecap="round" class="doc-dash-line"/>
                        <path d="M420 116L348 168" stroke="#F9A8D4" stroke-width="2.4" stroke-linecap="round" class="doc-dash-line"/>
                        <path d="M280 262v-24" stroke="#93C5FD" stroke-width="2.4" stroke-linecap="round" class="doc-dash-line"/>

                        <g filter="url(#docRoleShadow)">
                            <rect x="190" y="150" width="180" height="86" rx="24" fill="url(#docRoleCenter)"/>
                            <rect x="205" y="165" width="34" height="34" rx="11" fill="#fff" fill-opacity=".92"/>
                            <text x="216" y="189" fill="#6D4BD8" font-family="Outfit, Inter, sans-serif" font-size="19" font-weight="800">R</text>
                            <text x="250" y="181" fill="#fff" font-family="Outfit, Inter, sans-serif" font-size="13" font-weight="800">RoomDekho</text>
                            <text x="250" y="197" fill="#fff" fill-opacity=".82" font-size="7.5" font-weight="600">Rental operating system</text>
                            <rect x="250" y="206" width="86" height="14" rx="7" fill="#fff" fill-opacity=".18"/>
                            <circle cx="259" cy="213" r="2.5" fill="#A7F3D0"/>
                            <text x="266" y="216" fill="#fff" font-size="6.5" font-weight="700">All roles connected</text>
                        </g>

                        <g class="doc-role-node is-active" data-role="tenant" tabindex="0" role="button" aria-label="Explore the tenant workflow" aria-pressed="true">
                            <circle cx="92" cy="92" r="55" fill="#F3EFFF" class="doc-role-halo"/>
                            <circle cx="92" cy="92" r="42" fill="#fff" stroke="#D9CBF8" stroke-width="1.6"/>
                            <circle cx="92" cy="84" r="11" fill="#EDE7FF"/>
                            <path d="M80 104c3-10 21-10 24 0" fill="#8B5CF6" fill-opacity=".55"/>
                            <circle cx="92" cy="84" r="5" fill="#8B5CF6"/>
                            <path d="M88 121l-3 7 7-4 7 4-3-7" fill="#A78BFA"/>
                            <text x="92" y="158" text-anchor="middle" fill="#4C3A85" font-size="10" font-weight="800" class="doc-role-label">TENANT</text>
                        </g>

                        <g class="doc-role-node" data-role="owner" tabindex="0" role="button" aria-label="Explore the owner workflow" aria-pressed="false">
                            <circle cx="468" cy="92" r="55" fill="#FDF2F8" class="doc-role-halo"/>
                            <circle cx="468" cy="92" r="42" fill="#fff" stroke="#F7D6E6" stroke-width="1.6"/>
                            <circle cx="468" cy="84" r="11" fill="#FDE7F3"/>
                            <path d="M456 104c3-10 21-10 24 0" fill="#F472B6" fill-opacity=".55"/>
                            <circle cx="468" cy="84" r="5" fill="#F472B6"/>
                            <path d="M456 120l12 8 12-8" stroke="#F472B6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <text x="468" y="158" text-anchor="middle" fill="#4C3A85" font-size="10" font-weight="800" class="doc-role-label">OWNER</text>
                        </g>

                        <g class="doc-role-node" data-role="admin" tabindex="0" role="button" aria-label="Explore the admin workflow" aria-pressed="false">
                            <circle cx="280" cy="306" r="55" fill="#EAF2FF" class="doc-role-halo"/>
                            <circle cx="280" cy="306" r="42" fill="#fff" stroke="#CFE2FF" stroke-width="1.6"/>
                            <path d="M280 284l14 6v13c0 10-7 17-14 20-7-3-14-10-14-20v-13l14-6z" fill="#EAF2FF" stroke="#60A5FA" stroke-width="1.5"/>
                            <path d="M274 304l4 4 8-9" stroke="#60A5FA" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            <text x="280" y="372" text-anchor="middle" fill="#4C3A85" font-size="10" font-weight="800" class="doc-role-label">ADMIN</text>
                        </g>
                    </svg>
                </div>

                <div class="doc-role-panel">
                    <div class="doc-role-pane is-active" data-role-pane="tenant">
                        <div class="doc-role-pane-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M4 19.5A2.5 2.5 0 016.5 17H20M4 19.5V5a2 2 0 012-2h12a2 2 0 012 2v12H6.5A2.5 2.5 0 004 19.5z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <h3>Tenant experience</h3>
                        <p>Find the right room, talk directly to owners and keep every booking detail in one place.</p>
                        <ul class="doc-role-list">
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>Search rooms, save favourites and compare options</li>
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>Chat with owners and schedule a visit</li>
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>Request a booking and complete payment</li>
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>Track bookings, agreements and rent</li>
                        </ul>
                        <div class="doc-role-tabs">
                            <a href="#tenant-guide" class="doc-role-tab is-active">Open tenant guide</a>
                        </div>
                    </div>

                    <div class="doc-role-pane" data-role-pane="owner">
                        <div class="doc-role-pane-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M3 21h18M5 21V8l7-5 7 5v13M9 21v-6h6v6M9 11h.01M15 11h.01" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <h3>Owner workspace</h3>
                        <p>List properties, manage enquiries and turn approved bookings into predictable rental income.</p>
                        <ul class="doc-role-list">
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>Complete KYC and add properties with photos</li>
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>Create rooms with rent, amenities and availability</li>
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>Reply to enquiries and approve booking requests</li>
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>Track earnings, agreements and maintenance</li>
                        </ul>
                        <div class="doc-role-tabs">
                            <a href="#owner-guide" class="doc-role-tab">Open owner guide</a>
                        </div>
                    </div>

                    <div class="doc-role-pane" data-role-pane="admin">
                        <div class="doc-role-pane-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path d="M12 3l7 4v5c0 4.5-3 8-7 9-4-1-7-4.5-7-9V7l7-4z" stroke-linejoin="round"/><path d="M9.5 12l1.8 1.8 3.4-3.6" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                        <h3>Admin command centre</h3>
                        <p>Keep the marketplace healthy with user management, verification, approvals and platform-wide reporting.</p>
                        <ul class="doc-role-list">
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>Manage users, roles and account status</li>
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>Review KYC and verify identities</li>
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>Approve properties and monitor bookings</li>
                            <li><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" aria-hidden="true"><path d="M5 13l4 4L19 7" stroke-linecap="round" stroke-linejoin="round"/></svg>Oversee payments, reports and platform settings</li>
                        </ul>
                        <div class="doc-role-tabs">
                            <a href="#admin-guide" class="doc-role-tab">Open admin guide</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
