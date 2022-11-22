<?php

namespace App\Services;

use App\Models\Plan;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TenantService
{
    private $plan, $data = [];

    public function __construct(Plan $plan, array $data)
    {
        $this->plan = $plan;
        $this->data = $data;
    }

    public function tenantStore()
    {
        $data = $this->data;

        $tenant = $this->plan->tenants()->create([
            'cnpj' => $data['cnpj'],
            'name' => $data['tenant'],
            'url' => Str::kebab($data['cnpj']),
            'email' => $data['email'],
            'logo' => Str::kebab($data['cnpj']),
            'subscription' => now(),
            'expires_at' => now()->addDays(7),
        ]);
        return $tenant;
    }

    public function userStore($tenant)
    {
        $data = $this->data;
        $user = $tenant->users()->create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return $user;
    }
}
