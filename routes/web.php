<?php

use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Creator\AssetController;
use App\Http\Controllers\Admin\AssetAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/creator/dashboard', function () {
    return view('creator.dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('creator.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::resource('/admin/category', CategoryController::class);
    Route::resource('/admin/tag', TagController::class);
    Route::resource('/creator/asset', AssetController::class);
    Route::resource('/admin/asset', AssetAdminController::class)->names([
        'index' => 'adminAsset.index',
        'create' => 'adminAsset.create',
        'store' => 'adminAsset.store',
        'show' => 'adminAsset.show',
        'edit' => 'adminAsset.edit',
        'update' => 'adminAsset.update',
        'destroy' => 'adminAsset.destroy',
    ]);

    // Tambahkan route untuk aktifkan aset
    Route::put('/admin/asset/{id}/active', [AssetAdminController::class, 'active'])
        ->name('admin.asset.active');

    // route untuk reject
    Route::put('/admin/asset/{id}/rejected', [AssetAdminController::class, 'rejected'])
        ->name('admin.asset.rejected');
});

require __DIR__ . '/auth.php';
