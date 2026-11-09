<?php

namespace App\Services;

use App\Models\PlatformSetting;
use Illuminate\Support\Facades\Storage;

/**
 * Central read/write layer for all RoomDekho site settings.
 *
 * Every Blade layout, manifest, SEO tag and PWA surface resolves branding
 * through this service so custom logos/colours never need to be hardcoded.
 */
class SiteSettings
{
    /** @return array<string, string> */
    public function all(): array
    {
        return PlatformSetting::allValues();
    }

    public function get(string $key, ?string $default = null): ?string
    {
        $value = PlatformSetting::allValues()[$key] ?? null;

        return $value !== null && $value !== '' ? $value : $default;
    }

    public function bool(string $key, bool $default = false): bool
    {
        $value = $this->get($key);

        if ($value === null) {
            return $default;
        }

        return in_array(strtolower($value), ['1', 'true', 'on', 'yes'], true);
    }

    public function set(string $key, ?string $value, string $group = 'general'): void
    {
        PlatformSetting::write($key, $value, $group);
    }

    /** @param array<string, string|null> $values */
    public function setMany(array $values, string $group = 'general'): void
    {
        PlatformSetting::setMany($values, $group);
    }

    public function flush(): void
    {
        PlatformSetting::forgetCache();
    }

    /**
     * Resolve a stored relative upload path to a public URL, falling back to
     * the bundled RoomDekho asset when no custom file exists.
     */
    public function mediaUrl(string $key, string $fallback = ''): string
    {
        $path = $this->get($key);

        if ($path) {
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                return $path;
            }

            if (Storage::disk('public')->exists($path)) {
                return Storage::disk('public')->url($path);
            }
        }

