<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\DailyDownload;

use Spatie\MediaLibrary\Support\PathGenerator\PathGenerator;
use App\MediaLibrary\CustomPathGenerator;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PathGenerator::class, CustomPathGenerator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('*', function ($view) {
            $user = Auth::user();
            $remainingFreeDownloads = null;
            $remainingPremiumDownloads = null;

            if ($user) {
                $today = now()->toDateString();
                $record = DailyDownload::where('user_id', $user->id)->where('date', $today)->first();

                $freeDownloaded = $record ? count(json_decode($record->free_asset_ids ?? '[]', true)) : 0;
                $premiumDownloaded = $record ? count(json_decode($record->premium_asset_ids ?? '[]', true)) : 0;

                // Hitung limit free download per hari
                $freeLimit = $user->isPremium() ? 100 : 10;
                $remainingFreeDownloads = max(0, $freeLimit - $freeDownloaded);

                // Hitung limit premium download per hari (hanya untuk user premium)
                if ($user->isPremium()) {
                    $activeSub = $user->latestActivePremium()->first();
                    $maxPremium = $activeSub?->plan?->max_downloads ?? 0;

                    $remainingPremiumDownloads = max(0, $maxPremium - $premiumDownloaded);
                }
            }

            // Inject ke semua view
            $view->with([
                'remainingFreeDownloads' => $remainingFreeDownloads,
                'remainingPremiumDownloads' => $remainingPremiumDownloads,
            ]);
        });
    }
}
