<?php

namespace Tests\Unit;

use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testEndpointExist()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }
}
