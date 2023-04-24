<?php

namespace Tests\Feature\Api;

use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_validation_create_new_order()
    {
        $response = $this->postJson('api/v1/orders');
        $response->assertStatus(422)
            ->assertJsonPath('errors.tenant_id', [trans('validation.required', ['attribute' => 'tenant id'])])
            ->assertJsonPath('errors.products', [trans('validation.required', ['attribute' => 'products'])]);
    }

    public function test_create_new_order()
    {
        $tenant = Tenant::factory()->create();
        $products = Product::factory()->count(10)->create(['tenant_id' => $tenant->id]);

        $payload = [
            'tenant_id' => $tenant->id,
            'products' => []
        ];

        foreach ($products as $product) {
            $payload['products'][] = [
                'id' => (string) $product->id,
                'qtd' => 10
            ];
        }

        $response = $this->postJson('api/v1/orders', $payload);

        $response->assertStatus(201);
    }

    public function test_fail_create_new_order_authenticate_client()
    {
        $tenant = Tenant::factory()->create();
        $products = Product::factory()->count(10)->create(['tenant_id' => $tenant->id]);

        $payload = [
            'tenant_id' => $tenant->id,
            'products' => []
        ];

        foreach ($products as $product) {
            $payload['products'][] = [
                'id' => $product->id,
                'qtd' => 10
            ];
        }

        $response = $this->postJson('api/auth/v1/orders', $payload);

        $response->assertStatus(401)
            ->assertExactJson(['message' => 'Unauthenticated.']);
    }

    public function test_pass_create_new_order_authenticate_client()
    {
        $tenant = Tenant::factory()->create();
        $products = Product::factory()->count(10)->create(['tenant_id' => $tenant->id]);
        $client = Client::factory()->create();

        $token = $client->createToken('xxx')->plainTextToken;

        $payload = [
            'tenant_id' => $tenant->id,
            'products' => []
        ];

        $headers = [
            'Authorization' => "Bearer $token"
        ];

        foreach ($products as $product) {
            $payload['products'][] = [
                'id' => $product->id,
                'qtd' => 10
            ];
        }

        $response = $this->postJson('api/auth/v1/orders', $payload, $headers);

        $response->assertStatus(201);
    }

    public function test_pass_create_new_order_table()
    {
        $tenant = Tenant::factory()->create();
        $table = Table::factory()->create(['tenant_id' => $tenant->id]);

        $products = Product::factory()->count(10)->create(['tenant_id' => $tenant->id]);
        $client = Client::factory()->create();

        $token = $client->createToken('xxx')->plainTextToken;

        $payload = [
            'tenant_id' => $tenant->id,
            'table' => $table->id,
            'products' => []
        ];

        foreach ($products as $product) {
            $payload['products'][] = [
                'id' => $product->id,
                'qtd' => 10
            ];
        }

        $response = $this->postJson('api/v1/orders', $payload);

        $response->assertStatus(201);
    }

    public function test_total_order()
    {
        $tenant = Tenant::factory()->create();
        $products = Product::factory()->count(2)->create(['tenant_id' => $tenant->id]);

        $payload = [
            'tenant_id' => $tenant->id,
            'products' => []
        ];

        foreach ($products as $product) {
            $payload['products'][] = [
                'id' => $product->id,
                'qtd' => 2
            ];
        }

        $response = $this->postJson('api/v1/orders', $payload);

        $response->assertStatus(201)
            ->assertJsonPath('data.total', 39.96);
    }

    public function teste_fail_get_order_identify()
    {

        $identify = 'fake';

        $response = $this->getJson("api/v1/orders/{$identify}");

        $response->assertStatus(404);
    }

    public function teste_pass_get_order_identify()
    {

        $order = Order::factory()->create();

        $response = $this->getJson("api/v1/orders/{$order->id}");

        $response->assertStatus(404);
    }

    public function teste_get_my_order()
    {
        $tenant = Tenant::factory()->create();
        $products = Product::factory()->count(10)->create(['tenant_id' => $tenant->id]);
        $client = Client::factory()->create();
        $token = $client->createToken('xxx')->plainTextToken;

        $headers = [
            'Authorization' => "Bearer $token"
        ];

        $order = Order::factory()->count(10)->create(['client_id' => $client->id, 'tenant_id' => $tenant->id]);

        $response = $this->getJson("api/auth/v1/orders/me", $headers);

        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }
}
