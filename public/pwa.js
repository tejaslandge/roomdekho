/*
 * RoomDekho PWA client
 * - service worker registration + safe update flow
 * - beforeinstallprompt install experience
 * - standalone/installed detection and browser guidance
 */
(function () {
    'use strict';

    var enabledMeta = document.querySelector('meta[name="pwa-enabled"]');
    if (!enabledMeta || enabledMeta.getAttribute('content') !== '1') {
        return;
    }

    var updateBanner = document.getElementById('pwa-update-banner');
    var helpModal = document.getElementById('pwa-help-modal');
    var toast = document.getElementById('pwa-toast');
    var deferredPrompt = null;
    var refreshing = false;
    var toastTimer = null;

    function safeStorage(action, key, value) {
        try {
            if (action === 'get') return window.localStorage.getItem(key);
            if (action === 'set') window.localStorage.setItem(key, value);
        } catch (e) {
            return null;
        }
    }

    function isStandalone() {
        return window.matchMedia('(display-mode: standalone)').matches ||
            window.navigator.standalone === true;
    }

    function isInstalled() {
        return isStandalone() || safeStorage('get', 'rd-pwa-installed') === '1';
    }

    function show(element) {
        if (element) element.removeAttribute('hidden');
    }

    function hide(element) {
        if (element) element.setAttribute('hidden', '');
    }

    function installButtons() {
        return Array.prototype.slice.call(document.querySelectorAll('[data-pwa-install]'));
    }

    function helpTriggers() {
        return Array.prototype.slice.call(document.querySelectorAll('[data-pwa-help]'));
    }

    function refreshInstallUI() {
        var installed = isInstalled();

        installButtons().forEach(function (button) {
            if (installed || !deferredPrompt) {
                hide(button);
            } else {
                show(button);
            }
        });

        helpTriggers().forEach(function (button) {
            if (installed) {
                hide(button);
            } else {
                show(button);
            }
        });

        if (installed) {
            document.documentElement.setAttribute('data-pwa-installed', '1');
        }
    }

    function showToast(message) {
        if (!toast) return;
        toast.textContent = message;
        show(toast);
        window.clearTimeout(toastTimer);
        toastTimer = window.setTimeout(function () {
            hide(toast);
        }, 4200);
    }

    function openHelp() {
        if (!helpModal) return;
        show(helpModal);
        var first = helpModal.querySelector('[data-pwa-close-help]');
        if (first) first.focus();
    }

    function closeHelp() {
        hide(helpModal);
    }

    window.addEventListener('beforeinstallprompt', function (event) {
        event.preventDefault();
        deferredPrompt = event;
        refreshInstallUI();
    });

    window.addEventListener('appinstalled', function () {
        deferredPrompt = null;
        safeStorage('set', 'rd-pwa-installed', '1');
        hide(updateBanner);
        refreshInstallUI();
        showToast('RoomDekho has been installed.');
    });

    document.addEventListener('click', function (event) {
        var install = event.target.closest('[data-pwa-install]');
        if (install) {
            if (!deferredPrompt) {
                openHelp();
                return;
            }

            deferredPrompt.prompt();
            deferredPrompt.userChoice.then(function (choice) {
                if (choice && choice.outcome === 'accepted') {
                    installButtons().forEach(hide);
                }
                deferredPrompt = null;
                refreshInstallUI();
            }).catch(function () {
                deferredPrompt = null;
                refreshInstallUI();
            });
            return;
        }

        if (event.target.closest('[data-pwa-help]')) {
            openHelp();
            return;
        }

        if (event.target.closest('[data-pwa-close-help]') || event.target === helpModal) {
            closeHelp();
            return;
        }

        if (event.target.closest('[data-pwa-dismiss-update]')) {
            hide(updateBanner);
            return;
        }

        if (event.target.closest('[data-pwa-update]')) {
            activateWaitingWorker();
        }
    });

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape') closeHelp();
    });

    function showUpdate() {
        show(updateBanner);
    }

    function activateWaitingWorker() {
        if (!('serviceWorker' in navigator)) {
            window.location.reload();
            return;
        }

        navigator.serviceWorker.getRegistration().then(function (registration) {
            if (registration && registration.waiting) {
                registration.waiting.postMessage({ type: 'SKIP_WAITING' });
                hide(updateBanner);
                return;
            }

            window.location.reload();
        }).catch(function () {
            window.location.reload();
        });
    }

    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.addEventListener('controllerchange', function () {
            // One reload only, never a forced reload loop.
            if (refreshing) return;
            refreshing = true;
            window.location.reload();
        });

        window.addEventListener('load', function () {
            navigator.serviceWorker.register('/sw.js', { scope: '/' }).then(function (registration) {
                if (registration.waiting && navigator.serviceWorker.controller) {
                    showUpdate();
                }

                registration.addEventListener('updatefound', function () {
                    var installing = registration.installing;
                    if (!installing) return;

                    installing.addEventListener('statechange', function () {
                        if (installing.state === 'installed' && navigator.serviceWorker.controller) {
                            showUpdate();
                        }
                    });
                });

                // Check for a new deployment periodically without blocking the UI.
                window.setInterval(function () {
                    registration.update().catch(function () {});
                }, 60 * 60 * 1000);
            }).catch(function (error) {
                if (window.console && console.warn) {
                    console.warn('RoomDekho service worker registration failed.', error);
                }
            });
        });
    }

    refreshInstallUI();
})();
