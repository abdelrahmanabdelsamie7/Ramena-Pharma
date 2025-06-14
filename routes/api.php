<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\API\PharmacyController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProductFaqController;
use App\Http\Controllers\API\SponsorController;

Route::middleware('api')->prefix('admin')->group(function () {
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::middleware('auth:admins')->group(function () {
        Route::post('/add', [AdminAuthController::class, 'addAdmin']);
        Route::get('/getaccount', [AdminAuthController::class, 'getAccount']);
        Route::post('/logout', [AdminAuthController::class, 'logout']);
        Route::post('/refresh', [AdminAuthController::class, 'refresh']);
        Route::delete('/delete-admin', [AdminAuthController::class, 'deleteAdmin']);
    });
});

Route::apiResource('products', ProductController::class);
Route::apiResource('sponsors', SponsorController::class);
Route::apiResource('product-faqs', ProductFaqController::class);
Route::apiResource('pharmacies', PharmacyController::class);

Route::match(['post', 'put', 'patch'], 'products/{id}', [ProductController::class, 'update']);
Route::match(['post', 'put', 'patch'], 'sponsors/{id}', [SponsorController::class, 'update']);
Route::match(['post', 'put', 'patch'], 'pharmacies/{id}', [PharmacyController::class, 'update']);