<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TenantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plan = Plan::first();
        $tenant = new Tenant();

        $tenant->create([
            'plan_id' => $plan->id,
            'name' => 'Jorge Academy',
            'cnpj' => '02902072000150',
            'url' => 'jorgeacademy',
            'logo' => '',
            'email' => 'jorgeacademy@mailinator.com'
        ]);
        // $plan->tenants()->create([
        //     'name' => 'Jorge Academy',
        //     'cnpj' => '02902072000150',
        //     'url' => 'jorgeacademy',
        //     'email' => 'jorgeacademy@mailinator.com'
        // ]);
    }
}
