<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE | Dashboard v3</title>


    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="AdminLTE | Dashboard v3" />
    <meta name="author" content="ColorlibHQ" />
    <meta name="description"
        content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
    <meta name="keywords"
        content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />

    @include('components.admin.linkLTE')

    @vite(['resources/css/cssadminlte/adminlte.css', 'resources/js/jsadminlte/adminlte.js'])
</head>

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
        <!--begin::Header-->
        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->

            @include('components.admin.headnav')

            <!--end::Container-->
        </nav>
        <!--end::Header-->
        <!--begin::Sidebar-->

        @include('components.admin.sidebar')




        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                    </div>



                    <!-- Nội dung chín -->
                    <div class="container mt-4">
    <h1 class="mb-4">Quản lý Phương thức Thanh toán</h1>

    <!-- Nút Thêm mới -->
    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addMethodModal">Thêm mới</button>

    <!-- Bảng hiển thị -->
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Tên Phương thức</th>
                <th>Mô tả</th>
                <th>Trạng thái</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($paymentMethods as $paymentMethod)
                <tr>
                    <td>{{ $paymentMethod->payment_method_id }}</td>
                    <td>{{ $paymentMethod->method_name }}</td>
                    <td>{{ $paymentMethod->description }}</td>
                    <td>
                        <span class="badge {{ $paymentMethod->status == 'active' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($paymentMethod->status) }}
                        </span>
                    </td>
                    <td>
                        <!-- Nút Sửa -->
                        <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editMethodModal-{{ $paymentMethod->payment_method_id }}">Sửa</button>

                        <!-- Nút Xóa -->
                        <form action="{{ route('admin.payment-methods.destroy', $paymentMethod->payment_method_id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                        </form>
                    </td>
                </tr>

                <!-- Modal Sửa -->
                <div class="modal fade" id="editMethodModal-{{ $paymentMethod->payment_method_id }}" tabindex="-1" aria-labelledby="editMethodLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <form action="{{ route('admin.payment-methods.update', $paymentMethod->payment_method_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editMethodLabel">Sửa Phương thức Thanh toán</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="method_name" class="form-label">Tên Phương thức</label>
                                        <input type="text" name="method_name" class="form-control" value="{{ $paymentMethod->method_name }}" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Mô tả</label>
                                        <textarea name="description" class="form-control" rows="3">{{ $paymentMethod->description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Trạng thái</label>
                                        <select name="status" class="form-select">
                                            <option value="active" {{ $paymentMethod->status == 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $paymentMethod->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Thêm mới -->
    <div class="modal fade" id="addMethodModal" tabindex="-1" aria-labelledby="addMethodLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.payment-methods.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMethodLabel">Thêm Phương thức Thanh toán</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="method_name" class="form-label">Tên Phương thức</label>
                            <input type="text" name="method_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Trạng thái</label>
                            <select name="status" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Thêm mới</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


                        <!-- Phân trang Bootstrap -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $paymentMethods->links('pagination::bootstrap-5') }}
                        </div>
                    </div>


                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->

            <div class="app-content">

                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">




                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->





            <!--end::App Content-->


        </main>
        <!--end::App Main-->
    </div>
    <!--begin::Footer-->
    <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
            Copyright &copy; 2014-2024&nbsp;
            <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
    </footer>
    <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/browser/overlayscrollbars.browser.es6.min.js"
        integrity="sha256-dghWARbRe2eLlIJ56wNB+b760ywulqK3DzZYEpsg2fQ=" crossorigin="anonymous"></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
        crossorigin="anonymous"></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="../../dist/js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
        const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
        const Default = {
            scrollbarTheme: 'os-theme-light',
            scrollbarAutoHide: 'leave',
            scrollbarClickScroll: true,
        };
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
            if (sidebarWrapper && typeof OverlayScrollbarsGlobal?.OverlayScrollbars !== 'undefined') {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: Default.scrollbarTheme,
                        autoHide: Default.scrollbarAutoHide,
                        clickScroll: Default.scrollbarClickScroll,
                    },
                });
            }
        });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->

    </style>
</body>
<!--end::Body-->

</html>