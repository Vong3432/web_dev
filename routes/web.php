<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CouponsController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::resource('coupons', CouponsController::class);

Route::get('/', [ProductController::class, 'getAllProducts'])->name('products');
Route::get('/product/{id}', [ProductController::class, 'getSingleProduct'])->name('product.detail');

Route::get('/shop-grid', function () {
    return view('shop-grid');
});

Route::get('/cart', [ProductController::class, 'cart'])->name('cart');

Route::get('/contact', function () {
    return view('contact');
});


Route::get('/blog-single-sidebar', function () {
    return view('/blog-single-sidebar');
});

/* Route::post('/coupon', 'CouponsController@store')->name('coupon.store');
Route::delete('/coupon', 'CouponsController@destroy')->name('coupon.destroy'); */

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     if (Auth::user()->level === "admin")
//         return view('dashboard');
//     else
//         return redirect()->route('login');
// })->name('dashboard');

Route::get('add-to-cart/{id}', [ProductController::class, 'addToCart'])->name('cart.add');
Route::get('remove-item-from-cart/{id}', [ProductController::class, 'removeItemFromCart'])->name('cart.remove');
Route::get('remove-item-from-cart-completely/{id}', [ProductController::class, 'removeThisItemFromCart'])->name('cart.remove.completely');
Route::get('remove-items-from-cart', [ProductController::class, 'clearCart'])->name('cart.clear');
Route::get('cart', [ProductController::class, 'cart']);

// // For admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Order
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::post('/products/status/{id}', [ProductController::class, 'status'])->name('admin.products.status');

    Route::get('/products/edit/{id}', [ProductController::class, 'show'])->name('admin.products.edit'); 
    Route::post('/products/update/{id}', [ProductController::class, 'update'])->name('admin.products.update'); 
    // Products category
    Route::get('/product_category', [ProductCategoryController::class, 'index'])->name('admin.product_categories');
    Route::post('/product_category/store', [ProductCategoryController::class, 'store'])->name('admin.product_category.store');

    Route::get('/product_category/create', [ProductCategoryController::class, 'create'])->name('admin.product_category.create');
    Route::get('/product_category/edit/{id}', [ProductCategoryController::class, 'edit'])->name('admin.product_category.edit');
    Route::get('/product_category/edit/{id}', [ProductCategoryController::class, 'show'])->name('admin.product_category.edit');
    Route::post('/product_category/update/{id}', [ProductCategoryController::class, 'update'])->name('admin.product_category.update'); 
   
    // Coupons
    Route::get('/coupons', [CouponsController::class, 'index'])->name('admin.coupons');
    Route::get('/coupons/create', [CouponsController::class, 'create'])->name('admin.coupons.create');
    // Route::get('/coupons/update', [CouponsController::class, 'update'])->name('admin.coupons.update');
    Route::get('/coupons/edit/{coupon}', [CouponsController::class, 'edit'])->name('admin.coupons.edit');
    
    // Vouchers (Is commented because controller is not created)
    // Route::get('/vouchers', [VoucherController::class, 'index']);
    // Route::get('/vouchers/create', [VoucherController::class, 'create']);
    // Route::get('/vouchers/edit/{id}', [VoucherController::class, 'edit']); 


});

// For user
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/checkout', function () {
        return view('checkout');
    });

    Route::post('orders', [OrderController::class, 'store'])->name('order.add');
    Route::get('success-checkout', function() {
        return view('success-checkout');
    });

    Route::get('/my-orders', [OrderController::class, 'getOrdersByUser'])->name('orders.self');
});

