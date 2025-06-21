<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\API\{PharmacyController, PharmacyProductController, ProductController, ProductFaqController, SponsorController, ContactController};

Route::middleware('api')->prefix('admin')->group(function () {
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::middleware('auth:admins')->group(function () {
        Route::post('/add-admin', [AdminAuthController::class, 'addAdmin']);
        Route::get('/getaccount', [AdminAuthController::class, 'getAccount']);
        Route::get('/all-admins', [AdminAuthController::class, 'allAdmins']);
        Route::post('/logout', [AdminAuthController::class, 'logout']);
        Route::post('/refresh', [AdminAuthController::class, 'refresh']);
        Route::delete('/delete-admin/{id}', [AdminAuthController::class, 'deleteAdmin']);
    });
});

Route::apiResource('products', ProductController::class);
Route::apiResource('sponsors', SponsorController::class);
Route::apiResource('product-faqs', ProductFaqController::class);
Route::apiResource('pharmacies', PharmacyController::class);
Route::apiResource('contact-us', ContactController::class);

Route::prefix('pharmacy-product')->group(function () {
    Route::post('/', [PharmacyProductController::class, 'store']);
    Route::delete('/pharmacy/{pharmacyId}/product/{productId}', [PharmacyProductController::class, 'destroy']);
});


Route::match(['post', 'put', 'patch'], 'contact-us/{id}/reply', [ContactController::class, 'reply']);
Route::match(['post', 'put', 'patch'], 'products/{id}', [ProductController::class, 'update']);
Route::match(['post', 'put', 'patch'], 'sponsors/{id}', [SponsorController::class, 'update']);
Route::match(['post', 'put', 'patch'], 'pharmacies/{id}', [PharmacyController::class, 'update']);
Route::match(['post', 'put', 'patch'], 'product-faqs/{id}', [ProductFaqController::class, 'update']);
