<?php

namespace Tests\Feature\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fail_create_new_client()
    {
        $payload = [
            'name' => 'Teste',
            'email' => 'test@mailinator.com',
            // 'password' => 'password'
        ];

        $response = $this->postJson('api/auth/register', $payload);

        $response->assertStatus(422)
            ->assertExactJson(
                [
                    'message' => "The password field is required.",
                    'errors' => [
                        'password' => [
                            trans("validation.required", ["attribute" => "password"])
                        ]
                    ]
                ]
            );
    }
    public function test_pass_create_new_client()
    {
        $payload = [
            'name' => 'Teste',
            'email' => 'test@mailinator.com',
            'password' => 'password'
        ];

        $response = $this->postJson('api/auth/register', $payload);

        $response->assertStatus(201)
            ->assertExactJson(
                [
                    'data' => [
                        'name' => $payload['name'],
                        'email' => $payload['email']
                    ]
                ]
            );
    }
}
