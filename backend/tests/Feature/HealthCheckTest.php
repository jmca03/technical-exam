<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HealthCheckTest extends TestCase
{
    /**
     * Test Health Check.
     *
     * @return void
     */
    public function test_health_check()
    {
        $response = $this->get('/api/health-check');

        $response->assertStatus(200);
    }
}
