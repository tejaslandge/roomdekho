<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PlatformSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    public const CACHE_KEY = 'platform_settings.all';

    /**
     * Default values used when a setting has never been stored.
     *
     * @return array<string, string>
     */
    public static function defaults(): array
    {
        return [
            // General
            'site_name' => 'RoomDekho',
            'website_tagline' => 'Find Your Perfect Room',
            'website_url' => (string) config('app.url', 'https://roomdekho.test'),
            'website_description' => 'RoomDekho helps tenants discover verified rooms and helps owners manage rentals with confidence.',
            'support_email' => 'support@roomdekho.test',
            'contact_phone' => '',
            'contact_address' => '',
            'copyright_text' => '',
            'default_language' => 'en',
            'timezone' => 'Asia/Kolkata',
            'commission_rate' => '10',
            'currency' => 'INR',
            'maintenance_mode' => '0',

            // Branding (relative storage paths; empty means use the bundled default)
            'logo' => '',
            'logo_dark' => '',
            'logo_mobile' => '',
            'favicon_png' => '',
            'favicon_ico' => '',
            'apple_touch_icon' => '',
            'social_image' => '',

            // PWA
            'pwa_enabled' => '1',
            'pwa_name' => 'RoomDekho',
            'pwa_short_name' => 'RoomDekho',
            'pwa_description' => 'Find Your Perfect Room',
            'pwa_icon_192' => '',
            'pwa_icon_512' => '',
            'pwa_maskable_icon' => '',
            'pwa_theme_color' => '#A78BFA',
            'pwa_background_color' => '#F9F7FF',
            'pwa_start_url' => '/',
            'pwa_display' => 'standalone',
            'pwa_orientation' => 'portrait',
            'pwa_version' => '1',

            // Appearance
            'primary_color' => '#A78BFA',
            'secondary_color' => '#F9A8D4',
            'accent_color' => '#60A5FA',
            'header_background' => '#FFFFFF',
            'footer_background' => '#FFFFFF',
            'button_style' => 'rounded',
            'theme' => 'light',

            // SEO
            'seo_title' => 'RoomDekho | Find Your Perfect Room',
            'seo_description' => 'Discover verified rooms for rent, connect with trusted owners, and manage your rental journey with RoomDekho.',
            'seo_keywords' => 'rooms for rent, PG, flats, rental homes, RoomDekho',
            'seo_og_image' => '',
            'seo_twitter_card' => 'summary_large_image',
            'seo_robots' => 'index,follow',
        ];
    }

    /**
     * Return every setting merged over the defaults.
     *
     * @return array<string, string>
     */
    public static function allValues(): array
    {
        if (! static::tableExists()) {
            return static::defaults();
        }

        $stored = Cache::rememberForever(static::CACHE_KEY, function () {
            return static::query()->pluck('value', 'key')->all();
        });

        return array_merge(static::defaults(), array_filter(
            $stored,
            fn ($value) => $value !== null
        ));
    }

    public static function read(string $key, ?string $default = null): ?string
    {
        return static::allValues()[$key] ?? $default;
    }

    public static function write(string $key, ?string $value, string $group = 'general', string $type = 'string'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group, 'type' => $type]
        );

        Cache::forget(static::CACHE_KEY);
    }

    /**
     * Persist a batch of settings atomically and invalidate the cache once.
     *
     * @param  array<string, string|null>  $values
     */
    public static function setMany(array $values, string $group = 'general'): void
    {
        if (! static::tableExists()) {
            return;
        }

        DB::transaction(function () use ($values, $group) {
            foreach ($values as $key => $value) {
                static::updateOrCreate(
                    ['key' => $key],
                    [
                        'value' => $value,
                        'group' => $group,
                        'type' => static::inferType($key, $value),
                    ]
                );
            }
        });

        static::forgetCache();
    }

    public static function forgetCache(): void
    {
        Cache::forget(static::CACHE_KEY);
    }

    protected static function inferType(string $key, ?string $value): string
    {
        if (str_ends_with($key, '_color') || str_ends_with($key, '_background')) {
            return 'color';
        }

        if (str_starts_with($key, 'pwa_') && in_array($key, ['pwa_enabled'], true)) {
            return 'boolean';
        }

        if (in_array($key, ['maintenance_mode'], true)) {
            return 'boolean';
        }

        if (in_array($key, ['logo', 'logo_dark', 'logo_mobile', 'favicon_png', 'favicon_ico', 'apple_touch_icon', 'social_image', 'pwa_icon_192', 'pwa_icon_512', 'pwa_maskable_icon', 'seo_og_image'], true)) {
            return 'file';
        }

        return 'string';
    }

    protected static function tableExists(): bool
    {
        try {
            return Schema::hasTable('platform_settings');
        } catch (\Throwable) {
            return false;
        }
    }
}
