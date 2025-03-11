<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OwnerController;
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
    Route::get('/email/verify', [AuthController::class, 'showVerifyEmailNotice'])->name('auth.showVerifyEmailNotice');
    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->middleware(['signed'])->name('verification.verify');
    Route::get('/login', [AuthController::class, 'show'])->name('auth.show');
    Route::post('/login', [AuthController::class, 'store'])->name('auth.store');
});

Route::middleware(['auth', 'check.role:general'])->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('shop.index');
    Route::post('/logout', [AuthController::class, 'destroy'])->name('auth.destroy');
    Route::get('/mypage', [CustomerController::class, 'show'])->name('customer.show');
    Route::post('/like/{shop_id}', [ShopController::class, 'like'])->name('shop.like');
    Route::post('/reserve', [ShopController::class, 'reserve'])->name('shop.reserve');
    Route::delete('/reserve/{reservation_id}', [ReservationController::class, 'destroy'])->name('reservation.delete');
    Route::get('/done', [ShopController::class, 'done'])->name('shop.done');
    Route::get('/{shop_id}', [ShopController::class, 'detail'])->name('shop.detail');
});

Route::prefix('owner')->middleware('check.role:owner')->group(function () {
    Route::get('/login', [AuthController::class, 'showOwner'])->name('auth.showOwner');
    Route::post('/login', [AuthController::class, 'storeOwner'])->name('auth.storeOwner');
});

Route::prefix('owner')->middleware(['auth', 'check.role:owner'])->group(function () {
    Route::post('/logout', [AuthController::class, 'destroyOwner'])->name('auth.destroyOwner');
    Route::get('/shop/create', [ShopController::class, 'create'])->name('shop.create');
    Route::post('/shop/store', [ShopController::class, 'store'])->name('shop.store');
    Route::post('/shop/upload-temp-image', [ShopController::class, 'uploadTempImage'])->name('shop.uploadTempImage');
    Route::post('/shop/delete-temp-image', [ShopController::class, 'deleteTempImage'])->name('shop.deleteTempImage');
    Route::get('/shop/list', [ShopController::class, 'list'])->name('shop.list');
    Route::get('/shop/{shop_id}', [ShopController::class, 'edit'])->name('shop.edit');
    Route::put('/shop/{shop_id}', [ShopController::class, 'update'])->name('shop.update');
    Route::delete('/shop/delete/{shop_id}', [ShopController::class, 'destroy'])->name('shop.destroy');
    Route::get('/check-in', [ReservationController::class, 'showCheckIn'])->name('reservation.showCheckIn');
    Route::post('/check-in', [ReservationController::class, 'checkIn'])->name('reservation.checkIn');
    Route::get('/visited', [ReservationController::class, 'visited'])->name('reservation.visited');
    Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation.index');
});

Route::prefix('admin')->middleware('check.role:admin')->group(function () {
    Route::get('/login', [AuthController::class, 'showAdmin'])->name('auth.showAdmin');
    Route::post('/login', [AuthController::class, 'storeAdmin'])->name('auth.storeAdmin');
});

Route::prefix('admin')->middleware(['auth', 'check.role:admin'])->group(function () {
    Route::post('/logout', [AuthController::class, 'destroyAdmin'])->name('auth.destroyAdmin');
    Route::get('/owners', [OwnerController::class, 'index'])->name('owner.index');
    Route::get('/owners/create', [RegisterController::class, 'createOwner'])->name('register.createOwner');
    Route::post('/owners/store', [RegisterController::class, 'storeOwner'])->name('register.storeOwner');
    Route::delete('/owners/{user_id}', [RegisterController::class, 'destroyOwner'])->name('register.destroyOwner');
    Route::get('/annoucements/create', [AnnouncementController::class, 'create'])->name('announcement.create');
    Route::post('/annoucements/create', [AnnouncementController::class, 'send'])->name('announcement.send');
});
