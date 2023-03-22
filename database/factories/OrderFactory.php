<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Tenant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'tenant_id' => Tenant::factory()->make(),
            'client_id' => Client::factory()->make(),
            'identify' => fake()->unique()->rand(00000000, 99999999),
            'total' => 150.50,
            'status' => 'open'
        ];
    }
}
