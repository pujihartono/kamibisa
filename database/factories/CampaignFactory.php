<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Campaign>
 */
class CampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence(4);
        return [
            'user_id' => \App\Models\User::factory(), // Otomatis buat user jika belum ada
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'short_description' => $this->faker->paragraph(1),
            'description' => $this->faker->paragraphs(3, true),
            'target_amount' => $this->faker->randomFloat(2, 1000, 100000),
            'current_amount' => 0, // Awalnya 0
            'image_path' => 'https://picsum.photos/seed/' . rand(1, 1000) . '/800/600',
            'deadline' => $this->faker->dateTimeBetween('+1 week', '+3 months'),
            'status' => 'active',
        ];
    }
}
