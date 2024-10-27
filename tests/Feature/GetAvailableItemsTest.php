<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Item;

class GetAvailableItemsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_retrieve_all_available_items()
    {
        Item::factory()->count(5)->create(['available' => true]);

        $response = $this->getJson('/api/available-items');

        $response->assertStatus(200)
            ->assertJsonCount(5);
    }
}
