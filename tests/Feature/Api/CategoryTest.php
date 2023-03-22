<?php

namespace Tests\Feature\Api;

use App\Models\Category;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * Test fail all category not pass tenant_id.
     *
     * @return void
     */
    public function test_fail_categories_all()
    {
        $tenant = Tenant::factory()->create();
        Category::factory()->count(10)->create(
            ['tenant_id' => $tenant->id]
        );
        $tenant->id = 'fake_id';
        $response = $this->getJson("api/v1/categories");

        $response->assertStatus(422);
    }
    /**
     * Test all category.
     *
     * @return void
     */
    public function test_pass_categories_all()
    {
        $tenant = Tenant::factory()->create();
        Category::factory()->count(10)->create(
            ['tenant_id' => $tenant->id]
        );
        $response = $this->getJson("api/v1/categories?tenant_id=$tenant->id");
        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }
    /**
     * Test fail category by id.
     *
     * @return void
     */
    public function test_fail_category_by_id()
    {
        $tenant = Tenant::factory()->create();
        $category = 'fake_id';

        $response = $this->getJson("api/v1/categories/$category?tenant_id=$tenant->id");
        $response->assertStatus(404);
    }
    /**
     * Test pass category by id.
     *
     * @return void
     */
    public function test_category_by_id()
    {
        $tenant = Tenant::factory()->create();
        $category = Category::factory()->create();

        $response = $this->getJson("api/v1/categories/$category->id?tenant_id=$tenant->id");
        $response->assertStatus(200)
            ->assertJson(['data' => ['id' => $category->id]]);
    }
}
