<?php
use App\Http\Controllers\ProductDetail;
use App\Http\Controllers\users\ProductController;
use App\Http\Controllers\users\CartController;
use App\Http\Controllers\users\ProductDetailController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\CustomerAuthController;
use App\Http\Controllers\users\CategoryController;
use App\Http\Middleware\UserCheckLogin;
use App\Http\Controllers\LoginController;

Route::get('/', [ProductController::class, 'index'])->name('welcome');
Route::get('/product-details/{id}', [ProductController::class, 'showDetail'])->name('product.details');



//Route cho khách hàng


Route::prefix('customer')->group(function () {

    Route::get('/login', [CustomerAuthController::class, 'showLoginForm'])
        ->middleware(UserCheckLogin::class)
        ->name('customer.login');
    Route::post('/login', [CustomerAuthController::class, 'login'])
        ->Middleware(UserCheckLogin::class);
    Route::get('/register', [CustomerAuthController::class, 'showRegisterForm'])->name('customer.register');
    Route::post('/register', [CustomerAuthController::class, 'register']);
    Route::post('/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');



});

// Route sp và giỏ hàng
Route::post('/cart/add', [CartController::class, 'addtocart'])->name('cart.add');
Route::get('/cart/count', [CartController::class, 'count'])->name('cart.count');
Route::get('/cart/list', [CartController::class, 'getList'])->name('cart.list');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');


//Route xem sp theo phân loại
    Route::get('product-category/{id}', [CategoryController::class, 'show'])
    ->name('category.products');

//Route chi tiết sp

Route::get('/product/{id}', [ProductDetailController::class, 'show'])->name('product.show');



//Route cho admin
use App\Http\Controllers\admins\AdminAuthController;
use App\Http\Middleware\RedirectIfAdminAuthenticated;
use App\Http\Middleware\AdminAuth;
Route::prefix('admin')->middleware([RedirectIfAdminAuthenticated::class])->group(function () {

});

Route::prefix('admin')->name('admin.')->middleware([AdminAuth::class])->group(function () {

    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    // Trang dashboard admin
    Route::get('/dashboard', [AdminAuthController::class, 'showDashboard'])->name('dashboard');
    // Trang đăng ký admin
    Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('register.submit');
    // Logout admin
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});



