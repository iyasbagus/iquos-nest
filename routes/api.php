<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/profile', [App\Http\Controllers\Api\ProfileController::class, 'indexProfile']);
    
    Route::get('/assets', [App\Http\Controllers\Api\AssetController::class, 'indexAssets']);
    Route::get('/assets/{id}', [App\Http\Controllers\Api\AssetController::class, 'showAssets']);

    Route::post('/logout', [AuthController::class, 'logout']);


    // Proteksi API Kategori
    Route::apiResource('/category', CategoryController::class)
        ->parameters(['category' => 'slug']);

    // // Route API Asset
    //  Route::apiResource('assets', AssetController::class);
    //     Route::get('assets/{id}/download', [AssetController::class, 'download']);
    //     Route::get('/assets/{id}/file', [AssetController::class, 'serveFile']);
});





// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::middleware('auth:sanctum')->group(function () {
//     Route::post('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
// });

// Route::middleware('auth:sanctum')->group(function () {
//     Route::apiResource('categories', CategoryController::class)->parameters(['categories' => 'slug']);
// });


