<?php
use App\Http\Controllers\users\ProductController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\CustomerAuthController;
use App\Http\Controllers\users\CategoryController;
use App\Http\Middleware\UserCheckLogin;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\users\CartController;

Route::get('/', function () {
    $products = (new ProductController)->index();
    $cart = (new CartController)->index();

    return view('welcome', compact('products', 'cart')); // Trả về view với dữ liệu
})->name('welcome');

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


//Route Cho sản phẩm và giỏ hàng


Route::get('product-category/{id}', [ProductController::class, 'showWithCate'])
    ->name('category.products');


Route::get('product-category/{id}', [CategoryController::class, 'show'])
    ->name('category.products');




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



