@php
    $offlineBrand = site_branding();
    $offlinePwa = site_pwa();
@endphp
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="{{ $offlinePwa['theme_color'] }}">
    <meta name="robots" content="noindex,nofollow">
    <title>You're Offline | {{ $offlineBrand['site_name'] }}</title>
    <style>
        :root {
            --rd-primary: {{ $offlinePwa['theme_color'] }};
            --rd-bg: {{ $offlinePwa['background_color'] }};
            --rd-ink: #1f2937;
            --rd-muted: #6b7280;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            min-height: 100vh;
            display: grid;
            place-items: center;
            padding: 24px;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", sans-serif;
            color: var(--rd-ink);
            background:
                radial-gradient(circle at 15% 10%, rgba(249, 168, 212, .32), transparent 42%),
                radial-gradient(circle at 88% 85%, rgba(167, 139, 250, .28), transparent 45%),
                var(--rd-bg);
        }
        .card {
            width: min(100%, 430px);
            text-align: center;
            background: #fff;
            border: 1px solid rgba(167, 139, 250, .18);
            border-radius: 32px;
            padding: 44px 28px 36px;
            box-shadow: 0 24px 70px rgba(76, 29, 149, .12);
        }
        .brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: inherit;
            margin-bottom: 30px;
        }
        .brand img {
            width: 46px;
            height: 46px;
            border-radius: 14px;
            object-fit: cover;
            box-shadow: 0 8px 18px rgba(167, 139, 250, .24);
        }
        .brand span { font-weight: 800; font-size: 20px; letter-spacing: -.02em; }
        .icon {
            width: 78px;
            height: 78px;
            margin: 0 auto 22px;
            display: grid;
            place-items: center;
            border-radius: 24px;
            color: var(--rd-primary);
            background: color-mix(in srgb, var(--rd-primary) 13%, white);
        }
        h1 { margin: 0 0 10px; font-size: 30px; letter-spacing: -.03em; }
        p { margin: 0 auto 26px; max-width: 30ch; line-height: 1.6; color: var(--rd-muted); font-size: 15px; }
        .status {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            background: #fef2f2;
            color: #b91c1c;
            margin-bottom: 22px;
        }
        .status::before { content: ""; width: 8px; height: 8px; border-radius: 50%; background: currentColor; }
        .status.online { background: #ecfdf5; color: #047857; }
        button {
            width: 100%;
            border: 0;
            cursor: pointer;
            padding: 15px 20px;
            border-radius: 16px;
            font: inherit;
            font-size: 15px;
            font-weight: 800;
            color: #fff;
            background: var(--rd-primary);
            box-shadow: 0 12px 26px color-mix(in srgb, var(--rd-primary) 28%, transparent);
            transition: transform .15s ease, opacity .15s ease;
        }
        button:hover { transform: translateY(-1px); }
        button:active { transform: scale(.98); }
        .hint { margin: 18px 0 0; font-size: 12px; color: var(--rd-muted); }
    </style>
</head>
<body>
    <main class="card">
        <a class="brand" href="{{ url('/') }}">
            <img src="{{ $offlineBrand['logo_url'] }}" alt="{{ $offlineBrand['site_name'] }}">
            <span>{{ $offlineBrand['site_name'] }}</span>
        </a>

        <div class="icon" aria-hidden="true">
            <svg width="38" height="38" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01M3.05 13.05a10 10 0 0117.9 0M6.343 9.757a15 15 0 0111.314 0"></path>
            </svg>
        </div>

        <h1>You're Offline</h1>
        <p>Please check your internet connection and try again.</p>

        <div id="connectionStatus" class="status" role="status" aria-live="polite">No internet connection</div>

        <button type="button" onclick="window.location.reload()">Retry</button>
        <p class="hint">Installed RoomDekho only stores public pages. Bookings, payments and messages always need a connection.</p>
    </main>

    <script>
        (function () {
            var status = document.getElementById('connectionStatus');

            function update() {
                if (!status) return;
                if (navigator.onLine) {
                    status.textContent = 'Back online';
                    status.classList.add('online');
                } else {
                    status.textContent = 'No internet connection';
                    status.classList.remove('online');
                }
            }

            window.addEventListener('online', update);
            window.addEventListener('offline', update);
            update();
        })();
    </script>
</body>
</html>
