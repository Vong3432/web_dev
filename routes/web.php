<?php

use Illuminate\Support\Facades\Route;

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
});

Route::get('/shop-grid', function() {
    return view('shop-grid');
});

Route::get('/cart', function() {
    return view('cart');
});

Route::get('/contact', function() {
    return view('contact');
});

Route::get('/checkout', function() {
    return view('checkout');
});

Route::get('/blog-single-sidebar', function() {
    return view('/blog-single-sidebar');
});