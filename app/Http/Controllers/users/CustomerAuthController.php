<?php

namespace App\Http\Controllers\users; // Namespace của controller
use Illuminate\Http\Request;
use App\Http\Controllers\Controller; // Import class Controller
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Customer;

class CustomerAuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('welcome'); // Trả về view chứa cả hai form
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|unique:customer,email',
            'phone' => 'nullable|string|max:11', // Thêm quy tắc cho số điện thoại
            'address' => 'nullable|string|max:255', // Thêm quy tắc cho địa chỉ
            'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            // dd($validator->errors());
            return back()->withErrors($validator)->withInput();
        }
        try {
            Customer::create([
                'full_name' => $request->full_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ]);
            // dd($request);

        } catch (\Exception $e) {
            // dd($e->getMessage());
            return back()->with('error', 'Đã xảy ra lỗi trong quá trình đăng ký. Vui lòng thử lại .');

        }

        return redirect()->route('customer.login')->with('success', 'Đăng ký thành công! Vui lòng đăng nhập.');
    }

    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('welcome'); // Trả về view chứa cả hai form
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        // Kiểm tra xem người dùng có tồn tại không
        $customer = Customer::where('email', $credentials['email'])->first();

        // Kiểm tra mật khẩu
        if (Auth::guard('customer')->attempt($credentials)) {
            session(['customer' => $customer]); // Lưu thông tin người dùng vào session
            return back()->with('success', 'welcome to our shop'); // Chuyển hướng đến trang chính
        }

        return back()->with('error', 'Email or Password incorrect!'); // Thông báo lỗi
    }

    // Đăng xuất
    public function logout(request $request)
    {
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        Auth::logout();
        return redirect()->route('welcome')->with("success",'logged out');

    }
}