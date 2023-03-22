<?php

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'plan_id' => Plan::factory()->create(),
            'cnpj' => fake()->unique()->text(14),
            'name' => fake()->unique()->name(),
            'email' => fake()->unique()->safeEmail(),
        ];
    }
}
