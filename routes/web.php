<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('index');
})->name('/');

Route::get('/shop-grid', function () {
    return view('shop-grid');
});

Route::get('/cart', function () {
    return view('cart');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::get('/checkout', function () {
    return view('checkout');
});

Route::get('/blog-single-sidebar', function () {
    return view('/blog-single-sidebar');
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     if (Auth::user()->level === "admin")
//         return view('dashboard');
//     else
//         return redirect()->route('login');
// })->name('dashboard');

// For user
// Route::middleware(['auth:sanctum', 'verified'])->group( function () {
    
// });

// // For admin
Route::middleware(['auth:sanctum', 'verified', 'authadmin'])->group( function () {
    Route::get('/dashboard', function() {        
        return view('admin.dashboard');
    })->name('dashboard');  
    
    // Order
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');

    // Products
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::get('/products/edit/{id}', [ProductController::class, 'edit'])->name('admin.products.edit'); 

    // Vouchers (Is commented because controller is not created)
    // Route::get('/vouchers', [VoucherController::class, 'index']);
    // Route::get('/vouchers/create', [VoucherController::class, 'create']);
    // Route::get('/vouchers/edit/{id}', [VoucherController::class, 'edit']); 
    
    
});
