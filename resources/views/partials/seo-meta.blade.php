@php
    $seoData = site_seo();
    $brand = site_branding();
    $resolvedTitle = trim((string) ($pageTitle ?? ''));
    $resolvedDescription = trim((string) ($pageDescription ?? ''));
    $resolvedImage = trim((string) ($pageImage ?? ''));

    if ($resolvedTitle === '') {
        $resolvedTitle = $seoData['title'];
    } elseif (! str_contains($resolvedTitle, $brand['site_name'])) {
        $resolvedTitle .= ' | ' . $brand['site_name'];
    }

    if ($resolvedDescription === '') {
        $resolvedDescription = $seoData['description'];
    }

    if ($resolvedImage === '') {
        $resolvedImage = $seoData['image_url'];
    }
@endphp

<title>{{ $resolvedTitle }}</title>
<meta name="description" content="{{ $resolvedDescription }}">
@if ($seoData['keywords'])
    <meta name="keywords" content="{{ $seoData['keywords'] }}">
@endif
<meta name="robots" content="{{ $seoData['robots'] }}">
<link rel="canonical" href="{{ $seoData['canonical'] }}">

<meta property="og:site_name" content="{{ $brand['site_name'] }}">
<meta property="og:type" content="website">
<meta property="og:title" content="{{ $resolvedTitle }}">
<meta property="og:description" content="{{ $resolvedDescription }}">
<meta property="og:url" content="{{ $seoData['canonical'] }}">
@if ($resolvedImage)
    <meta property="og:image" content="{{ $resolvedImage }}">
    <meta property="og:image:alt" content="{{ $brand['site_name'] }}">
@endif

<meta name="twitter:card" content="{{ $seoData['twitter_card'] }}">
<meta name="twitter:title" content="{{ $resolvedTitle }}">
<meta name="twitter:description" content="{{ $resolvedDescription }}">
@if ($resolvedImage)
    <meta name="twitter:image" content="{{ $resolvedImage }}">
@endif
