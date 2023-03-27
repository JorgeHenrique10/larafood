<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Product;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
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
    /**
     * Test pass products by category id.
     *
     * @return void
     */
    public function test_pass_product_by_category_id()
    {
        $tenant = Tenant::factory()->create();
        $tenantId = $tenant->id;
        $products = Product::factory()->count(10)->create([
            'tenant_id' => $tenantId
        ]);

        $categories = Category::factory()->count(3)->create(['tenant_id' => $tenantId]);

        $categories[0]->products()->attach([
            ['id' => Str::uuid(), 'product_id' => $products[0]->id],
            ['id' => Str::uuid(), 'product_id' => $products[1]->id],
            ['id' => Str::uuid(), 'product_id' => $products[2]->id],
            ['id' => Str::uuid(), 'product_id' => $products[3]->id],
            ['id' => Str::uuid(), 'product_id' => $products[4]->id],

        ]);
        $categories[1]->products()->attach([
            ['id' => Str::uuid(), 'product_id' => $products[5]->id],
            ['id' => Str::uuid(), 'product_id' => $products[6]->id],
            ['id' => Str::uuid(), 'product_id' => $products[7]->id],
            ['id' => Str::uuid(), 'product_id' => $products[8]->id],
            ['id' => Str::uuid(), 'product_id' => $products[9]->id],
        ]);

        $categories[2]->products()->attach([
            ['id' => Str::uuid(), 'product_id' => $products[0]->id],
            ['id' => Str::uuid(), 'product_id' => $products[9]->id],

        ]);
        $categoryId = $categories[2]->id;

        $response = $this->getJson("api/v1/products/category?category_id=$categoryId&tenant_id=$tenantId");

        $response->assertStatus(200)
            ->assertJsonCount(2, 'data');
    }
    /**
     * Test pass products by category id.
     *
     * @return void
     */
    public function test_fail_product_by_category_id()
    {
        $tenant = Tenant::factory()->create();
        $tenantId = $tenant->id;
        $products = Product::factory()->count(10)->create([
            'tenant_id' => $tenantId
        ]);

        $categories = Category::factory()->count(3)->create(['tenant_id' => $tenantId]);

        $categories[0]->products()->attach([
            ['id' => Str::uuid(), 'product_id' => $products[0]->id],
            ['id' => Str::uuid(), 'product_id' => $products[1]->id],
            ['id' => Str::uuid(), 'product_id' => $products[2]->id],
            ['id' => Str::uuid(), 'product_id' => $products[3]->id],
            ['id' => Str::uuid(), 'product_id' => $products[4]->id],

        ]);
        $categories[1]->products()->attach([
            ['id' => Str::uuid(), 'product_id' => $products[5]->id],
            ['id' => Str::uuid(), 'product_id' => $products[6]->id],
            ['id' => Str::uuid(), 'product_id' => $products[7]->id],
            ['id' => Str::uuid(), 'product_id' => $products[8]->id],
            ['id' => Str::uuid(), 'product_id' => $products[9]->id],
        ]);

        $categories[2]->products()->attach([
            ['id' => Str::uuid(), 'product_id' => $products[0]->id],
            ['id' => Str::uuid(), 'product_id' => $products[9]->id],

        ]);
        $categoryId = $categories[2]->id;

        $response = $this->getJson("api/v1/products/category?category_id=&tenant_id=$tenantId");

        $response->assertStatus(422)
            ->assertExactJson([
                'message' => "The category id field is required.",
                'errors' => [
                    'category_id' => [
                        "The category id field is required."
                    ]
                ]
            ]);
    }
}
