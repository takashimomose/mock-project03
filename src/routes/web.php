<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ShopController;
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

Route::group([], function () {
    Route::get('/register', [RegisterController::class, 'show'])->name('register.show');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
    Route::get('/thanks', [RegisterController::class, 'thanks'])->name('register.thanks');

    Route::get('/login', [AuthController::class, 'show'])->name('auth.show');
    Route::post('/login', [AuthController::class, 'store'])->name('auth.store');
    Route::post('/logout', [AuthController::class, 'destroy'])->name('auth.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('shop.index');
    Route::get('/mypage', [CustomerController::class, 'show'])->name('customer.show');
    Route::post('/like/{shop_id}', [ShopController::class, 'like'])->name('shop.like');
    Route::post('/reserve', [ShopController::class, 'reserve'])->name('shop.reserve');
    Route::delete('/reserve/{reservation_id}', [ReservationController::class, 'destroy'])->name('reservation.delete');
    Route::get('/done', [ShopController::class, 'done'])->name('shop.done');
    Route::get('/{shop_id}', [ShopController::class, 'detail'])->name('shop.detail');
    Route::get('/shop/create', [ShopController::class, 'show'])->name('shop.show');
    Route::post('/shop/store', [ShopController::class, 'store'])->name('shop.store');
    Route::post('/shop/image-temp-upload', [ShopController::class, 'tempUpload'])->name('shop.image-temp-upload');
    Route::post('/shop/delete-image', [ShopController::class, 'deleteTempImage'])->name('shop.delete-image');
});