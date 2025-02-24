<?php

use App\Http\Controllers\AccessoryCategoryController;
use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\GameCategoryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\VNPayController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

// middleware
// you have to login to access these pages | cần login để vào mấy trang này
Route::prefix("/admin")->middleware(AuthMiddleware::class)->group(function () {
    // admin
    Route::get('/dashboard', [MenuController::class, 'dashboard'])->name('menu.dashboard');

    // game routes
    Route::get('/game', [GameController::class, 'index'])->name('game.index');

    Route::get('/game/create', [GameController::class, 'create'])->name('game.create');
    Route::post('/game/create', [GameController::class, 'store'])->name('game.store');
    Route::get('/game/edit/{id}', [GameController::class, 'edit'])->name('game.edit');
    Route::post('/game/edit/{games}', [GameController::class, "update"])->name("game.update");

    Route::get('/games/set-todays-pick/{id}', [GameController::class, 'setTodaysPick'])->name('game.setTodaysPick');

    // game category routes
    Route::get('/gamecate', [GameCategoryController::class, 'index'])->name('gamecategory.index');
    Route::get('/gamecate/create', [GameCategoryController::class, 'create'])->name('gamecategory.create');
    Route::post('/gamecate/create', [GameCategoryController::class, 'store'])->name('gamecategory.store');

    // accessory routes
    Route::get('/accessory', [AccessoryController::class, 'index'])->name('accessory.index');
    Route::get('/accessory/create', [AccessoryController::class, 'create'])->name('accessory.create');
    Route::post('/accessory/create', [AccessoryController::class, 'store'])->name('accessory.store');
    Route::get('/accessory/delete/{id}', [AccessoryController::class, 'delete'])->name('accessory.delete');
    Route::get('/accessory/edit/{id}', [AccessoryController::class, 'edit'])->name('accessory.edit');
    Route::post('/accessory/edit/{accessories}', [AccessoryController::class, "update"])->name("accessory.update");

    // accessory category routes
    Route::get('/accessorycate', [AccessoryCategoryController::class, 'index'])->name('accessorycategory.index');
    Route::get('/accessorycate/create', [AccessoryCategoryController::class, 'create'])->name('accessorycategory.create');
    Route::post('/accessorycate/create', [AccessoryCategoryController::class, 'store'])->name('accessorycategory.store');
});

// the same is true for user | user tương tự yêu cầu login
Route::prefix("/user")->middleware(AuthMiddleware::class)->group(function () {
    // user
    Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
    Route::post('/profile/update', [AccountController::class, 'updateProfile'])->name('profile.update');

    // cart
    Route::get('/cart', [AddToCartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [AddToCartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/update', [AddToCartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove', [AddToCartController::class, 'removeCart'])->name('cart.remove');
    Route::delete('/cart/clear', [AddToCartController::class, 'clearCart'])->name('cart.clear');

    //payment
    Route::post('/user/momo_payment', [PaymentController::class, 'momoPayment'])->name('momo-payment');
    Route::get('/user/invoices', [InvoiceController::class, 'index'])->name('user.invoices');
    Route::get('/payment/result', [PaymentController::class, 'handlePaymentResult'])->name('payment.result');



});

// login & register
Route::get('/login', [AccountController::class, 'login'])->name('account.login');
Route::post('/login', [AccountController::class, 'checkLogin'])->name('account.checkLogin');
Route::get('/register', [AccountController::class, 'register'])->name('account.register');
Route::post('/register', [AccountController::class, 'registerPost'])->name('account.registerPost');
Route::post('/logout', [AccountController::class, 'logout'])->name('account.logout');

Route::get('/account', [AccountController::class, 'index'])->name('account.index');

// otp register
Route::get('/otp-register', [AccountController::class, 'viewOTPRegister'])->name('account.OTPregister');
Route::post('/otp-register', [AccountController::class, 'verifyOTPRegister'])->name('account.verifyOTPRegister');
Route::get('/resend-otp', [AccountController::class, 'resendOTP'])->name('account.resendOTP');

// menu routes
Route::get('/', [MenuController::class, 'menu'])->name('menu.index');
Route::get('/contact', [MenuController::class, 'contact'])->name('menu.contact');
Route::get('/gameshop', [MenuController::class, 'gameshop'])->name('menu.gameshop');
Route::get('/accessoryshop', [MenuController::class, 'accessoryshop'])->name('menu.accessoryshop');
Route::get('/gamedetails/{id}', [MenuController::class, 'gamedetails'])->name('menu.gamedetails');
Route::get('/accessorydetails/{id}', [MenuController::class, 'accessorydetails'])->name('menu.accessorydetails');

Route::get('/search-results', [MenuController::class, 'search-results'])->name('menu.search-results');
Route::get('/search', [MenuController::class, 'search'])->name('menu.search');
