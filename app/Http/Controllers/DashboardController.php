<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

        $campaignsCount = $user->campaigns()->count();
        $totalDonationsReceived = $user->campaigns()->sum('current_amount');
        $totalContributed = $user->donations()->where('is_paid', true)->sum('amount');

        return view('dashboard.index', compact('campaignsCount', 'totalDonationsReceived', 'totalContributed'));
    }

    public function donations()
    {

    }
}
