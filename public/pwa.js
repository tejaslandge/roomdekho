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

    function isInstallDismissed() {
        return safeStorage('get', 'rd-pwa-install-dismissed') === '1';
    }

    function show(element) {
        if (element) element.removeAttribute('hidden');
        if (element) element.style.display = '';
    }

    function hide(element) {
        if (element) element.setAttribute('hidden', '');
        if (element) element.style.display = 'none';
    }

    function installButtons() {
        return Array.prototype.slice.call(document.querySelectorAll('[data-pwa-install]'));
    }

    function helpTriggers() {
        return Array.prototype.slice.call(document.querySelectorAll('[data-pwa-help]'));
    }

    function refreshModalUI() {
        var wrap = document.getElementById('pwa-modal-install-wrap');
        if (!wrap) return;
        if (deferredPrompt && !isInstalled()) {
            wrap.classList.remove('hidden');
        } else {
            wrap.classList.add('hidden');
        }
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

        refreshModalUI();

        if (installed) {
            document.documentElement.setAttribute('data-pwa-installed', '1');
        }
    }

    function showToast(message) {
        if (!toast) toast = document.getElementById('pwa-toast');
        if (!toast) return;
        toast.textContent = message;
        show(toast);
        window.clearTimeout(toastTimer);
        toastTimer = window.setTimeout(function () {
            hide(toast);
        }, 4200);
    }

    function openHelp() {
        if (isInstalled()) return;
        if (!helpModal) helpModal = document.getElementById('pwa-help-modal');
        if (!helpModal) return;
        refreshModalUI();
        helpModal.removeAttribute('hidden');
        helpModal.style.display = '';
        var first = helpModal.querySelector('[data-pwa-close-help], [data-pwa-modal-install]');
        if (first) {
            try { first.focus(); } catch (e) {}
        }
    }

    function closeHelp(dismiss) {
        if (!helpModal) helpModal = document.getElementById('pwa-help-modal');
        if (!helpModal) return;
        helpModal.setAttribute('hidden', '');
        helpModal.style.display = 'none';
        if (dismiss) {
            safeStorage('set', 'rd-pwa-install-dismissed', '1');
        }
    }

    function triggerInstallPrompt() {
        if (!deferredPrompt) {
            openHelp();
            return;
        }

        var prompt = deferredPrompt;
        deferredPrompt = null;
        refreshInstallUI();

        prompt.prompt();
        prompt.userChoice.then(function (choice) {
            if (choice && choice.outcome === 'accepted') {
                installButtons().forEach(hide);
                closeHelp(false);
            } else {
                refreshInstallUI();
            }
        }).catch(function () {
            refreshInstallUI();
        });
    }

    window.__RD_closePwaHelp = function () { closeHelp(true); };
    window.__RD_openPwaHelp = openHelp;

    window.addEventListener('beforeinstallprompt', function (event) {
        event.preventDefault();
        deferredPrompt = event;
        refreshInstallUI();

        // If the user hasn't dismissed the prompt and isn't installed, show it.
        if (!isInstalled() && !isInstallDismissed()) {
            openHelp();
        }
    });

    window.addEventListener('appinstalled', function () {
        deferredPrompt = null;
        safeStorage('set', 'rd-pwa-installed', '1');
        closeHelp(false);
        hide(updateBanner);
        refreshInstallUI();
        showToast('RoomDekho has been installed.');
    });

    document.addEventListener('click', function (event) {
        var modalInstall = event.target.closest('[data-pwa-modal-install]');
        if (modalInstall) {
            triggerInstallPrompt();
            return;
        }

        var install = event.target.closest('[data-pwa-install]');
        if (install) {
            triggerInstallPrompt();
            return;
        }

        if (event.target.closest('[data-pwa-help]')) {
            openHelp();
            return;
        }

        if (event.target.closest('[data-pwa-close-help]')) {
            var dismiss = !!event.target.closest('[data-pwa-dismiss]');
            closeHelp(dismiss);
            return;
        }

        if (helpModal && !helpModal.hasAttribute('hidden') && event.target === helpModal) {
            closeHelp(true);
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
        if (event.key === 'Escape' && helpModal && !helpModal.hasAttribute('hidden')) {
            closeHelp(true);
        }
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

    // Show the install popup once for eligible users. Closing it persists dismissal.
    if (!isInstalled() && !isInstallDismissed()) {
        window.setTimeout(function () {
            if (!isInstalled() && !isInstallDismissed()) {
                openHelp();
            }
        }, 600);
    }
})();
