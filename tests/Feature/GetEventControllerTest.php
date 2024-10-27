<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Event;

class GetEventControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_retrieve_all_events()
    {
        Event::factory()->count(3)->create();

        $response = $this->getJson('/api/events');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }
}
