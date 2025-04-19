<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Asset;
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

    public function listAssetView()
    {
        $user = Auth::user();
        $category = Category::all();
        $asset = Asset::with('tags', 'media', 'creator')->where('status', 'active')->get();
        $tags = Tag::all();

        return view('user.explore', compact('category', 'asset', 'tags', 'user'));
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
        \Log::info('User ID:', ['id' => $user->id]);
        $modelId = $request->query('modelId');
        $collectionName = $request->query('collection');

        $asset = Asset::findOrFail($modelId);

        // Premium user? Langsung boleh
        if ($user->isPremium()) {
            return $this->downloadMedia($asset, $collectionName);
        }

        // Kalau asset-nya premium → blok user free
        if ($asset->is_premium_only) {
            return back()->with('error', 'Hanya user premium yang bisa mendownload asset ini.');
        }

        // Cek record harian
        $today = now()->toDateString();
        $record = \App\Models\DailyDownload::firstOrCreate(['user_id' => $user->id, 'date' => $today], ['free_asset_ids' => json_encode([])]);

        $freeAssets = collect(json_decode($record->free_asset_ids, true));

        // Sudah download asset ini?
        if (!$freeAssets->contains($asset->id)) {
            if ($freeAssets->count() >= 10) {
                return back()->with('error', 'Kamu sudah mencapai batas download 10 asset hari ini.');
            }

            // Tambahkan asset ke list
            $freeAssets->push($asset->id);
            $record->update([
                'free_asset_ids' => $freeAssets->unique()->values()->toJson(),
            ]);
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
