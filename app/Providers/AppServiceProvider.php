<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\SiteSettings::class, fn () => new \App\Services\SiteSettings());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Apply the admin-configured locale/timezone to the whole application.
        try {
            $settings = app(\App\Services\SiteSettings::class);

            if ($timezone = $settings->get('timezone')) {
                config(['app.timezone' => $timezone]);
                date_default_timezone_set($timezone);
            }

            if ($locale = $settings->get('default_language')) {
                config(['app.locale' => $locale]);
                app()->setLocale($locale);
            }
        } catch (\Throwable) {
            // Database may not be available during install/migration commands.
        }
    }
}
