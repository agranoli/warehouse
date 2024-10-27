<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Rent;

class GetRentControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_retrieve_all_rents()
    {
        Rent::factory()->count(4)->create();

        $response = $this->getJson('/api/rents');

        $response->assertStatus(200)
            ->assertJsonCount(4);
    }
}
