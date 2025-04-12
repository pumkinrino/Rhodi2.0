<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto py-8">
        <header class="bg-white shadow rounded p-6 mb-6 text-center">
            <h1 class="text-3xl font-bold text-indigo-600">Chào mừng {{ Session::get('admin_name') }}</h1>
            <p class="text-gray-600">Mã Admin: <strong>{{ Session::get('admin_id') }}</strong></p>

            <a href="{{ route('admin.logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="btn btn-danger mt-3">Đăng xuất</a>

    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
        </header>
        
        <div class="bg-white shadow rounded p-6">
            <h2 class="text-2xl font-bold mb-4">Thông tin cá nhân</h2>
            <ul class="space-y-4">
                <li><strong>Email:</strong> {{ $admin->email }}</li>
                <li><strong>Họ và tên:</strong> {{ $admin->full_name }}</li>
                <li><strong>Số điện thoại:</strong> {{ $admin->phone }}</li>
                <li><strong>Địa chỉ:</strong> {{ $admin->address }}</li>
                <li><strong>Ngày sinh:</strong> {{ $admin->birth }}</li>
                <li><strong>Ngày nhận việc:</strong> {{ $admin->hire_date }}</li>
            </ul>
        </div>

        <footer class="mt-8 text-center text-gray-600">
            &copy; 2025 Quản trị hệ thống. Tất cả các quyền được bảo lưu.
        </footer>
    </div>
</body>
</html>
