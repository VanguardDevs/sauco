<?php

namespace Tests\Unit;

use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testSuccessLogin()
    {
        $response = $this->postJson('/api/login', [
            'login' => 'admin',
            'password' => 'qwerty123'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'token' => true,
                'expires_at' => true,
                'user' => true
            ]);
    }

    public function testInvalidCredentials()
    {
        $response = $this->postJson('/api/login', [
            'login' => 'akfajkfhkjahgkjag',
            'password' => 'qwerty123'
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'success' => false
            ]);
    }
}
