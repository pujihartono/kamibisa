<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDonationRequest;
use App\Models\Campaign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DonationController extends Controller
{
    //
    public function store(StoreDonationRequest $request,Campaign $campaign)
    {
        $validated = $request->validated();

        DB::transaction(function () use ($validated, $campaign) {
            // 1. Simpan Data Donasi
            $campaign->donations()->create([
                'user_id'     => Auth::id(),
                'donor_name'  => $validated['donor_name'],
                'donor_email' => $validated['donor_email'],
                'amount'      => $validated['amount'],
                'comment'     => $validated['comment'] ?? null,
                'is_paid'     => true, // Simulasi langsung lunas
            ]);

            // 2. Update Total Donasi di Campaign
            // Increment otomatis menambah value kolom
            $campaign->increment('current_amount', $validated['amount']);
        });

        return back()->with('success', 'Terima kasih atas donasi Anda!');
    }
}
