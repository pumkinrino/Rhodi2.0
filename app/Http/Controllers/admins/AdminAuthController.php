<?php

namespace App\Http\Controllers\admins;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Admin;

class AdminAuthController extends Controller
{
    // Hiển thị form đăng ký
    public function showRegisterForm()
    {
        return view('components.admin.registerform');
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|unique:admin,code',
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|unique:admin,email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'birth' => 'nullable|date',
            'hire_date' => 'nullable|date',
            'password' => 'required|string|min:6|confirmed'

        ],['code.required' => 'Mã nhân viên là bắt buộc.',
                'code.unique' => 'Mã nhân viên đã tồn tại.',
                'full_name.required' => 'Họ và tên là bắt buộc.',
                'email.required' => 'Email là bắt buộc.',
                'email.email' => 'Email không hợp lệ.',
                'email.unique' => 'Email đã tồn tại.',
                'phone.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
                'birth.date' => 'Ngày sinh không hợp lệ.',
                'hire_date.date' => 'Ngày tuyển dụng không hợp lệ.',
                'password.required' => 'Mật khẩu là bắt buộc.',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
                'password.confirmed' => 'Xác nhận mật khẩu không khớp.'
                
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Admin::create([
            'code' => $request->code,
            'full_name' => $request->full_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'birth' => $request->birth,
            'hire_date' => $request->hire_date,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.login')->with('success', 'Đăng ký thành công. Mời bạn đăng nhập.');
    }

    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('components.admin.loginform');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $admin = Admin::where('email', $credentials['email'])->first();

        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            return back()->withErrors(['email' => 'Thông tin không chính xác.'])->withInput();
        }

        Session::put('admin_id', $admin->admin_id);
        Session::put('admin_name', $admin->full_name);

        return redirect()->route('admin.dashboard')->with('success', 'Đăng nhập thành công.');
    }

    public function showDashboard()
    {
        $admin = Admin::find(Session::get('admin_id'));
        return view('admin.dashboard', compact('admin'));
    }
    


    // Đăng xuất
    public function logout()
    {
        Session::forget(['admin_id', 'admin_name']);
        return redirect()->route('admin.login')->with('success', 'Đã đăng xuất.');
    }
}
