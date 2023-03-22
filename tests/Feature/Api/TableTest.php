<?php

namespace Tests\Feature\Api;

use App\Models\Table;
use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TableTest extends TestCase
{
    /**
     * Test fail all table not pass tenant_id.
     *
     * @return void
     */
    public function test_fail_tables_all()
    {
        $tenant = Tenant::factory()->create();

        $tenant->id = 'fake_id';
        $response = $this->getJson("api/v1/tables");

        $response->assertStatus(422);
    }
    /**
     * Test all table.
     *
     * @return void
     */
    public function test_pass_tables_all()
    {
        $tenant = Tenant::factory()->create();

        Table::factory()->count(10)->create([
            'tenant_id' => $tenant->id
        ]);

        $response = $this->getJson("api/v1/tables?tenant_id=$tenant->id");
        $response->assertStatus(200)
            ->assertJsonCount(10, 'data');
    }
    /**
     * Test fail table by id.
     *
     * @return void
     */
    public function test_fail_table_by_id()
    {
        $tenant = Tenant::factory()->create();
        $table = 'fake_id';

        $response = $this->getJson("api/v1/tables/$table?tenant_id=$tenant->id");
        $response->assertStatus(404);
    }
    /**
     * Test pass table by id.
     *
     * @return void
     */
    public function test_table_by_id()
    {
        $tenant = Tenant::factory()->create();
        $table = Table::factory()->create();

        $response = $this->getJson("api/v1/tables/$table->id?tenant_id=$tenant->id");
        $response->assertStatus(200)
            ->assertJson(['data' => ['id' => $table->id]]);
    }
}
