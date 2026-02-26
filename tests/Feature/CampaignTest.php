<?php

use App\Models\Campaign;
use App\Models\User;

test('campaign belongs to a user', function () {
    //Membuat user
    $user = User::factory()->create();

    // Membuat Kampanye dengan id user sebelumnya
    $campaign = Campaign::factory()->create([
        'user_id' => $user->id,
    ]);

    expect($campaign->user)->toBeInstanceOf(User::class)
        ->and($campaign->user->id)->toBe($user->id);
});

test('it can calculate simple progress percentage', function () {
    // Skenario: Target 10jt, Terkumpul 5jt. Progress harusnya 50%.
        $campaign = Campaign::factory()->create([
            'target_amount' => 10000000,
            'current_amount' => 5000000,
        ]);
    // Asumsi create logic getProgressPercentageAttribute() di model Campaign di Modul 4
    // Jika menggunakan custom logic, kita bisa test di sini
    $percentage = ($campaign->current_amount / $campaign->target_amount) * 100;
    expect($percentage)->toBe(50.0);
});
