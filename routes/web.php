<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Customer\PayPalPaymentController;
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
    return view('welcome2');
});
Route::group(['namespace' => 'Customer', 'middleware' => ['auth:sanctum', 'customer','verified'], 'prefix' => 'customer', 'as' => 'customer.'], function () {
    Route::get('/dashboard', function () {
        return view('customer.customer-dashboard');
    })->name('dashboard');
});
Route::group(['namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth:sanctum', 'admin','verified'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/dashboard', [DashboardController::Class,'index'])->name('dashboard');
    Route::resource('product-categories',ProductCategoryController::Class);
    Route::resource('products',ProductController::Class);
    Route::resource('orders',OrderController::class);
    Route::resource('bills',BillController::class);
    Route::resource('product-images',ProductImageController::Class)->only(['store','destroy']);
    Route::resource('customers',CustomerController::Class)->only(['index','show']);
    Route::resource('admins',AdminController::Class)->except(['edit','update']);
});
Route::group(['namespace' => 'App\Http\Controllers\Customer', 'middleware' => ['auth:sanctum', 'customer','verified'], 'prefix' => 'customer', 'as' => 'customer.'], function () {
    Route::resource('carts',CartController::Class);
    Route::resource('wishlist',WishlistController::Class);
    Route::resource('orders',OrderController::Class);
    Route::resource('bills',BillController::class);
    Route::resource('shipping',ShippingController::class);
    Route::resource('checkout',CheckoutController::Class)->only(['index']);
    Route::post('/create-payment', [PayPalPaymentController::Class,'create'])->name('payment.create');
    Route::get('/execute-payment', [PayPalPaymentController::Class,'execute'])->name('payment.execute');
    Route::get('/payment-success', [PayPalPaymentController::Class,'paymentSuccess'])->name('payment.success');
    Route::get('/cancel-payment', [PayPalPaymentController::Class,'paymentCancel'])->name('payment.cancel');

});

Route::resource('products',\App\Http\Controllers\ProductController::class);



