<?php

namespace Tests\Feature\Api;

use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * Test fail all product not pass tenant_id.
     *
     * @return void
     */
    public function test_fail_products_all()
    {
        $tenant = Tenant::factory()->create();
        $products = Product::factory()->count(10)->create(
            ['tenant_id' => $tenant->id]
        );

        $tenant->id = 'fake_id';
        $response = $this->getJson("api/v1/products");
        $response->assertStatus(422);
    }
    /**
     * Test all product.
     *
     * @return void
     */
    public function test_pass_products_all()
    {
        $tenant = Tenant::factory()->create();
        $products = Product::factory()->count(10)->create(
            ['tenant_id' => $tenant->id]
        );

        $response = $this->getJson("api/v1/products?tenant_id=$tenant->id");

        $response->dump();
        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }
    /**
     * Test fail product by id.
     *
     * @return void
     */
    public function test_fail_product_by_id()
    {
        $tenant = Tenant::factory()->create();
        $product = 'fake_id';

        $response = $this->getJson("api/v1/products/$product?tenant_id=$tenant->id");
        $response->assertStatus(404);
    }
    /**
     * Test pass product by id.
     *
     * @return void
     */
    public function test_product_by_id()
    {
        $tenant = Tenant::factory()->create();
        $product = Product::factory()->create();

        $response = $this->getJson("api/v1/products/$product->id?tenant_id=$tenant->id");
        $response->assertStatus(200)
            ->assertJson(['data' => ['id' => $product->id]]);
    }
}
