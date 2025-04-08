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

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DownloadController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

// Route::get('/', function () {
//     return view('welcome');
// });

 Route::get('/', [HomeController::class, 'index'])->name('welcome');

 Route::middleware(['role:creator|admin'])->group(function() {
    Route::resource('/creator/asset', AssetController::class);
    Route::get('/creator/dashboard', [DashboardController::class, 'creatorDashboard'])->name('creator.dashboard');
 });

Route::middleware('auth')->group(function () {
    Route::get('/explore-asset',[ExploreController::class, 'listAssetView'])->name('user.explore.listAssetView');
    Route::get('/download-image',[ExploreController::class, 'downloadImageById'])->name('download.image');
    Route::get('/download-file-asset',[ExploreController::class, 'downloadAssetFileById'])->name('download.assets');

    //Lgout
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::get('/profile-user', [ProfileUserController::class, 'showProfile'])->name('profileUser.showProfile');
    Route::get('/profile-user', [ProfileUserController::class, 'edit'])->name('profileUser.edit');
    Route::patch('/profile-user', [ProfileUserController::class, 'update'])->name('profileUser.update');
    Route::delete('/profile-user', [ProfileUserController::class, 'destroy'])->name('profileUser.destroy');
});

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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


    // Tambahkan route untuk aktifkan aset
    Route::put('/admin/asset/{id}/active', [AssetAdminController::class, 'active'])
        ->name('admin.asset.active');

    // route untuk reject
    Route::put('/admin/asset/{id}/rejected', [AssetAdminController::class, 'rejected'])
        ->name('admin.asset.rejected');
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
