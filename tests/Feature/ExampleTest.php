<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_the_application_returns_a_successful_response()
    {
        $this->get('/')->assertStatus(200);
        $this->get('/terms-of-use')->assertStatus(200);
        $this->get('/about')->assertStatus(200);
    }
}
