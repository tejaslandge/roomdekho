<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DocumentationPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_can_view_the_animated_documentation_page(): void
    {
        $this->get(route('documentation'))
            ->assertOk()
            ->assertSee('Discover How')
            ->assertSee('RoomDekho')
            ->assertSee('Your complete visual guide to finding rooms, managing properties, and building better rental experiences.')
            ->assertSee('Tenant guide')
            ->assertSee('Owner guide')
            ->assertSee('Admin guide')
            ->assertSee('The complete rental journey')
            ->assertSee('Trust &amp; safety', false);
    }

    public function test_authenticated_users_can_view_the_documentation_page(): void
    {
        $tenant = User::factory()->create(['role' => 'tenant']);

        $this->actingAs($tenant)
            ->get(route('documentation'))
            ->assertOk()
            ->assertSee('Discover How');
    }
}
