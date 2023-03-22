<?php

namespace Tests\Feature\Auth;

use App\Models\Plan;
use App\Models\Tenant;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Str;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered()
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    // public function test_new_users_can_register()
    // {

    //     $tenant = Tenant::factory()->create();
    //     $user = User::factory()->create(['tenant_id' => $tenant->id]);
    //     $plan = Plan::factory()->create();
    //     $this->session(['plan_id' => $plan->id]);
    //     // session('plan_id', $plan->id);

    //     $response = $this->post('/register', [
    //         'plan_id' => $plan->id,
    //         'name' => 'Test User',
    //         'email' => fake()->unique()->safeEmail(),
    //         'cnpj' => Str::random(14),
    //         'tenant' => $tenant->id,
    //         'password' => 'password',
    //         'password_confirmation' => 'password',
    //     ]);

    //     $this->assertAuthenticated();
    //     $response->assertRedirect(RouteServiceProvider::HOME);
    // }
}
