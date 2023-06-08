<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\UserController;
use \App\Http\Controllers\Api\ProductController;
use \App\Http\Controllers\Api\CategoryController;
use \App\Http\Controllers\Api\SlideController;
use \App\Http\Controllers\Api\CartController;
use \App\Http\Controllers\Api\InvoiceController;
use \App\Http\Controllers\Api\VoucherController;
use \App\Http\Controllers\Api\AddressController;
use \App\Http\Controllers\Api\RateController;
use \App\Http\Controllers\Api\InfoShopController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Product
Route::post('product-new-view', [ProductController::class, 'getAllNewProduct']);
Route::post('product-popular-view', [ProductController::class, 'getAllPopularProduct']);
Route::post('product-selling-view', [ProductController::class, 'getAllSellingProduct']);
Route::get('product-byid/{id}', [ProductController::class, 'getProductDetailById']);
Route::post('product-category-byid/{id}', [ProductController::class, 'getProductByProductCategory']);
Route::post('product-type-byid/{id}', [ProductController::class, 'getProductByProductType']);
Route::post('product-search/{key_search}', [ProductController::class, 'searchProduct']);
Route::get('product-type-search/{key_search}', [ProductController::class, 'searchProductType']);

//Rate
Route::post('rate-of-product', [RateController::class, 'getAllRateOfProduct']);

//Category
Route::get('category', [CategoryController::class, 'getAllCategory']);

//Slide
Route::get('slide-show', [SlideController::class, 'getAllSlideShow']);
Route::get('slide-show-detail/{id}', [SlideController::class, 'getAllSlideShowDetail']);

//User
Route::post('login', [UserController::class, 'login']);
Route::post('register', [UserController::class, 'register']);
Route::post('forgot-pass', [UserController::class, 'forgotPass']);
Route::post('request-otp', [UserController::class, 'requestOtp']);
Route::post('verify-otp', [UserController::class, 'verifyOtp']);
Route::post('login-with-google', [UserController::class, 'loginWithGoogle']);

//InfoShop
Route::get('info-shop', [InfoShopController::class, 'getInfoShop']);

//Authorization
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::delete('logout', [UserController::class, 'logout']);
    Route::get('user-info', [UserController::class, 'info']);
    Route::post('change_pass', [UserController::class, 'changePass']);
    Route::post('change-info', [UserController::class, 'changeInfo']);
    Route::post('change-avatar', [UserController::class, 'changeAvatar']);
    Route::post('like', [ProductController::class, 'likeProduct']);
    Route::get('product-like', [ProductController::class, 'getAllProductLike']);
    Route::post('rate-product', [RateController::class, 'rateProduct']);
    Route::post('edit-rate-product', [RateController::class, 'editRateProduct']);
    Route::get('product-cart', [CartController::class, 'getAllCartProduct']);
    Route::post('add-cart', [CartController::class, 'addCart']);
    Route::post('update-cart', [CartController::class, 'updateCart']);
    Route::delete('delete-cart', [CartController::class, 'deleteCart']);
    Route::get('invoice-list', [InvoiceController::class, 'getAllInvoice']);
    Route::get('invoice-detail/{id}', [InvoiceController::class, 'getInvoiceDetail']);
    Route::post('add-invoice', [InvoiceController::class, 'addInvoice']);
    Route::post('cancel-invoice', [InvoiceController::class, 'cancelInvoice']);
    Route::get('voucher-list', [VoucherController::class, 'getAllVoucher']);
    Route::get('address-list', [AddressController::class, 'getAllAddress']);
    Route::post('add-address', [AddressController::class, 'addNewAddress']);
    Route::post('edit-address', [AddressController::class, 'editAddress']);
    Route::delete('delete-address', [AddressController::class, 'deleteAddress']);
    Route::post('send-feedback', [UserController::class, 'sendFeedback']);
    Route::get('product-not-yed-rated', [RateController::class, 'getProductNotYedRated']);
    Route::get('product-rated', [RateController::class, 'getProductRated']);
    Route::get('rated-detail/{id}', [RateController::class, 'getRatedDetail']);
});
