<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BannedWordController;
use App\Http\Controllers\AuthController;

use App\Http\Controllers\CommentController;


Route::get('/', [WelcomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



Route::get('/shop', [WelcomeController::class, 'shop'])->name('shop.index');
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::resource('blogs', BlogController::class);
Route::get('/blogs/detail/{id}', [WelcomeController::class, 'detail'])->name('blogs.detail');

Route::resource('words', BannedWordController::class);
Route::resource('comments', CommentController::class);

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

// blog user
Route::get('/shop/create', [WelcomeController::class, 'create'])->name('shop.create');
Route::post('/shop/store', [WelcomeController::class, 'store'])->name('shop.store');
Route::get('/shop/edit/{id}', [WelcomeController::class, 'edit'])->name('shop.edit');
Route::post('shop/update/{id}', [WelcomeController::class, 'update'])->name('shop.update');



// Route for updating the blog status
Route::put('blogs/{id}/updateStatus', [BlogController::class, 'updateStatus'])->name('blogs.updateStatus');
