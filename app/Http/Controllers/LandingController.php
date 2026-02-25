<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    //
    public function index()
    {
        // Mengambil 6 campaign aktif terbaru
        $featuredCampaigns = Campaign::active()->latest()->take(6)->get();

        return view('welcome', compact('featuredCampaigns'));
    }
}
