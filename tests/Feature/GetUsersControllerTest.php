<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class GetUsersControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_retrieve_all_users()
    {
        User::factory()->count(3)->create();

        $response = $this->getJson('/api/users');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }
}
