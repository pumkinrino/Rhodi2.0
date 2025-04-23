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
                    <!-- Nút mở modal -->
                    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                        Thêm danh mục
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <form id="categoryForm" method="POST" action="{{ route('admin.categories.store') }}">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Thêm danh mục</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="category_name" class="form-label">Tên danh mục</label>
                                            <input type="text" class="form-control" id="category_name"
                                                name="category_name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="category_detail_name" class="form-label">Mô tả</label>
                                            <textarea class="form-control" id="category_detail_name"
                                                name="category_detail_name" required></textarea>
                                        </div>
                                        <div id="errorMessages" class="text-danger"></div>
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


                    <!-- Table hiển thị danh mục -->
                    <table class="table table-bordered" id="categoryTable">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tên danh mục</th>
                                <th>Mô tả</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{ $category->category_id}}</td>
                                    <td>{{ $category->category_name }}</td>
                                    <td>{{ $category->category_detail_name }}</td>
                                    <td>
                                        <!-- Nút Chỉnh sửa -->
                                        <!-- Trong vòng lặp mỗi category -->
                                        <button class="btn btn-primary btn-edit" data-id="{{ $category->category_id }}"
                                            data-name="{{ $category->category_name }}"
                                            data-detail="{{ $category->category_detail_name }}" data-bs-toggle="modal"
                                            data-bs-target="#editCategoryModal">
                                            ✏️ Sửa
                                        </button>

                                        <!-- Modal -->
                                        <!-- Modal Sửa Danh Mục -->
                                        <div class="modal fade @if(isset($showEditModal) && $showEditModal) show d-block @endif"
                                            id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel"
                                            style="@if(isset($showEditModal) && $showEditModal) display: block; background: rgba(0,0,0,0.5); @endif"
                                            aria-modal="true" role="dialog">

                                            <div class="modal-dialog">
                                                <form method="POST"
                                                    action="{{ route('admin.categories.update', $category->category_id ?? '') }}">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Sửa danh mục</h5>
                                                            <a href="{{ route('admin.categories.index') }}"
                                                                class="btn-close"></a>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label>Tên danh mục</label>
                                                                <input type="text" name="category_name"
                                                                    value="{{ old('category_name', $category->category_name ?? '') }}"
                                                                    class="form-control">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label>Chi tiết danh mục</label>
                                                                <input type="text" name="category_detail_name"
                                                                    value="{{ old('category_detail_name', $category->category_detail_name ?? '') }}"
                                                                    class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-success">Cập nhật</button>
                                                            <a href="{{ route('admin.categories.index') }}"
                                                                class="btn btn-secondary">Đóng</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>



                                        <!-- Nút Xóa -->
                                        <form action="{{ route('admin.categories.destroy', $category->category_id) }}"
                                            method="POST" style="display:inline;"
                                            onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này không?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">🗑️ Xóa</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>


                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
    </div>
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
    </div>
    <!--end::App Content-->
    </main>
    <!--end::App Main-->
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#categoryForm').submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: "{{ route('admin.categories.store') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function (response) {
                    // 1. Đóng modal
                    $('#addCategoryModal').modal('hide');

                    // 2. Reset form
                    $('#categoryForm')[0].reset();

                    // 3. Reload table hoặc append dòng mới
                    location.reload(); // Hoặc bạn append bằng JS cho mượt

                    // 4. Thông báo thành công (nếu cần)
                    alert('Thêm danh mục thành công!');
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.errors;
                    let msg = "";
                    $.each(errors, function (key, value) {
                        msg += `<p>${value}</p>`;
                    });
                    $('#errorMessages').html(msg);
                }
            });
        });
    </script>
<style>
    .modal-backdrop {
        display: none !important;
    }
</style>

</body>
<!--end::Body-->

</html>