<?php

namespace Tests\Feature\Admin;

use App\Models\PlatformSetting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlatformSettingsTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        return User::factory()->create(['role' => 'admin']);
    }

    public function test_admin_can_view_settings_page(): void
    {
        $response = $this->actingAs($this->admin())->get(route('admin.settings'));

        $response->assertOk();
        $response->assertSee('General Configuration');
        $response->assertSee('Razorpay');
    }

    public function test_admin_can_update_platform_settings(): void
    {
        $response = $this->actingAs($this->admin())->put(route('admin.settings.update'), [
            'site_name' => 'RoomDekho Test',
            'support_email' => 'help@roomdekho.test',
            'commission_rate' => 12.5,
            'maintenance_mode' => '1',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success');

        $this->assertDatabaseHas('platform_settings', ['key' => 'site_name', 'value' => 'RoomDekho Test']);
        $this->assertDatabaseHas('platform_settings', ['key' => 'commission_rate', 'value' => '12.5']);
        $this->assertDatabaseHas('platform_settings', ['key' => 'maintenance_mode', 'value' => '1']);
        $this->assertSame('RoomDekho Test', PlatformSetting::read('site_name'));
    }

    public function test_settings_are_validated(): void
    {
        $response = $this->actingAs($this->admin())->put(route('admin.settings.update'), [
            'site_name' => '',
            'support_email' => 'not-an-email',
            'commission_rate' => 150,
        ]);

        $response->assertSessionHasErrors(['site_name', 'support_email', 'commission_rate']);
    }

    public function test_non_admin_cannot_update_settings(): void
    {
        $tenant = User::factory()->create(['role' => 'tenant']);

        $this->actingAs($tenant)
            ->put(route('admin.settings.update'), [
                'site_name' => 'Hacked',
                'commission_rate' => 1,
            ])
            ->assertForbidden();
    }
}
