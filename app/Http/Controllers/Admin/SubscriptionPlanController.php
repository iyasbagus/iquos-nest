<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PremiumPayment;
use App\Models\SubscriptionPlan;
use App\Models\SubscriptionFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function showPlans()
    {
        $user = Auth::user();
        $plans = SubscriptionPlan::with('features')->get();
        return view('user.subscription.index', compact('plans', 'user'));
    }

    // Controller
    public function checkout(Request $request)
    {
        $user = Auth::user();
        $plan = SubscriptionPlan::findOrFail($request->plan);
        return view('user.subscription.checkout', compact('plan', 'user'));
    }
    // Controller
    public function pay(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'nullable',
            'reference_number' => 'nullable',
        ]);

        // dd($request->all());
        $plan = SubscriptionPlan::findOrFail($request->plan_id);

        PremiumPayment::create([
            'user_id' => Auth::id(),
            'plan_id' => $plan->id,
            'amount' => $plan->price * 1.11,
            'payment_method' => $request->payment_method,
            'status' => 'completed', // Atur nanti jika integrasi ke Tripay/Midtrans
            'transaction_date' => now(),
            'subscription_start' => now(),
            'subscription_end' => now()->addMonths($plan->duration),
        ]);

        return redirect()->route('welcome')->with('success', 'Selamat! Kamu sekarang user premium.');
    }

    public function history()
    {
        $user = Auth::user();
        $payments = Auth::user()->premiumPayments()->with('plan')->latest()->get();

        return view('user.subscription.history', compact('payments', 'user'));
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
