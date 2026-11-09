<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;

class PlatformSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
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
            'site_name' => 'RoomDekho',
            'support_email' => 'support@roomdekho.test',
            'commission_rate' => '10',
            'currency' => 'INR',
            'maintenance_mode' => '0',
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

    public static function write(string $key, ?string $value, string $group = 'general'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            ['value' => $value, 'group' => $group]
        );

        Cache::forget(static::CACHE_KEY);
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
