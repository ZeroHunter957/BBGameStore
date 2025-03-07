<?php

use App\Http\Controllers\AccessoryCategoryController;
use App\Http\Controllers\AccessoryController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddToCartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\GameCategoryController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogUserController;
use App\Http\Controllers\BannedWordController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\VNPayController;
use App\Http\Controllers\WishlistController;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

// middleware
// you have to login to access these pages | cần login để vào mấy trang này
Route::prefix("/admin")->middleware(AuthMiddleware::class)->group(function () {
    // admin
    Route::get('/dashboard', [MenuController::class, 'dashboard'])->name('menu.dashboard');
//coupon
    Route::post('/coupon/{id}/send', [CouponController::class, 'send'])->name('coupon.send');
    Route::prefix('admin')->group(function () {
        Route::get('/coupon/{id}/recipients', [CouponController::class, 'selectRecipients'])->name('coupon.selectRecipients');
    });
        Route::post('/coupon/{id}/send', [CouponController::class, 'send'])->name('coupon.send');
        Route::post('/coupons/{id}/send', [CouponController::class, 'send'])->name('coupons.send');

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
Route::get('/gamecate/{id}/edit', [GameCategoryController::class, 'edit'])->name('gamecategory.edit');
Route::put('/gamecate/{id}', [GameCategoryController::class, 'update'])->name('gamecategory.update');

    // accessory routes
    Route::get('/accessory', [AccessoryController::class, 'index'])->name('accessory.index');
    Route::get('/accessory/create', [AccessoryController::class, 'create'])->name('accessory.create');
    Route::post('/accessory/create', [AccessoryController::class, 'store'])->name('accessory.store');
    Route::get('/accessory/delete/{id}', [AccessoryController::class, 'delete'])->name('accessory.delete');
    Route::get('/accessory/edit/{id}', [AccessoryController::class, 'edit'])->name('accessory.edit');
    Route::post('/accessory/edit/{accessories}', [AccessoryController::class, "update"])->name("accessory.update");
    Route::resource('blogs', BlogController::class);
    Route::put('blogs/{id}/updateStatus', [BlogController::class, 'updateStatus'])->name('blogs.updateStatus');

    Route::resource('words', BannedWordController::class);
    Route::resource('comments', CommentController::class);

    // accessory category routes
    Route::get('/accessorycate', [AccessoryCategoryController::class, 'index'])->name('accessorycategory.index');
    Route::get('/accessorycate/create', [AccessoryCategoryController::class, 'create'])->name('accessorycategory.create');
    Route::get('/accessorycategory/{id}/edit', [AccessoryCategoryController::class, 'edit'])->name('accessorycategory.edit');

    Route::post('/accessorycate/create', [AccessoryCategoryController::class, 'store'])->name('accessorycategory.store');

    Route::get('/feedbacks', [FeedbackController::class, 'index'])->name('feedbacks.index');
    Route::delete('/feedbacks/{feedbackId}/deleteByAdmin', [FeedbackController::class, 'deleteByAdmin'])->name('feedbacks.deleteByAdmin');
});

