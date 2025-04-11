<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\users\CustomerAuthController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');




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

// Route::prefix('admin')->group(function () {
//     // Đăng nhập
//     Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');





//     // Nhóm route yêu cầu đăng nhập admin
//     Route::middleware('admin.auth')->group(function () {
//         // Đăng ký
//     Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
//     Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register.submit');

//         Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

//         Route::get('/dashboard', function () {
//             return view('admin.dashboard');
//         })->name('admin.dashboard');

//         // Các route admin khác có thể thêm ở đây
//         // Route::resource('products', ProductController::class);
//     });
// });



// Route::prefix('admin')->group(function () {
//     Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');


//     Route::middleware('admin.auth')->group(function () {
//         Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
//         Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register.submit');
//         Route::get('/dashboard', function () {
//             return view('admin.dashboard');
//         })->name('admin.dashboard');

//         Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
//     });
// });


// Route::prefix('admin')->group(function () {
//     // Đăng nhập
//     Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
//     Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

//     // Đăng ký
//     Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
//     Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register.submit');

//     // Đăng xuất
//     Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

//     // Route cho trang Dashboard (sau khi đăng nhập, cần bảo vệ bằng middleware nếu cần)
//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     })->name('admin.dashboard')->middleware('admin.auth');
// });



// Admin auth routes
// Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
// Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// Route::get('/admin/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
// Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register.submit');

// Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');


Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::get('/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/register', [AdminAuthController::class, 'register'])->name('admin.register.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    Route::middleware(['Adm'])->group(function () {
        Route::get('/dashboard', function () {
            return 'Chào mừng ' . session('admin_name');
        })->name('admin.dashboard');
    });
});

// // Trang sau đăng nhập (tạm thời)
// Route::middleware(['Adm'])->group(function () {
//     Route::get('/admin/dashboard', function () {
//         return 'Chào mừng ' . session('admin_name');
// //     })->name('admin.dashboard');
// });

