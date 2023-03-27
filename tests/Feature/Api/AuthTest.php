<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class AuthTest extends TestCase
{

    public function test_fail_validation_auth()
    {
        $response = $this->postJson('/api/auth/token');

        $response->assertStatus(422);
    }

    public function test_fail_validation_auth_client_fake()
    {
        $payload = [
            'email' => "fakeemail@mailinator.com",
            'password' => "111111",
            'device_name' => "phone"
        ];
        $response = $this->postJson('/api/auth/token', $payload);
        $response->assertStatus(422);
    }

    public function test_pass_validation_auth_client()
    {
        $client = Client::factory()->create();

        $payload = [
            'email' => $client->email,
            'password' => "password",
            'device_name' => "phonexx"
        ];
        $response = $this->postJson('/api/auth/token', $payload);

        $response->assertStatus(200)
            ->assertJsonStructure(['token']);
    }

    public function test_fail_get_me()
    {
        $client = Client::factory()->create();

        $response = $this->getJson('/api/auth/me');
        $response->assertStatus(401);
    }

    public function test_pass_get_me()
    {
        $client = Client::factory()->create();

        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->getJson('/api/auth/me', [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200)->assertExactJson([
            'data' => [
                'name' => $client->name,
                'email' => $client->email,
            ]
        ]);
    }

    public function test_pass_logout()
    {
        $client = Client::factory()->create();
        $token = $client->createToken(Str::random(10))->plainTextToken;

        $response = $this->postJson('/api/auth/logout', [], [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(204);
    }
}