// the same is true for user | user tương tự yêu cầu login
Route::prefix("/user")->middleware(AuthMiddleware::class)->group(function () {
    // user
    Route::get('/profile', [AccountController::class, 'profile',])->name('account.profile');
    Route::post('/profile/update', [AccountController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/update/password', [AccountController::class, 'updatePassword'])->name('password.update-password');

    Route::get('/profile/feedbacks', [AccountController::class, 'getFeedbacks'])->name('profile.feedbacks');

    //oder
    Route::middleware(['auth'])->group(function () {
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    });
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    

    // cart
    Route::get('/cart', [AddToCartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [AddToCartController::class, 'addToCart'])->name('cart.add');
    Route::put('/cart/update', [AddToCartController::class, 'updateCart'])->name('cart.update');
    Route::delete('/cart/remove', [AddToCartController::class, 'removeCart'])->name('cart.remove');
    Route::delete('/cart/clear', [AddToCartController::class, 'clearCart'])->name('cart.clear');

    //payment
    Route::post('/momo_payment', [PaymentController::class, 'momoPayment'])->name('momo-payment');
    Route::get('/invoices', [InvoiceController::class, 'index'])->name('user.invoices');
    Route::get('/payment/result', [PaymentController::class, 'handlePaymentResult'])->name('payment.result');

    //wishlist
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add/{productId}', [WishlistController::class, 'addToWishlist'])->name('wishlist.add');
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'removeFromWishlist'])->name('wishlist.remove');

    Route::post('/apply-coupon', [CouponController::class, 'applyCoupon'])->name('apply.coupon');
});
//apply coupon

// login & register
Route::get('/login', [AccountController::class, 'login'])->name('account.login');
Route::post('/login', [AccountController::class, 'checkLogin'])->name('account.checkLogin');
Route::get('/register', [AccountController::class, 'register'])->name('account.register');
Route::post('/register', [AccountController::class, 'registerPost'])->name('account.registerPost');
Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');

Route::get('/account', [AccountController::class, 'index'])->name('account.index');
//fogot password
Route::get('/forgot-password', [AccountController::class, 'showForgotPasswordForm'])->name('account.forgot-password');
Route::post('/forgot-password', [AccountController::class, 'sendResetLink'])->name('account.send-reset-link');
Route::get('/reset-password/{token}', [AccountController::class, 'showResetForm'])->name('account.reset-password');
Route::post('/reset-password', [AccountController::class, 'resetPassword'])->name('account.update-password');

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

Route::get('/blogusers/blogdetails/{id}', [BlogUserController::class, 'show'])->name('blogusers.show');
Route::resource('blogusers', BlogUserController::class);


/// COMMENTS
Route::post('/blogs/{blog_id}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::post('comment/{comment}/like', [CommentController::class, 'like'])->name('comment.like');
Route::post('comment/{comment}/reply', [CommentController::class, 'reply'])->name('comment.reply');

Route::delete('/comment/{commentId}', [CommentController::class, 'delete'])->name('comment.delete');
Route::delete('/comment/reply/{replyId}', [CommentController::class, 'deleteReply'])->name('comment.deleteReply');

Route::post('/comment/reply/{replyId}/like', [CommentController::class, 'likeReply'])->name('comment.likeReply');

Route::post('/comment/{commentId}/like', [CommentController::class, 'like'])->name('comment.like');
Route::post('/reply/{replyId}/like', [CommentController::class, 'likeReply'])->name('comment.likeReply');

Route::get('/blog/{id}', [BlogController::class, 'show']);
Route::delete('/comments/{commentId}/deleteByAdmin', [CommentController::class, 'deleteByAdmin'])->name('comments.deleteByAdmin');
Route::get('/coupon', [CouponController::class, 'index'])->name('coupon.index');
Route::get('/coupon/create', [CouponController::class, 'create'])->name('coupon.create');
Route::post('/coupon', [CouponController::class, 'store'])->name('coupon.store');
Route::get('/coupon/{id}/edit', [CouponController::class, 'edit'])->name('coupon.edit');
Route::put('/coupon/{id}', [CouponController::class, 'update'])->name('coupon.update');
Route::delete('/coupon/{id}', [CouponController::class, 'destroy'])->name('coupon.destroy');
///////GAME
Route::post('/games/{game_id}/feedbacks', [FeedbackController::class, 'storeFeedback'])->name('feedback.storeFeedback');
Route::post('feedback/{feedback}/likeFeedback', [FeedbackController::class, 'likeFeedback'])->name('feedback.likeFeedback');
Route::post('feedback/{feedback}/replyFeedback', [FeedbackController::class, 'replyFeedback'])->name('feedback.replyFeedback');

Route::delete('/feedback/{feedbackId}', [FeedbackController::class, 'deleteFeedback'])->name('feedback.deleteFeedback');
Route::delete('/feedback/replyFeedback/{replyFeedbackId}', [FeedbackController::class, 'deleteReplyFeedback'])->name('feedback.deleteReplyFeedback');

Route::post('/feedback/replyFeedback/{replyFeedbackId}/likeFeedback', [FeedbackController::class, 'likeReplyFeedback'])->name('feedback.likeReplyFeedback');

Route::post('/feedback/{feedbackId}/likeFeedback', [FeedbackController::class, 'likeFeedback'])->name('feedback.likeFeedback');
