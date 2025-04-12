<?php
use App\Http\Controllers\users\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\CustomerAuthController;
use App\Http\Controllers\users\CategoryController;


Route::get('/', [ProductController::class, 'index'])->name('welcome');
Route::get('/product-details/{id}', [ProductController::class, 'showDetail'])->name('product.details');


Route::get('product-category/{id}', [ProductController::class, 'showWithCate'])
    ->name('category.products');


Route::get('product-category/{id}', [CategoryController::class, 'show'])
    ->name('category.products');

//Route cho khách hàng


Route::prefix('customer')->group(function () {

    Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
    Route::post('/login', [CustomerAuthController::class, 'login']);
    Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
    Route::post('/register', [CustomerAuthController::class, 'register']);
    Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');



});


//Route Cho giỏ hàng







//Route cho admin
use App\Http\Controllers\admins\AdminAuthController;


Route::prefix('admin')->middleware(['web'])->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');


});


use App\Http\Kernel;

Route::get('/test', function () {
    dd(app()->make(Kernel::class)->getRouteMiddleware());
});

use App\Http\Middleware\AdminAuth;

Route::middleware(['web', AdminAuth::class])->group(function () {
    //hiển thị trang dashboard admin
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/dashboard', [AdminAuthController::class, 'showDashboard'])->name('admin.dashboard');



    //hiển thị trang đăng ký và xử lý đăng ký admin
    Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register.submit');
    //hiển thị logout khi đã đăng nhập
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});


