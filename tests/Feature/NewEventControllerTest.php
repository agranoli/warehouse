<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\Event;

class NewEventControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_create_an_event_with_image()
    {
        Storage::fake('public');

        $data = [
            'name' => 'Test Event',
            'date_from' => '2024-01-01',
            'date_to' => '2024-01-02',
            'img' => UploadedFile::fake()->image('test.jpg'),
        ];

        $response = $this->postJson('/api/events', $data);

        $response->assertStatus(200)
            ->assertJson(['message' => 'Event created successfully']);

        Storage::disk('public')->assertExists('images/' . $data['img']->hashName());

        $this->assertDatabaseHas('events', [
            'name' => 'Test Event',
            'img' => 'images/' . $data['img']->hashName(),
        ]);
    }
}
