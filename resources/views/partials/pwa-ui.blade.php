@php($pwaUi = site_pwa())

@if ($pwaUi['enabled'])
    <div id="pwa-update-banner" hidden
         class="fixed bottom-4 left-1/2 z-[110] w-[calc(100%-2rem)] max-w-md -translate-x-1/2 rounded-2xl border border-primary/20 bg-white p-4 shadow-2xl shadow-primary/20"
         role="status" aria-live="polite">
        <div class="flex items-start gap-3">
            <div class="flex h-10 w-10 flex-none items-center justify-center rounded-xl bg-primary/10 text-primary">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                </svg>
            </div>
            <div class="min-w-0 flex-1">
                <p class="text-sm font-bold text-text-primary">A new RoomDekho version is ready</p>
                <p class="mt-1 text-xs text-text-secondary">Update now for the latest fixes and features.</p>
                <div class="mt-3 flex items-center gap-2">
                    <button type="button" data-pwa-update
                            class="rd-button rounded-xl bg-primary px-4 py-2 text-xs font-bold text-white hover:bg-primary/90">
                        Update Now
                    </button>
                    <button type="button" data-pwa-dismiss-update
                            class="rounded-xl px-3 py-2 text-xs font-bold text-text-secondary hover:bg-soft">
                        Later
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div id="pwa-help-modal" hidden
         class="fixed inset-0 z-[120] flex items-end justify-center bg-gray-900/50 p-4 backdrop-blur-sm sm:items-center"
         role="dialog" aria-modal="true" aria-labelledby="pwa-help-title">
        <div class="w-full max-w-md rounded-3xl border border-gray-100 bg-white p-6 shadow-2xl">
            <div class="flex items-start justify-between gap-4">
                <div>
                    <h2 id="pwa-help-title" class="font-display text-lg font-bold text-text-primary">Install RoomDekho</h2>
                    <p class="mt-1 text-sm text-text-secondary">Add RoomDekho to your home screen for a faster, full-screen experience.</p>
                </div>
                <button type="button" data-pwa-close-help class="rounded-xl p-2 text-text-secondary hover:bg-soft" aria-label="Close">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="mt-5 space-y-3 text-sm">
                <div class="rounded-2xl bg-soft p-4">
                    <p class="font-bold text-text-primary">Android / Chrome</p>
                    <p class="mt-1 text-text-secondary">Tap the browser menu (⋮) and choose <strong>Install app</strong> or <strong>Add to Home screen</strong>.</p>
                </div>
                <div class="rounded-2xl bg-soft p-4">
                    <p class="font-bold text-text-primary">iPhone / Safari</p>
                    <p class="mt-1 text-text-secondary">Tap <strong>Share</strong>, then <strong>Add to Home Screen</strong>.</p>
                </div>
                <div class="rounded-2xl bg-soft p-4">
                    <p class="font-bold text-text-primary">Desktop Chrome / Edge</p>
                    <p class="mt-1 text-text-secondary">Use the install icon in the address bar, or the browser menu → <strong>Install RoomDekho</strong>.</p>
                </div>
            </div>

            <button type="button" data-pwa-close-help
                    class="rd-button mt-5 w-full rounded-2xl bg-primary px-4 py-3 text-sm font-bold text-white hover:bg-primary/90">
                Got it
            </button>
        </div>
    </div>

    <div id="pwa-toast" hidden
         class="fixed bottom-4 left-1/2 z-[130] w-[calc(100%-2rem)] max-w-sm -translate-x-1/2 rounded-2xl bg-text-primary px-4 py-3 text-center text-sm font-bold text-white shadow-xl"
         role="status" aria-live="polite"></div>

    <script src="{{ asset('pwa.js') }}" defer></script>
@endif
