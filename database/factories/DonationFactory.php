<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Donation>
 */
class DonationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'campaign_id' => \App\Models\Campaign::factory(),
            'user_id' => \App\Models\User::factory(),
            'donor_name' => $this->faker->name,
            'donor_email' => $this->faker->safeEmail,
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'comment' => $this->faker->sentence,
            'is_paid' => true,
        ];
    }
}
