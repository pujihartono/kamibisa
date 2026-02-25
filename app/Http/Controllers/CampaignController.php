<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCampaignRequest;
use App\Http\Requests\UpdateCampaignRequest;
use App\Models\Campaign;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $campaigns = $user->campaigns()->latest()->get();

        return view('dashboard.campaigns.index', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.campaigns.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCampaignRequest $request)
    {
        $validated = $request->validated();
        $validated['slug'] = Str::slug($validated['title']) . '-' . rand(1000, 9999);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('campaigns', 'public');
            $validated['image_path'] = $path;
        }

        $request->user()->campaigns()->create($validated);

        return redirect()->route('dashboard.campaigns.index')->with('success', 'Campaign created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Campaign $campaign)
    {
        $recentDonations = $campaign
            ->donations()
            ->where('is_paid', true)
            ->latest()
            ->take(10)
            ->get();

        return view('campaigns.show', compact('campaign', 'recentDonations'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Campaign $campaign)
    {
        //Cek terlebih dahulu apakah yang punya kampanye?
        if ($campaign->user_id != Auth::id()) {
            abort(403);
        }

        return view('dashboard.campaigns.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCampaignRequest $request, Campaign $campaign)
    {
        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('campaigns', 'public');
            $validated['image_path'] = $path;
        }
        $campaign->update($validated);

        return redirect()->route('dashboard.campaigns.index')->with('success', 'Campaign updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Campaign $campaign)
    {
        //Cek terlebih dahulu apakah yang punya kampanye?
        if ($campaign->user_id != Auth::id()) {
            abort(403);
        }
        $campaign->delete();

        return redirect()->route('dashboard.campaigns.index')->with('success', 'Campaign deleted successfully.');
    }
}
