<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /* *
     * A basic functional test example.
     * /
    public function test_making_an_api_request(): void
    {
        $response = $this->postJson('/api/transfer/transfer', ['value' => 100, 'payer' => 2, 'payee' => 3]);
 
        $response->assertStatus(200);
    }
    */
}
