<?php

use App\Models\Campaign;

test('user can make a donation', function () {
    $user = \App\Models\User::factory()->create();

    $campaign = \App\Models\Campaign::factory()->create([
        'target_amount' => 100000,
        'current_amount' => 0,
    ]);

    $response = $this->actingAs($user)
        ->post(route('donations.store', $campaign->id),
            [
                'amount' => 50000,
                'comment' => 'Semoga berkah!',
                // Field lain jika ada validasi (misal donor_name otomatis dari user auth)
                'donor_name' => $user->name,
                'donor_email' => $user->email,
            ]
        );

    // 3. ASSERT: Cek hasil
        // Pastikan redirect sukses (biasanya ke halaman detail atau success page)
        // Code 302 artinya redirect
        $response->assertStatus(302);
        $response->assertSessionHas('success'); // Pastikan ada flash message

    // Cek database apakah data donasi masuk
    $this->assertDatabaseHas('donations', [
        'campaign_id' => $campaign->id,
        'user_id' => $user->id,
        'amount' => 50000,
        //'comment' => 'Semoga berkah!',
    ]);

    // Cek apakah current_amount di campaign bertambah
    expect($campaign->fresh()->current_amount)->toBe('50000.00');
});

test('guest cannot donate without logging in', function () {
    $campaign = Campaign::factory()->create();
    // Coba akses sebagai guest (tanpa actingAs)
        $response = $this->post(route('donations.store', $campaign->id), [
            'amount' => 10000,
        ]);
    // Harusnya diredirect ke halaman login
        $response->assertRedirect(route('login'));
    // Pastikan tidak ada donasi masuk
        $this->assertDatabaseCount('donations', 0);
});
