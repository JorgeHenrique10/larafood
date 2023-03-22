<?php

namespace Tests\Feature\Api;

use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TenantTest extends TestCase
{
    /**
     * Test all tenant.
     *
     * @return void
     */
    public function test_tenant_all()
    {
        Tenant::factory()->count(10)->create();
        $response = $this->getJson('api/v1/tenants');
        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }
    /**
     * Test fail tenant by id.
     *
     * @return void
     */
    public function test_fail_tenant_by_id()
    {
        $tenant = 'fake_id';

        $response = $this->getJson("api/v1/tenants/$tenant");
        $response->assertStatus(404);
    }
    /**
     * Test pass tenant by id.
     *
     * @return void
     */
    public function test_tenant_by_id()
    {
        $tenant = Tenant::factory()->create();

        $response = $this->getJson("api/v1/tenants/$tenant->id");
        $response->assertStatus(200)
            ->assertJson(['data' => ['uuid' => $tenant->id]]);
    }
}
