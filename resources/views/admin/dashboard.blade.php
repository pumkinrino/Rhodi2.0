

<div class="container mt-5">
    <h1>Chào mừng {{ session('admin')->full_name ?? 'Admin' }} đến trang quản trị!</h1>
    <a href="{{ route('admin.logout') }}"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
       class="btn btn-danger mt-3">Đăng xuất</a>

    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
