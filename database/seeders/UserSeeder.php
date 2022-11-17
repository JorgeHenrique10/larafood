<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tenant = Tenant::first();
        $user = new User();

        $user->create([
            'tenant_id' => $tenant->id,
            'name' => 'Jorge Henrique',
            'email' => 'jorge@mailinator.com',
            'password' => bcrypt('jorge@123')
        ]);
    }
}
