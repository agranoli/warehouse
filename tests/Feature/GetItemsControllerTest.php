<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Item;

class GetItemsControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_retrieve_all_items()
    {
        Item::factory()->count(5)->create();

        $response = $this->getJson('/api/items');

        $response->assertStatus(200)
            ->assertJsonCount(5);
    }
}
