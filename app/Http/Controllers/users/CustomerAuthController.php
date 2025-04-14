<?php

namespace App\Http\Controllers\users; // Namespace của controller

use App\Http\Controllers\Controller; // Import class Controller
use Illuminate\Http\Request;
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
        if ($customer && Hash::check($credentials['password'], $customer->password)) {
            session(['customer' => $customer]); // Lưu thông tin người dùng vào session
            return redirect()->route('welcome'); // Chuyển hướng đến trang chính
        }

        return back()->with('error', 'Email hoặc mật khẩu không chính xác!'); // Thông báo lỗi
    }

    // Đăng xuất
    public function logout()
    {
        session()->forget('customer');
        return redirect()->route('welcome');
    }
}