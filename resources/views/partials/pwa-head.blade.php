@php
    $pwaMeta = site_pwa();
    $brandMeta = site_branding();
@endphp

<link rel="icon" href="{{ $brandMeta['favicon_ico_url'] }}" sizes="any">
<link rel="icon" type="image/png" sizes="32x32" href="{{ $brandMeta['favicon_png_url'] }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ $brandMeta['apple_touch_icon_url'] }}">

@if ($pwaMeta['enabled'])
    <link rel="manifest" href="{{ route('pwa.manifest') }}?v={{ urlencode($pwaMeta['version']) }}">
@endif

<meta name="theme-color" content="{{ $pwaMeta['theme_color'] }}">
<meta name="application-name" content="{{ $pwaMeta['name'] }}">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="{{ $pwaMeta['short_name'] }}">
<meta name="msapplication-TileColor" content="{{ $pwaMeta['theme_color'] }}">
<meta name="pwa-enabled" content="{{ $pwaMeta['enabled'] ? '1' : '0' }}">
