<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\API\{
    PharmacyController,
    ProductController,
    ProductFaqController,
    SponsorController,
    ContactController,
    ProductRatingController,
};

// Admin Routes
Route::prefix('admin')->middleware('api')->group(function () {
    Route::post('/login', [AdminAuthController::class, 'login']);

    Route::middleware('auth:admins')->group(function () {
        Route::controller(AdminAuthController::class)->group(function () {
            Route::post('/add-admin', 'addAdmin');
            Route::get('/getaccount', 'getAccount');
            Route::get('/all-admins', 'allAdmins');
            Route::post('/logout', 'logout');
            Route::post('/refresh', 'refresh');
            Route::delete('/delete-admin/{id}', 'deleteAdmin');
        });
    });
});

// API Resources
Route::apiResources([
    'products' => ProductController::class,
    'sponsors' => SponsorController::class,
    'product-faqs' => ProductFaqController::class,
    'pharmacies' => PharmacyController::class,
    'contact-us' => ContactController::class,
    'product-rating' => ProductRatingController::class,
]);

// Update Routes for PATCH/PUT requests
Route::match(['post', 'put', 'patch'], 'contact-us/{id}/reply', [ContactController::class, 'reply']);
Route::match(['post', 'put', 'patch'], 'products/{id}', [ProductController::class, 'update']);
Route::match(['post', 'put', 'patch'], 'sponsors/{id}', [SponsorController::class, 'update']);
Route::match(['post', 'put', 'patch'], 'pharmacies/{id}', [PharmacyController::class, 'update']);
Route::match(['post', 'put', 'patch'], 'product-faqs/{id}', [ProductFaqController::class, 'update']);
