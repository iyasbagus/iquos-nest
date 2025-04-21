<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Asset;
use App\Models\Download;
use App\Models\Tag;
use App\Models\User;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ExploreController extends Controller
{
    use AuthorizesRequests;

    public function listAssetView(Request $request)
    {
        $query = Asset::query()->with('tags', 'media', 'creator')->where('status', 'active');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")->orWhereHas('tags', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%$search%");
                });
            });
        }

        $asset = $query->latest()->paginate(12);
        $tags = Tag::all();
        $category = Category::all();
        $user = Auth::user();

        return view('user.explore', compact('asset', 'tags', 'category', 'user'));
    }

    public function exploreAssets(Request $request)
    {
        $query = Asset::query()->with('tags', 'media', 'creator')->where('status', 'active');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")->orWhereHas('tags', function ($q2) use ($search) {
                    $q2->where('name', 'like', "%$search%");
                });
            });
        }

        $asset = $query->latest()->paginate(12);
        $tags = Tag::all();
        $category = Category::all();
        $user = Auth::user();

        return view('user.explored', compact('asset', 'tags', 'category', 'user'));
    }

    public function downloadImageById(Request $request)
    {
        $modelId = $request->query('modelId');
        $collectionName = $request->query('collection');
        $size = $request->query('size', 'original');

        // Cari media berdasarkan model_id dan collection_name
        $media = Media::where('model_id', $modelId)->where('collection_name', $collectionName)->first();

        if (!$media) {
            return abort(404, 'Media not found');
        }

        $asset = \App\Models\Asset::find($modelId);

        // Cek model asset-nya
        if (!$asset) {
            return abort(404, 'Aset tidak ditemukan.');
        }

        // Pilih path sesuai ukuran
        if ($size === 'small') {
            $path = $media->getPath('small');
        } elseif ($size === 'medium') {
            $path = $media->getPath('medium');
        } elseif ($size === 'large') {
            $path = $media->getPath('large');
        } else {
            $path = $media->getPath(); // original
        }

        // // Ambil path file
        // $path = $media->getPath();

        if (!file_exists($path)) {
            return abort(404, 'File not found');
        }

        return response()->download($path, $media->file_name);
    }

    public function downloadAssetFileById(Request $request)
    {
        $user = Auth::user();
        $modelId = $request->query('modelId');
        $collectionName = $request->query('collection');

        $asset = Asset::findOrFail($modelId);
        $today = now()->toDateString();

        // Cek apakah user premium
        $isPremium = $user->isPremium();

        // Ambil atau buat record download harian
        $record = \App\Models\DailyDownload::firstOrCreate(
            ['user_id' => $user->id, 'date' => $today],
            [
                'free_asset_ids' => json_encode([]),
                'premium_asset_ids' => json_encode([]),
            ],
        );

        $freeAssets = collect(json_decode($record->free_asset_ids, true));
        $premiumAssets = collect(json_decode($record->premium_asset_ids, true));

        if ($asset->is_premium_only) {
            // === PREMIUM ASSET ===

            if (!$isPremium) {
                return back()->with('error', 'Only premium users can download this asset.');
            }

            // Cek batas download premium harian
            $plan = $user->latestActivePremium();
            $maxPremiumDownloads = $plan?->max_downloads ?? 0;

            if ($asset->is_premium_only) {
                if (!$isPremium) {
                    return back()->with('error', 'Only premium users can download this asset.');
                }

                $premiumPayment = $user->latestActivePremium()->first();
                $plan = $premiumPayment?->plan;
                $maxPremiumDownloads = $plan?->max_downloads ?? 0;

                if (!$premiumAssets->contains($asset->id)) {
                    if ($premiumAssets->count() >= $maxPremiumDownloads) {
                        return back()->with('error', 'Kamu sudah mencapai batas download asset premium hari ini.');
                    }

                    $premiumAssets->push($asset->id);
                    $record->update([
                        'premium_asset_ids' => $premiumAssets->unique()->values()->toJson(),
                    ]);
                }
            }
        } else {
            // === FREE ASSET ===

            $maxFreeDownloads = $isPremium ? 100 : 10;

            if (!$freeAssets->contains($asset->id)) {
                if ($freeAssets->count() >= $maxFreeDownloads) {
                    return back()->with('error', 'Kamu sudah mencapai batas download asset gratis hari ini.');
                }

                $freeAssets->push($asset->id);
                $record->update([
                    'free_asset_ids' => $freeAssets->unique()->values()->toJson(),
                ]);
            }
        }

        // Simpan download ke tabel download unik
        $download = \App\Models\Download::firstOrCreate([
            'user_id' => $user->id,
            'asset_id' => $asset->id,
        ]);

        // === KOMISI CREATOR ===
        if ($asset->is_premium_only && $user->isPremium() && $download->wasRecentlyCreated) {
            $plan = $user->latestActivePremium()->first(); // relasi: PremiumPayment
            $revenuePercentage = $plan?->plan?->revenue_share_percentage ?? 0;
            $payment = $plan;

            if ($payment && $revenuePercentage) {
                // Total komisi per download unik
                $maxDownloads = $plan->plan->max_downloads ?: 1;
                $komisiPerDownload = ($payment->amount * ($revenuePercentage / 100)) / $maxDownloads;

                \App\Models\CreatorEarning::create([
                    'creator_id' => $asset->creator_id,
                    'asset_id' => $asset->id,
                    'downloaded_by' => $user->id,
                    'amount' => $komisiPerDownload,
                    'premium_payment_id' => $payment->id,
                ]);
            }
        }

        return $this->downloadMedia($asset, $collectionName);
    }

    private function downloadMedia($asset, $collection)
    {
        $media = $asset->getMedia($collection)->first();
        if (!$media) {
            abort(404, 'Media tidak ditemukan');
        }

        return response()->download($media->getPath(), $media->file_name);
    }
}
