<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Admin Register</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4" style="width: 500px;">
            <h2 class="card-title text-center mb-4">Đăng ký Admin</h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.register.submit') }}">
                @csrf

                <div class="mb-3">
                    <label for="code" class="form-label">Mã nhân viên (code)</label>
                    <input type="text" name="code" id="code" value="{{ old('code') }}" required class="form-control">
                </div>

                <div class="mb-3">
                    <label for="full_name" class="form-label">Họ tên</label>
                    <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" required class="form-control">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" required class="form-control">
                </div>

                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <textarea name="address" id="address" class="form-control">{{ old('address') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="birth" class="form-label">Ngày sinh</label>
                    <input type="date" name="birth" id="birth" value="{{ old('birth') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="hire_date" class="form-label">Ngày vào làm</label>
                    <input type="date" name="hire_date" id="hire_date" value="{{ old('hire_date') }}" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Mật khẩu</label>
                    <input type="password" name="password" id="password" required class="form-control">
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="form-label">Nhập lại mật khẩu</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required class="form-control">
                </div>

                <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
            </form>

            <div class="mt-3 text-center">
                Đã có tài khoản? <a href="{{ route('admin.login') }}">Đăng nhập</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
