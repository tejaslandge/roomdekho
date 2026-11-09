<?php

namespace Tests\Feature;

use App\Models\PlatformSetting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PwaTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        PlatformSetting::forgetCache();
    }

    public function test_manifest_is_served_with_the_correct_content_type(): void
    {
        $response = $this->get(route('pwa.manifest'));

        $response->assertOk();
        $response->assertHeader('Content-Type', 'application/manifest+json; charset=utf-8');
        $response->assertJsonPath('name', 'RoomDekho');
        $response->assertJsonPath('short_name', 'RoomDekho');
        $response->assertJsonPath('start_url', '/');
        $response->assertJsonPath('scope', '/');
        $response->assertJsonPath('display', 'standalone');
        $response->assertJsonCount(4, 'icons');

        $icons = $response->json('icons');
        $sizes = array_column($icons, 'sizes');
        $purposes = array_column($icons, 'purpose');

        $this->assertContains('192x192', $sizes);
        $this->assertContains('512x512', $sizes);
        $this->assertContains('any', $purposes);
        $this->assertContains('maskable', $purposes);
    }

    public function test_manifest_reflects_saved_admin_settings(): void
    {
        PlatformSetting::setMany([
            'pwa_name' => 'Dekho Homes',
            'pwa_short_name' => 'Dekho',
            'pwa_description' => 'Verified rooms everywhere.',
            'pwa_theme_color' => '#112233',
            'pwa_background_color' => '#FEFEFE',
            'pwa_start_url' => '/rooms',
            'pwa_display' => 'fullscreen',
            'pwa_orientation' => 'landscape',
            'default_language' => 'mr',
        ], 'pwa');

        $response = $this->get(route('pwa.manifest'));

        $response->assertOk();
        $response->assertJsonPath('name', 'Dekho Homes');
        $response->assertJsonPath('short_name', 'Dekho');
        $response->assertJsonPath('description', 'Verified rooms everywhere.');
        $response->assertJsonPath('theme_color', '#112233');
        $response->assertJsonPath('background_color', '#FEFEFE');
        $response->assertJsonPath('start_url', '/rooms');
        $response->assertJsonPath('display', 'fullscreen');
        $response->assertJsonPath('orientation', 'landscape');
        $response->assertJsonPath('lang', 'mr');
    }

    public function test_manifest_is_not_served_when_pwa_is_disabled(): void
    {
        PlatformSetting::setMany(['pwa_enabled' => '0'], 'pwa');

        $this->get(route('pwa.manifest'))->assertNotFound();
    }

    public function test_manifest_does_not_start_a_session_or_set_cookies(): void
    {
        $this->get(route('pwa.manifest'))
            ->assertOk()
            ->assertHeaderMissing('Set-Cookie');
    }

    public function test_offline_page_is_branded_and_not_indexed(): void
    {
        PlatformSetting::setMany(['site_name' => 'Dekho Homes'], 'general');

        $response = $this->get(route('pwa.offline'));

        $response->assertOk();
        $response->assertSee("You're Offline", false);
        $response->assertSee('Dekho Homes');
        $response->assertHeader('X-Robots-Tag', 'noindex');
        $response->assertHeaderMissing('Set-Cookie');
    }

    public function test_service_worker_exists_and_falls_back_offline(): void
    {
        $path = public_path('sw.js');

        $this->assertFileExists($path);

        $contents = file_get_contents($path);

        $this->assertStringContainsString("var OFFLINE_URL = '/offline'", $contents);
        $this->assertStringContainsString('roomdekho-shell', $contents);
    }

    public function test_public_pages_expose_the_pwa_head_and_install_ui(): void
    {
        $response = $this->get(route('home'));

        $response->assertOk();
        $response->assertSee('rel="manifest"', false);
        $response->assertSee('name="theme-color"', false);
        $response->assertSee('name="application-name"', false);
        $response->assertSee('pwa.js');
    }
}
