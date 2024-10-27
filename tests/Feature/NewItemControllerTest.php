<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Item;

class NewItemControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_an_item_with_image()
    {
        Storage::fake('public');

        $data = [
            'name' => 'Test Item',
            'img' => UploadedFile::fake()->image('item.jpg'),
        ];

        $response = $this->postJson('/api/items', $data);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Item created successfully']);

        Storage::disk('public')->assertExists('images/' . $data['img']->hashName());

        $this->assertDatabaseHas('items', [
            'name' => 'Test Item',
            'img' => 'images/' . $data['img']->hashName(),
        ]);
    }
}
