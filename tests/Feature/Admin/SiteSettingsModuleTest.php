<?php

namespace Tests\Feature\Admin;

use App\Models\PlatformSetting;
use App\Models\User;
use App\Services\SiteSettings;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SiteSettingsModuleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        PlatformSetting::forgetCache();
    }

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    public function test_admin_can_view_every_settings_page(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)->get(route('admin.settings'))
            ->assertOk()
            ->assertSee('Site Settings & Branding', false);

        $this->actingAs($admin)->get(route('admin.settings.branding'))
            ->assertOk()
            ->assertSee('Logo & Favicon', false);

        $this->actingAs($admin)->get(route('admin.settings.pwa'))
            ->assertOk()
            ->assertSee('PWA / App Settings');

        $this->actingAs($admin)->get(route('admin.settings.appearance'))
            ->assertOk()
            ->assertSee('Appearance Settings');

        $this->actingAs($admin)->get(route('admin.settings.seo'))
            ->assertOk()
            ->assertSee('SEO Settings');
    }

    public function test_general_settings_are_saved_and_cache_is_invalidated(): void
    {
        // Prime the settings cache before the update.
        $this->assertSame('RoomDekho', app(SiteSettings::class)->get('site_name'));

        $response = $this->actingAs($this->admin())->put(route('admin.settings.update'), [
            'site_name' => 'Dekho Homes',
            'website_tagline' => 'Rooms made simple',
            'website_url' => 'https://dekho.test',
            'website_description' => 'Verified rooms across India.',
            'support_email' => 'care@dekho.test',
            'contact_phone' => '+91 90000 00000',
            'contact_address' => 'Pune, Maharashtra',
            'copyright_text' => '© {year} Dekho Homes',
            'default_language' => 'mr',
            'timezone' => 'Asia/Kolkata',
            'commission_rate' => 12.5,
            'maintenance_mode' => '1',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('platform_settings', ['key' => 'site_name', 'value' => 'Dekho Homes']);
        $this->assertDatabaseHas('platform_settings', ['key' => 'commission_rate', 'value' => '12.5']);
        $this->assertDatabaseHas('platform_settings', ['key' => 'maintenance_mode', 'value' => '1']);
        $this->assertDatabaseHas('platform_settings', ['key' => 'website_tagline', 'value' => 'Rooms made simple']);

        // Cache was primed above and must now return the new value.
        $this->assertSame('Dekho Homes', app(SiteSettings::class)->get('site_name'));
    }

    public function test_general_settings_are_validated(): void
    {
        $response = $this->actingAs($this->admin())->put(route('admin.settings.update'), [
            'site_name' => '',
            'website_url' => 'not-a-url',
            'support_email' => 'not-an-email',
            'timezone' => 'Mars/Olympus',
            'commission_rate' => 150,
        ]);

        $response->assertSessionHasErrors([
            'site_name',
            'website_url',
            'support_email',
            'timezone',
            'commission_rate',
        ]);
    }

    public function test_admin_can_upload_a_logo(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin())->put(route('admin.settings.branding.update'), [
            'logo' => UploadedFile::fake()->image('logo.png', 420, 120),
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $path = PlatformSetting::read('logo');

        $this->assertNotEmpty($path);
        $this->assertStringStartsWith('settings/branding/', $path);
        Storage::disk('public')->assertExists($path);
        $this->assertTrue(app(SiteSettings::class)->hasCustomMedia('logo'));
    }

    public function test_uploaded_svg_is_sanitized(): void
    {
        Storage::fake('public');

        $svg = <<<'SVG'
<svg xmlns="http://www.w3.org/2000/svg" width="200" height="60" onload="alert(1)">
    <script>alert('xss')</script>
    <a href="https://evil.example/steal"><text x="10" y="30">RoomDekho</text></a>
    <rect width="200" height="60" fill="#a78bfa"></rect>
</svg>
SVG;

        $response = $this->actingAs($this->admin())->put(route('admin.settings.branding.update'), [
            'logo' => UploadedFile::fake()->createWithContent('logo.svg', $svg),
        ]);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $path = PlatformSetting::read('logo');
        $stored = Storage::disk('public')->get($path);

        $this->assertStringContainsString('<svg', $stored);
        $this->assertStringNotContainsStringIgnoringCase('<script', $stored);
        $this->assertStringNotContainsStringIgnoringCase('onload', $stored);
        $this->assertStringNotContainsString('evil.example', $stored);
    }

    public function test_branding_can_be_reset_to_defaults(): void
    {
        Storage::fake('public');
        app(SiteSettings::class)->set('logo', 'settings/branding/custom.png', 'branding');

        $response = $this->actingAs($this->admin())->put(route('admin.settings.branding.update'), [
            'reset_branding' => '1',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');
        $this->assertSame('', PlatformSetting::read('logo'));
    }

    public function test_pwa_settings_are_saved_and_version_is_bumped(): void
    {
        $response = $this->actingAs($this->admin())->put(route('admin.settings.pwa.update'), [
            'pwa_enabled' => '1',
            'pwa_name' => 'Dekho Homes',
            'pwa_short_name' => 'Dekho',
            'pwa_description' => 'Find verified rooms.',
            'pwa_theme_color' => '#123abc',
            'pwa_background_color' => '#fefefe',
            'pwa_start_url' => '/rooms',
            'pwa_display' => 'standalone',
            'pwa_orientation' => 'portrait',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('platform_settings', ['key' => 'pwa_name', 'value' => 'Dekho Homes']);
        $this->assertDatabaseHas('platform_settings', ['key' => 'pwa_short_name', 'value' => 'Dekho']);
        $this->assertDatabaseHas('platform_settings', ['key' => 'pwa_theme_color', 'value' => '#123ABC']);
        $this->assertDatabaseHas('platform_settings', ['key' => 'pwa_start_url', 'value' => '/rooms']);
        $this->assertDatabaseHas('platform_settings', ['key' => 'pwa_version', 'value' => '2']);
    }

    public function test_pwa_start_url_must_be_internal(): void
    {
        $response = $this->actingAs($this->admin())->put(route('admin.settings.pwa.update'), [
            'pwa_enabled' => '1',
            'pwa_name' => 'Dekho Homes',
            'pwa_short_name' => 'Dekho',
            'pwa_theme_color' => '#123ABC',
            'pwa_background_color' => '#FEFEFE',
            'pwa_start_url' => '//evil.example',
            'pwa_display' => 'standalone',
            'pwa_orientation' => 'portrait',
        ]);

        $response->assertSessionHasErrors('pwa_start_url');
    }

    public function test_pwa_icon_dimensions_are_validated(): void
    {
        Storage::fake('public');

        $response = $this->actingAs($this->admin())->put(route('admin.settings.pwa.update'), [
            'pwa_enabled' => '1',
            'pwa_name' => 'Dekho Homes',
            'pwa_short_name' => 'Dekho',
            'pwa_theme_color' => '#123ABC',
            'pwa_background_color' => '#FEFEFE',
            'pwa_start_url' => '/',
            'pwa_display' => 'standalone',
            'pwa_orientation' => 'portrait',
            'pwa_icon_192' => UploadedFile::fake()->image('icon-192.png', 100, 100),
        ]);

        $response->assertSessionHasErrors('pwa_icon_192');
    }

    public function test_appearance_settings_are_saved(): void
    {
        $response = $this->actingAs($this->admin())->put(route('admin.settings.appearance.update'), [
            'primary_color' => '#112233',
            'secondary_color' => '#445566',
            'accent_color' => '#778899',
            'header_background' => '#FFFFFF',
            'footer_background' => '#000000',
            'button_style' => 'pill',
            'theme' => 'dark',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('platform_settings', ['key' => 'primary_color', 'value' => '#112233']);
        $this->assertDatabaseHas('platform_settings', ['key' => 'button_style', 'value' => 'pill']);
        $this->assertDatabaseHas('platform_settings', ['key' => 'theme', 'value' => 'dark']);

        $appearance = app(SiteSettings::class)->appearance();
        $this->assertSame('pill', $appearance['button_style']);
        $this->assertSame('dark', $appearance['theme']);
        $this->assertStringContainsString('--color-primary:17 34 51', app(SiteSettings::class)->themeVariables());
    }

    public function test_appearance_rejects_invalid_colours(): void
    {
        $response = $this->actingAs($this->admin())->put(route('admin.settings.appearance.update'), [
            'primary_color' => 'purple',
            'secondary_color' => '#12345',
            'accent_color' => '#778899',
            'header_background' => '#FFFFFF',
            'footer_background' => '#000000',
            'button_style' => 'circle',
            'theme' => 'neon',
        ]);

        $response->assertSessionHasErrors([
            'primary_color',
            'secondary_color',
            'button_style',
            'theme',
        ]);
    }

    public function test_seo_settings_are_saved(): void
    {
        $response = $this->actingAs($this->admin())->put(route('admin.settings.seo.update'), [
            'seo_title' => 'Dekho Homes | Rent Better',
            'seo_description' => 'Verified rental rooms across India.',
            'seo_keywords' => 'rooms, rent, pg, flats',
            'seo_twitter_card' => 'summary_large_image',
            'seo_robots' => 'noindex,nofollow',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('platform_settings', ['key' => 'seo_title', 'value' => 'Dekho Homes | Rent Better']);
        $this->assertDatabaseHas('platform_settings', ['key' => 'seo_robots', 'value' => 'noindex,nofollow']);

        $seo = app(SiteSettings::class)->seo();
        $this->assertSame('Dekho Homes | Rent Better', $seo['title']);
        $this->assertSame('noindex,nofollow', $seo['robots']);
    }

    public function test_non_admin_cannot_access_or_update_settings(): void
    {
        $tenant = User::factory()->create(['role' => 'tenant']);
        $owner = User::factory()->create(['role' => 'owner']);

        $this->actingAs($tenant)->get(route('admin.settings.branding'))->assertForbidden();
        $this->actingAs($tenant)->put(route('admin.settings.update'), [
            'site_name' => 'Hacked',
            'commission_rate' => 1,
        ])->assertForbidden();

        $this->actingAs($owner)->get(route('admin.settings.pwa'))->assertForbidden();
        $this->actingAs($owner)->put(route('admin.settings.seo.update'), [
            'seo_twitter_card' => 'summary',
            'seo_robots' => 'index,follow',
        ])->assertForbidden();
    }

    public function test_guests_are_redirected_to_login(): void
    {
        $this->get(route('admin.settings'))->assertRedirect(route('login'));
    }

    public function test_new_branding_is_reflected_on_the_public_site(): void
    {
        Storage::fake('public');

        $this->actingAs($this->admin())->put(route('admin.settings.update'), [
            'site_name' => 'Dekho Homes',
            'website_tagline' => 'Rent with confidence',
            'commission_rate' => 10,
        ]);

        $this->actingAs($this->admin())->put(route('admin.settings.seo.update'), [
            'seo_title' => 'Dekho Homes | Rent with confidence',
            'seo_description' => 'Browse verified rental rooms.',
            'seo_twitter_card' => 'summary_large_image',
            'seo_robots' => 'index,follow',
        ]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Dekho Homes')
            ->assertSee('Dekho Homes | Rent with confidence')
            ->assertSee('Browse verified rental rooms.');
    }
}
