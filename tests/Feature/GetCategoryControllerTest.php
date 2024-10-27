<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Category;

class GetCategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_retrieve_all_categories()
    {
        Category::factory()->count(3)->create();

        $response = $this->getJson('/api/categories');

        $response->assertStatus(200)
            ->assertJsonCount(3);
    }
}
