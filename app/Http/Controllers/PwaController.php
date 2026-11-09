<?php

namespace App\Http\Controllers;

use App\Services\SiteSettings;

class PwaController extends Controller
{
    public function __construct(private readonly SiteSettings $settings)
    {
    }

    public function manifest()
    {
        abort_unless($this->settings->pwa()['enabled'], 404);

        return response()->json(
            $this->settings->manifest(),
            200,
            [
                'Content-Type' => 'application/manifest+json; charset=utf-8',
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
            ],
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT
        );
    }

    public function offline()
    {
        return response()
            ->view('pwa.offline')
            ->header('Cache-Control', 'public, max-age=0, must-revalidate')
            ->header('X-Robots-Tag', 'noindex');
    }
}
