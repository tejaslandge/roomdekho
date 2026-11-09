/*
 * RoomDekho service worker
 * Versioned cache, offline fallback, safe static caching, no private HTML.
 */
'use strict';

var VERSION = 'v1';
var SHELL_CACHE = 'roomdekho-shell-' + VERSION;
var RUNTIME_CACHE = 'roomdekho-runtime-' + VERSION;
var CACHE_PREFIX = 'roomdekho-';
var OFFLINE_URL = '/offline';

var PRECACHE = [
    OFFLINE_URL,
    '/pwa.js',
    '/favicon.ico',
    '/icons/icon-192.png',
    '/icons/icon-512.png',
    '/icons/maskable-192.png',
    '/icons/maskable-512.png',
    '/icons/favicon-32.png',
    '/icons/apple-touch-icon.png'
];

// Private areas are never cached and never served from cache.
var PRIVATE_PATH = /^\/(api|sanctum|login|register|logout|forgot-password|reset-password|verify-email|confirm-password|dashboard|admin|owner|tenant|profile|verifications|payments|bookings|messages|agreements|storage\/(?!settings\/))/i;

// Only versioned/build/static asset paths are eligible for cache-first.
var STATIC_PATH = /^\/(build|icons|assets)\//i;
var SETTINGS_MEDIA_PATH = /^\/storage\/settings\//i;

self.addEventListener('install', function (event) {
    event.waitUntil(
        caches.open(SHELL_CACHE).then(function (cache) {
            return Promise.allSettled(PRECACHE.map(function (url) {
                return cache.add(new Request(url, { cache: 'reload' }));
            }));
        })
    );
});

self.addEventListener('activate', function (event) {
    event.waitUntil(
        caches.keys().then(function (keys) {
            return Promise.all(keys.map(function (key) {
                if (key.indexOf(CACHE_PREFIX) === 0 && key !== SHELL_CACHE && key !== RUNTIME_CACHE) {
                    return caches.delete(key);
                }
            }));
        }).then(function () {
            return self.clients.claim();
        })
    );
});

self.addEventListener('message', function (event) {
    if (event.data && event.data.type === 'SKIP_WAITING') {
        self.skipWaiting();
    }
});

self.addEventListener('fetch', function (event) {
    var request = event.request;

    // Never intercept state-changing requests or cross-origin traffic.
    if (request.method !== 'GET') {
        return;
    }

    var url;
    try {
        url = new URL(request.url);
    } catch (e) {
        return;
    }

    if (url.origin !== self.location.origin) {
        return;
    }

    if (url.pathname === '/sw.js' || url.pathname === '/manifest.webmanifest') {
        return;
    }

    // Private pages: network only. If offline, show the safe public offline page.
    if (PRIVATE_PATH.test(url.pathname)) {
        if (request.mode === 'navigate') {
            event.respondWith(fetch(request).catch(function () {
                return offlineFallback();
            }));
        }
        return;
    }

    // Public navigations: always network-first to avoid stale sessions/CSRF tokens.
    if (request.mode === 'navigate') {
        event.respondWith(
            fetch(request).catch(function () {
                return offlineFallback();
            })
        );
        return;
    }

    // Cache-first only for versioned/static RoomDekho assets.
    if (STATIC_PATH.test(url.pathname) || SETTINGS_MEDIA_PATH.test(url.pathname)) {
        event.respondWith(cacheFirst(request));
        return;
    }

    // Everything else (dynamic HTML, API/JSON, auth responses) stays network-only.
});

function cacheFirst(request) {
    return caches.match(request).then(function (cached) {
        if (cached) {
            return cached;
        }

        return fetch(request).then(function (response) {
            if (!isCacheable(response)) {
                return response;
            }

            var copy = response.clone();
            caches.open(RUNTIME_CACHE).then(function (cache) {
                cache.put(request, copy);
            });

            return response;
        }).catch(function () {
            return caches.match(OFFLINE_URL);
        });
    });
}

function isCacheable(response) {
    if (!response || !response.ok || response.type !== 'basic') {
        return false;
    }

    var contentType = response.headers.get('content-type') || '';
    var cacheControl = response.headers.get('cache-control') || '';

    if (contentType.indexOf('text/html') !== -1) {
        return false;
    }

    if (cacheControl.indexOf('no-store') !== -1 || cacheControl.indexOf('private') !== -1) {
        return false;
    }

    return true;
}

function offlineFallback() {
    return caches.match(OFFLINE_URL).then(function (cached) {
        if (cached) {
            return cached;
        }

        return new Response(
            '<!doctype html><html><head><meta name="viewport" content="width=device-width,initial-scale=1"><title>You are offline</title></head><body style="font-family:sans-serif;text-align:center;padding:3rem"><h1>You are offline</h1><p>Please check your internet connection and try again.</p><button onclick="location.reload()">Retry</button></body></html>',
            { headers: { 'Content-Type': 'text/html; charset=utf-8' } }
        );
    });
}
