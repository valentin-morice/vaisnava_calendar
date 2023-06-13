<?php

namespace Tests\Feature;

use App\Models\Path;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $path = Path::create([
            'city' => 'hello',
            'url' => 'world',
        ]);

        $this->assertEquals($path->city, "hello");
        $response->assertStatus(200);
    }
}