        return $fallback !== '' ? asset($fallback) : '';
    }

    public function hasCustomMedia(string $key): bool
    {
        $path = $this->get($key);

        if (! $path) {
            return false;
        }

        if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
            return true;
        }

        return Storage::disk('public')->exists($path);
    }

    /** @return array<string, mixed> */
    public function branding(): array
    {
        return [
            'site_name' => $this->get('site_name', 'RoomDekho'),
            'tagline' => $this->get('website_tagline', 'Find Your Perfect Room'),
            'copyright' => $this->copyright(),
            'logo_url' => $this->mediaUrl('logo', 'icons/icon-192.png'),
            'logo_dark_url' => $this->mediaUrl('logo_dark', 'icons/icon-192.png'),
            'logo_mobile_url' => $this->mediaUrl('logo_mobile', 'icons/icon-192.png'),
            'has_logo' => $this->hasCustomMedia('logo'),
            'has_dark_logo' => $this->hasCustomMedia('logo_dark'),
            'has_mobile_logo' => $this->hasCustomMedia('logo_mobile'),
            'favicon_png_url' => $this->mediaUrl('favicon_png', 'icons/favicon-32.png'),
            'favicon_ico_url' => $this->mediaUrl('favicon_ico', 'favicon.ico'),
            'apple_touch_icon_url' => $this->mediaUrl('apple_touch_icon', 'icons/apple-touch-icon.png'),
            'social_image_url' => $this->mediaUrl('social_image', 'icons/social-share.png'),
        ];
    }

    public function copyright(): string
    {
        $custom = $this->get('copyright_text');

        if ($custom) {
            return str_replace(['{year}', ':year'], (string) date('Y'), $custom);
        }

        return '© ' . date('Y') . ' ' . $this->get('site_name', 'RoomDekho') . '. All rights reserved.';
    }

    /** @return array<string, mixed> */
    public function pwa(): array
    {
        return [
            'enabled' => $this->bool('pwa_enabled', true),
            'name' => $this->get('pwa_name', 'RoomDekho'),
            'short_name' => $this->get('pwa_short_name', 'RoomDekho'),
            'description' => $this->get('pwa_description', 'Find Your Perfect Room'),
            'theme_color' => $this->sanitizeHex($this->get('pwa_theme_color'), '#A78BFA'),
            'background_color' => $this->sanitizeHex($this->get('pwa_background_color'), '#F9F7FF'),
            'start_url' => $this->safeStartUrl($this->get('pwa_start_url', '/')),
            'display' => $this->enum($this->get('pwa_display'), ['standalone', 'fullscreen', 'minimal-ui', 'browser'], 'standalone'),
            'orientation' => $this->enum($this->get('pwa_orientation'), ['portrait', 'any', 'landscape'], 'portrait'),
            'version' => $this->get('pwa_version', '1'),
            'icon_192' => $this->mediaUrl('pwa_icon_192', 'icons/icon-192.png'),
            'icon_512' => $this->mediaUrl('pwa_icon_512', 'icons/icon-512.png'),
            'maskable' => $this->mediaUrl('pwa_maskable_icon', 'icons/maskable-512.png'),
            'maskable_192' => $this->hasCustomMedia('pwa_maskable_icon')
                ? $this->mediaUrl('pwa_maskable_icon')
                : asset('icons/maskable-192.png'),
        ];
    }

    /** @return array<string, mixed> */
    public function manifest(): array
    {
        $pwa = $this->pwa();

        return [
            'id' => '/',
            'name' => $pwa['name'],
            'short_name' => $pwa['short_name'],
            'description' => $pwa['description'],
            'start_url' => $pwa['start_url'],
            'scope' => '/',
            'display' => $pwa['display'],
            'orientation' => $pwa['orientation'],
            'theme_color' => $pwa['theme_color'],
            'background_color' => $pwa['background_color'],
            'lang' => $this->get('default_language', 'en'),
            'dir' => 'ltr',
            'categories' => ['house', 'lifestyle', 'shopping'],
            'prefer_related_applications' => false,
            'icons' => [
                [
                    'src' => $pwa['icon_192'],
                    'sizes' => '192x192',
                    'type' => 'image/png',
                    'purpose' => 'any',
                ],
                [
                    'src' => $pwa['icon_512'],
                    'sizes' => '512x512',
                    'type' => 'image/png',
                    'purpose' => 'any',
                ],
                [
                    'src' => $pwa['maskable_192'],
                    'sizes' => '192x192',
                    'type' => 'image/png',
                    'purpose' => 'maskable',
                ],
                [
                    'src' => $pwa['maskable'],
                    'sizes' => '512x512',
                    'type' => 'image/png',
                    'purpose' => 'maskable',
                ],
            ],
        ];
    }

    /** @return array<string, mixed> */
    public function appearance(): array
    {
        return [
            'primary_color' => $this->sanitizeHex($this->get('primary_color'), '#A78BFA'),
            'secondary_color' => $this->sanitizeHex($this->get('secondary_color'), '#F9A8D4'),
            'accent_color' => $this->sanitizeHex($this->get('accent_color'), '#60A5FA'),
            'header_background' => $this->sanitizeHex($this->get('header_background'), '#FFFFFF'),
            'footer_background' => $this->sanitizeHex($this->get('footer_background'), '#FFFFFF'),
            'button_style' => $this->enum($this->get('button_style'), ['rounded', 'pill', 'square'], 'rounded'),
            'theme' => $this->enum($this->get('theme'), ['light', 'dark'], 'light'),
        ];
    }

    /** CSS custom properties consumed by Tailwind and layout styles. */
    public function themeVariables(): string
    {
        $appearance = $this->appearance();
        $radius = match ($appearance['button_style']) {
            'pill' => '9999px',
            'square' => '0.25rem',
            default => '1rem',
        };

        $variables = [
            '--color-primary' => $this->rgbTriplet($appearance['primary_color']),
            '--color-secondary' => $this->rgbTriplet($appearance['secondary_color']),
            '--color-accent' => $this->rgbTriplet($appearance['accent_color']),
            '--color-header-bg' => $this->rgbTriplet($appearance['header_background']),
            '--color-footer-bg' => $this->rgbTriplet($appearance['footer_background']),
            '--color-soft' => '249 247 255',
            '--color-text-primary' => '31 41 55',
            '--color-text-secondary' => '107 114 128',
            '--radius-button' => $radius,
        ];

        $css = ':root{';
        foreach ($variables as $name => $value) {
            $css .= $name . ':' . $value . ';';
        }
        $css .= '}';

        // Keep the button radius available to plain CSS buttons.
        $css .= '.rd-button{border-radius:var(--radius-button);}';

        return $css;
    }

    /** @return array<string, mixed> */
    public function seo(): array
    {
        $siteName = $this->get('site_name', 'RoomDekho');
        $tagline = $this->get('website_tagline', 'Find Your Perfect Room');
        $title = $this->get('seo_title');
        $description = $this->get('seo_description');
        $ogImage = $this->mediaUrl('seo_og_image');

        if ($ogImage === '') {
            $ogImage = $this->mediaUrl('social_image', 'icons/social-share.png');
        }

        return [
            'site_name' => $siteName,
            'title' => $title ?: trim($siteName . ' | ' . $tagline, ' |'),
            'description' => $description ?: $this->get('website_description', ''),
            'keywords' => $this->get('seo_keywords', ''),
            'image_url' => $ogImage,
            'twitter_card' => $this->enum($this->get('seo_twitter_card'), ['summary', 'summary_large_image'], 'summary_large_image'),
            'robots' => $this->enum($this->get('seo_robots'), ['index,follow', 'noindex,nofollow'], 'index,follow'),
            'canonical' => request()->url(),
        ];
    }

    public function sanitizeHex(?string $value, string $fallback): string
    {
        $value = trim((string) $value);

        if (preg_match('/^#([0-9a-fA-F]{3}|[0-9a-fA-F]{6})$/', $value) !== 1) {
            return $fallback;
        }

        if (strlen($value) === 4) {
            $value = '#' . $value[1] . $value[1] . $value[2] . $value[2] . $value[3] . $value[3];
        }

        return strtoupper($value);
    }

    public function rgbTriplet(string $hex): string
    {
        $hex = ltrim($hex, '#');

        return implode(' ', [
            hexdec(substr($hex, 0, 2)),
            hexdec(substr($hex, 2, 2)),
            hexdec(substr($hex, 4, 2)),
        ]);
    }

    /** Only allow an internal path so the manifest can never redirect off-site. */
    public function safeStartUrl(?string $value): string
    {
        $value = trim((string) $value);

        if ($value === '' || ! str_starts_with($value, '/') || str_starts_with($value, '//')) {
            return '/';
        }

        return $value;
    }

    /** @param list<string> $allowed */
    private function enum(?string $value, array $allowed, string $fallback): string
    {
        return in_array($value, $allowed, true) ? $value : $fallback;
    }
}
