<?php
use App\Http\Controllers\ProductDetail;
use App\Http\Controllers\users\ProductController;
use App\Http\Controllers\users\CartController;
use App\Http\Controllers\users\ProductDetailController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\CustomerAuthController;
use App\Http\Controllers\users\CategoryController;
use App\Http\Controllers\admins\AdCategoryController;
use App\Http\Middleware\UserCheckLogin;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\admins\AdBrandController;
use App\Http\Controllers\admins\AdVoucherController;
use App\Http\Controllers\admins\AdProductController;
use App\Http\Controllers\admins\AdminAuthController;
use App\Http\Controllers\admins\AdProductDetailController;
use App\Http\Middleware\RedirectIfAdminAuthenticated;
use App\Http\Middleware\AdminAuth;
use App\Http\Controllers\both\OrderController;


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
Route::prefix('admin')->middleware([RedirectIfAdminAuthenticated::class])->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
});

Route::prefix('admin')->name('admin.')->middleware([AdminAuth::class])->group(function () {
    // Trang dashboard admin
    Route::get('/dashboard', [AdminAuthController::class, 'showDashboard'])->name('dashboard');
    // Trang đăng ký admin
    Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('register.submit');
    // Logout admin
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');



   
    // Quản lý thể loại sản phẩm 
    Route::get('/categories', [AdCategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [AdCategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [AdCategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{category_id}/edit', [AdCategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{category_id}', [AdCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category_id}', [AdCategoryController::class, 'destroy'])->name('categories.destroy');
 


    // ===== Brand CRUD Routes =====
        // Hiển thị danh sách và form thêm brand
        Route::get('products/brand', [AdBrandController::class, 'index'])
            ->name('products.brand.index');

        // Xử lý lưu brand mới
        Route::post('products/brand', [AdBrandController::class, 'store'])
            ->name('products.brand.store');

        // Hiển thị form edit brand
        Route::get('products/brand/{brand}/edit', [AdBrandController::class, 'edit'])
            ->name('products.brand.edit');

        // Xử lý cập nhật brand
        Route::put('products/brand/{brand}', [AdBrandController::class, 'update'])
            ->name('products.brand.update');

        // Xử lý xóa brand
        Route::delete('products/brand/{brand}', [AdBrandController::class, 'destroy'])
            ->name('products.brand.destroy');

    // Quản lý mã giảm giá
Route::get('products/vouchers', [AdVoucherController::class, 'index'])->name('products.voucher.index');

// Route tạo voucher mới
Route::post('products/vouchers', [AdVoucherController::class, 'store'])->name('products.voucher.store');

// Route hiển thị form chỉnh sửa voucher
Route::get('products/vouchers/{voucher}/edit', [AdVoucherController::class, 'edit'])->name('products.voucher.edit');

// Route cập nhật voucher
Route::put('products/vouchers/{voucher}', [AdVoucherController::class, 'update'])->name('products.voucher.update');

// Route xóa voucher
Route::delete('/admin/products/voucher/{id}', [AdVoucherController::class, 'destroy'])->name('products.voucher.destroy');


 // Trang quản lý sản phẩm
 Route::get('/products', [AdProductController::class, 'index'])->name('products.product');
    
 // Các route khác như create, edit, update, destroy... cho product 
//  Route::get('/products/create', [AdProductController::class, 'create'])->name('products.create');
 Route::post('/products', [AdProductController::class, 'store'])->name('products.store');
 Route::get('/products/{product_id}/edit', [AdProductController::class, 'edit'])->name('products.edit');
 Route::put('/products/{product_id}', [AdProductController::class, 'update'])->name('products.update');
 Route::delete('/products/{product_id}', [AdProductController::class, 'destroy'])->name('products.destroy');




// Route để xử lý việc bù hàng
Route::post('/products/{product_detail_id}/add-stock', [AdProductDetailController::class, 'addStock'])
    ->name('products.addStock');




 Route::get('products/{product_id}/details', [AdProductDetailController::class, 'index'])
 ->name('products.details.index');
 Route::post('products/{product_id}/details', [AdProductDetailController::class, 'store'])
 ->name('products.details.store');
 

 Route::put('/products/details/{productDetailId}/update-status', [AdProductDetailController::class, 'updateStatus'])
    ->name('products.details.updateStatus');  // Cập nhật trạng thái chi tiết sản phẩm

    Route::post('/products/details/{productDetailId}/restock', [AdProductDetailController::class, 'restock'])->name('product.restock');

    // Route cập nhật chi tiết sản phẩm
Route::put('/products/details/{product_detail_id}', [AdProductDetailController::class, 'update'])
->name('products.details.update');


//Route quản lý đơn hàng
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

// routes thay đổi trạng thái đơn hàng
Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])
     ->name('orders.updateStatus');

// routes thay đổi trạng thái thanh toán
Route::put('orders/{order}/payment-status', [OrderController::class, 'updatePaymentStatus'])
    ->name('orders.updatePaymentStatus');



    
});
