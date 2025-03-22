<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\SubscriptionPlan;
use App\Models\SubscriptionFeature;
use Illuminate\Http\Request;

class SubscriptionPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $plans = SubscriptionPlan::with('features')->get();
        return view('admin.premium.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.premium.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:subscription_plans,name',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|integer|min:1',
            'max_downloads' => 'required|integer|min:1',
            'revenue_share_percentage' => 'nullable|numeric|min:0|max:100',
            'features' => 'nullable|array',
        ]);

        $plan = SubscriptionPlan::create([
            'name' => $request->name,
            'price' => $request->price,
            'duration' => $request->duration,
            'max_downloads' => $request->max_downloads,
            'revenue_share_percentage' => $request->revenue_share_percentage,
        ]);

        // Tambahkan fitur jika ada
        if ($request->features) {
            foreach ($request->features as $feature) {
                SubscriptionFeature::create([
                    'subscription_plan_id' => $plan->id,
                    'feature' => $feature,
                ]);
            }
        }

        return redirect()->route('subscription.index')->with('success', 'Paket langganan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    // public function show($id)
    // {
    //     $plans = SubscriptionPlan::where('id', $id)->firstOrFail();
    //     return view('admin.premium.index', compact('plans'));
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubscriptionPlan $subscription_plans)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $plans = SubscriptionPlan::findOrFail($id);
        $plans->update($request->only(['name', 'price', 'duration', 'max_downloads', 'revenue_share_percentage']));

        // Hapus fitur lama dan tambahkan yang baru
        $plans->features()->delete();
        if ($request->features) {
            foreach ($request->features as $feature) {
                if (!empty($feature)) {
                    SubscriptionFeature::create([
                        'subscription_plan_id' => $plans->id,
                        'feature' => $feature,
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $plans = SubscriptionPlan::FindOrFail($id);
        $plans->delete();

        return redirect()->route('subscription.index')->with('success', 'data berhasil dihapus');
    }
}
