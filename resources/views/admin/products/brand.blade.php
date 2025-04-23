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

                    <!-- Nút để mở Modal Thêm Thương Hiệu -->
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addBrandModal">Thêm
                        Thương Hiệu</button>

                    <!-- Modal Thêm Thương Hiệu -->
                    <div class="modal fade" id="addBrandModal" tabindex="-1" aria-labelledby="addBrandModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('admin.products.brand.store') }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="addBrandModalLabel">Thêm Thương Hiệu</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="brand_name" class="form-label">Tên Thương Hiệu</label>
                                            <input type="text" class="form-control" id="brand_name" name="brand_name"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">Mô Tả</label>
                                            <textarea class="form-control" id="description"
                                                name="description"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Lưu</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    {{-- Bảng danh sách brands --}}
                    <table class="table table-bordered" id="brandTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên Thương Hiệu</th>
                                <th>Mô tả</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($brands as $brand)
                                <tr>
                                    <td>{{ $brand->brand_id }}</td>
                                    <td>{{ $brand->brand_name }}</td>
                                    <td>{{ $brand->description }}</td>
                                    <td>
                                        <!-- Nút để mở Modal Sửa Thương Hiệu -->
                                        <button class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editBrandModal-{{ $brand->brand_id }}"> ✏️ Sửa</button>

                                        <!-- Modal Sửa Thương Hiệu -->
                                        <div class="modal fade" id="editBrandModal-{{ $brand->brand_id }}" tabindex="-1"
                                            aria-labelledby="editBrandModalLabel-{{ $brand->brand_id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('admin.products.brand.update', $brand->brand_id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title"
                                                                id="editBrandModalLabel-{{ $brand->brand_id }}">Sửa Thương
                                                                Hiệu</h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="brand_name" class="form-label">Tên Thương
                                                                    Hiệu</label>
                                                                <input type="text" class="form-control" id="brand_name"
                                                                    name="brand_name"
                                                                    value="{{ old('brand_name', $brand->brand_name) }}"
                                                                    required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="description" class="form-label">Mô Tả</label>
                                                                <textarea class="form-control" id="description"
                                                                    name="description">{{ old('description', $brand->description) }}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-success">Cập Nhật</button>
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Đóng</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>

                                        {{-- Xóa --}}
                                        <form action="{{ route('admin.products.brand.destroy', $brand->brand_id) }}"
                                            method="POST" class="d-inline"
                                            onsubmit="return confirm('Bạn có chắc muốn xóa thương hiệu này không?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">🗑️Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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


</body>
<!--end::Body-->

</html>