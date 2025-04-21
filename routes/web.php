<?php

use App\Http\Controllers\ProfileController;
use App\Models\Category;

// untuk table admin
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\AssetAdminController;
use App\Http\Controllers\Admin\SubscriptionPlanController;
use App\Http\Controllers\Admin\UserController;

// untuk creator
use App\Http\Controllers\Creator\AssetController;

// untuk user
use App\Http\Controllers\User\ProfileUserController;
use App\Http\Controllers\User\HomeController;

// untuk tampilan
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\User\ExploreController;
use App\Http\Controllers\NotificationController;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\User\CreatorApplicationController;
use App\Http\Controllers\DownloadController;
use App\Http\Controllers\User\OtherUserController;
use App\Models\SubscriptionPlan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Profiler\Profile;

// Route::get('/', function () {
//     return view('welcome');
// });

 Route::get('/', [HomeController::class, 'index'])->name('welcome');

 Route::middleware(['role:creator|admin'])->group(function() {

    // Route untuk creator kelola asset dan Dashboard
    Route::resource('/creator/asset', AssetController::class);
    Route::get('/creator/dashboard', [DashboardController::class, 'creatorDashboard'])->name('creator.dashboard');
 });

Route::middleware('auth')->group(function () {
    // Route untuk explore asset
    Route::get('/explore-asset',[ExploreController::class, 'listAssetView'])->name('user.explore.listAssetView');
    Route::get('/explore-asset/explore',[ExploreController::class, 'exploreAssets'])->name('user.explore.assets');

    // Route download gambar dan file asset
    Route::get('/download-image',[ExploreController::class, 'downloadImageById'])->name('download.image');
    Route::get('/download-file-asset',[ExploreController::class, 'downloadAssetFileById'])->name('download.assets');

    // Route untuk user daftar sebagai creator
    Route::get('/creator/apply', [CreatorApplicationController::class, 'create'])->name('creator.apply');
    Route::post('/creator/apply',[CreatorApplicationController::class, 'store'])->name('creator.apply.store');

    // Route untuk logout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Route untuk profile user
    Route::get('/my-profile', [ProfileUserController::class, 'show'])->name('profileUser.show');
    Route::put('/my-profile/update-photo', [ProfileUserController::class, 'updatePhoto'])->name('profileUser.update.photo');
    Route::put('/my-profile/update-banner', [ProfileUserController::class, 'updateBanner'])->name('profileUser.update.banner');
    Route::put('/my-profile/update', [ProfileUserController::class, 'update'])->name('profileUser.update');
    Route::delete('/my-profile/update-photo', [ProfileUserController::class, 'deletePhoto'])->name('profileUser.delete.photo');
    Route::delete('/my-profile/update-banner', [ProfileUserController::class, 'deleteBanner'])->name('profileUser.delete.banner');

    // show profil creator
    Route::get('/creator/{username}', [OtherUserController::class, 'showOtherProfile'])->name('otherUser.profile');

    // list creator
     Route::get('/creator-list', [OtherUserController::class, 'index'])->name('creator-list.profile');

    // Route::get('/profile-user', [ProfileUserController::class, 'showProfile'])->name('profileUser.showProfile');
    // Route::get('/profile-user', [ProfileUserController::class, 'edit'])->name('profileUser.edit');
    // Route::patch('/profile-user', [ProfileUserController::class, 'update'])->name('profileUser.update');
    // Route::delete('/profile-user', [ProfileUserController::class, 'destroy'])->name('profileUser.destroy');

    Route::get('/notifications-user', [NotificationController::class, 'index'])->name('notifications.index');

    Route::get('/subscription', [SubscriptionPlanController::class, 'showPlans'])->name('subscription.premium');

    Route::get('/subscription/checkout', [SubscriptionPlanController::class, 'checkout'])->name('subscription.checkout');
    Route::post('/subscription/pay', [SubscriptionPlanController::class, 'pay'])->name('subscription.pay');
    Route::get('/subscription/history', [SubscriptionPlanController::class, 'history'])->name('subscription.history');
});

// Role nya admin
Route::middleware(['role:admin'])->group(function () {
    Route::resource('/admin/category', CategoryController::class);
    Route::resource('/admin/tag', TagController::class);
    Route::resource('/admin/subscription', SubscriptionPlanController::class);
    Route::resource('/admin/user', UserController::class);
    Route::resource('/admin/asset', AssetAdminController::class)->names([
        'index'   => 'adminAsset.index',
        'create'  => 'adminAsset.create',
        'store'   => 'adminAsset.store',
        'show'    => 'adminAsset.show',
        'edit'    => 'adminAsset.edit',
        'update'  => 'adminAsset.update',
        'destroy' => 'adminAsset.destroy',
    ]);

    Route::get('/admin/creator-applications', [CreatorApplicationController::class, 'index'])->name('creator-applications.index');
    Route::get('/admin/creator-applications/{application}', [CreatorApplicationController::class, 'show'])->name('creator-applications.show');
    Route::put('/admin/creator-applications/{id}/approve', [CreatorApplicationController::class, 'approve'])->name('creator-applications.approve');
    Route::put('/admin/creator-applications/{id}/reject', [CreatorApplicationController::class, 'reject'])->name('creator-applications.reject');

    // Route untuk profile admin
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route untuk lihat Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Tambahkan route untuk aktifkan asset punya creator
    Route::put('/admin/asset/{id}/active', [AssetAdminController::class, 'active'])
        ->name('admin.asset.active');

    // route untuk reject asset creator
    Route::put('/admin/asset/{id}/rejected', [AssetAdminController::class, 'rejected'])
        ->name('admin.asset.rejected');
});

Route::get('/img/assets/{filename}', function ($filename) {
    $path = storage_path('app/public/assets/images/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->make(file_get_contents($path), 200, [
        'Content-Type' => mime_content_type($path),
        'Access-Control-Allow-Origin' => '*',
    ]);
});

Route::get('/img/category/{imgname}', function ($imgname) {
    $path = storage_path('app/public/category/images/' . $imgname);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->make(file_get_contents($path), 200, [
        'Content-Type' => mime_content_type($path),
        'Access-Control-Allow-Origin' => '*',
    ]);
});

Route::get('/img/profile/{imgname}', function ($profilename) {
    $path = storage_path('app/public/assets/images/' . $profilename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->make(file_get_contents($path), 200, [
        'Content-Type' => mime_content_type($path),
        'Access-Control-Allow-Origin' => '*',
    ]);
});

Route::get('/unlink-storage', function () {
    $storagePath = public_path('storage');

    if (File::exists($storagePath)) {
        File::deleteDirectory($storagePath);
        return "Storage link berhasil dihapus.";
    }

    return "Storage link tidak ditemukan.";
});

require __DIR__ . '/auth.php';
