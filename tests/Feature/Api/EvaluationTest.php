<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use App\Models\Order;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EvaluationTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_fail_create_evaluation_order()
    {
        $client = Client::factory()->create();
        $token = $client->createToken('xxx')->plainTextToken;

        $order = 'fake';

        $headers = [
            'Authorization' => "Bearer $token"
        ];

        $payload = [
            'identityOrder' => $order,
            'stars' => 5
        ];

        $response = $this->postJson('api/auth/evaluationOrders', $payload, $headers);

        $response->assertStatus(403);
    }

    public function test_pass_create_evaluation_order()
    {
        $tenant = Tenant::factory()->create();
        $client = Client::factory()->create();
        $token = $client->createToken('xxx')->plainTextToken;

        $client->orders()->save(Order::factory()->make(['tenant_id' => $tenant->id]));

        $payload = [
            'identityOrder' => $client->orders[0]->identify,
            'stars' => 5
        ];

        $headers = [
            'Authorization' => "Bearer $token"
        ];

        $response = $this->postJson('api/auth/evaluationOrders', $payload, $headers);
        $response->assertStatus(201);
    }
}
