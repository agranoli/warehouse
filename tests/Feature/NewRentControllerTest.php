<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Rent;
use App\Models\Item;
use App\Models\User;

class NewRentControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_a_rent()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $data = [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'rent_date' => '2024-01-01',
        ];

        $response = $this->postJson('/api/rents', $data);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Rent created successfully']);

        $this->assertDatabaseHas('rents', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }
}
