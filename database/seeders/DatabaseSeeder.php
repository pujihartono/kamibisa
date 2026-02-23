<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = \App\Models\User::factory(5)->create();

        // 2. Buat 10 Campaign (Milik salah satu user di atas)
        $campaigns = \App\Models\Campaign::factory(10)
            ->recycle($users) // Gunakan user yang sudah ada
            ->create();

        // 3. Buat Donasi untuk setiap campaign
        foreach ($campaigns as $campaign) {
            $donationCount = rand(3, 10);

            \App\Models\Donation::factory($donationCount)->create([
                'campaign_id' => $campaign->id,
                'user_id' => rand(0, 1) ? $users->random()->id : null, // 50% chance user login / anonim
                'is_paid' => true
            ]);

            // Hitung ulang current_amount campaign berdasarkan donasi yang masuk
            $totalDonation = $campaign->donations()->where('is_paid', true)->sum('amount');
            $campaign->update(['current_amount' => $totalDonation]);
        }
    }
}
