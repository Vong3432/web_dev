<?php

use App\Events\OrderReceived;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Import Controller
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\CouponsController;
use App\Http\Controllers\NotificationController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Orders
Route::resource('orders', OrderController::class);
Route::get('test-my-order', [OrderController::class, 'getOrdersByUser']);
Route::post('test-my-email', [OrderController::class, 'testEmail']);

// Product Cate
Route::resource('productscategory', ProductCategoryController::class);

// Product 
Route::resource('products', ProductController::class);

// Product Image
Route::resource('productimgs', ProductImageController::class);

// Coupon
Route::resource('coupons', CouponsController::class);

// Test Notifications (Pusher)
Route::get('/notifications', [NotificationController::class, 'index']);