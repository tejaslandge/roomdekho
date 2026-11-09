<?php

use App\Services\SiteSettings;

if (! function_exists('site_settings')) {
    function site_settings(): SiteSettings
    {
        return app(SiteSettings::class);
    }
}

if (! function_exists('site_setting')) {
    function site_setting(string $key, ?string $default = null): ?string
    {
        return site_settings()->get($key, $default);
    }
}

if (! function_exists('site_branding')) {
    /**
     * @return array<string, mixed>
     */
    function site_branding(): array
    {
        return site_settings()->branding();
    }
}

if (! function_exists('site_seo')) {
    /**
     * @return array<string, mixed>
     */
    function site_seo(): array
    {
        return site_settings()->seo();
    }
}

if (! function_exists('site_pwa')) {
    /**
     * @return array<string, mixed>
     */
    function site_pwa(): array
    {
        return site_settings()->pwa();
    }
}

if (! function_exists('site_theme_style')) {
    function site_theme_style(): string
    {
        return site_settings()->themeVariables();
    }
}
