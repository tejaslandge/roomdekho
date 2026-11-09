<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomSearchTest extends TestCase
{
    use RefreshDatabase;

    private function availableRoom(array $overrides = []): Room
    {
        $owner = User::factory()->create(['role' => 'owner']);
        $property = Property::create([
            'owner_id' => $owner->id,
            'title' => 'Sunrise Apartments',
            'description' => 'A quiet place near the metro.',
            'city' => 'Nagpur',
            'area' => 'Dharampeth',
            'address' => '12 Main Road',
            'status' => 'active',
        ]);

        return Room::create(array_merge([
            'property_id' => $property->id,
            'room_type' => '1BHK',
            'rent' => 5000,
            'description' => 'Bright and furnished.',
            'available' => true,
            'electricity_type' => 'Sub-meter',
            'water_source' => 'Municipal',
        ], $overrides));
    }

    public function test_guest_can_search_available_rooms(): void
    {
        $room = $this->availableRoom();

        $response = $this->get(route('rooms.search', ['q' => 'Nagpur']));

        $response->assertOk();
        $response->assertSee('Sunrise Apartments');
        $this->assertSame(1, $response->viewData('rooms')->total());
    }

    public function test_guest_can_view_room_details(): void
    {
        $room = $this->availableRoom();

        $this->get(route('rooms.show', $room))
            ->assertOk()
            ->assertSee('Sunrise Apartments')
            ->assertSee('Login to Book');
    }

    public function test_unavailable_rooms_are_hidden(): void
    {
        $this->availableRoom(['available' => false]);

        $response = $this->get(route('rooms.search'));

        $this->assertSame(0, $response->viewData('rooms')->total());
    }

    public function test_rent_and_sort_filters_are_applied(): void
    {
        $cheap = $this->availableRoom(['rent' => 3000, 'room_type' => '1RK']);
        $expensive = $this->availableRoom(['rent' => 9000, 'room_type' => '2BHK']);

        $response = $this->get(route('rooms.search', ['max_rent' => 5000, 'sort' => 'rent_low']));
        $results = $response->viewData('rooms');

        $this->assertSame(1, $results->total());
        $this->assertSame($cheap->id, $results->first()->id);
        $this->assertNotSame($expensive->id, $results->first()->id);
    }
}
