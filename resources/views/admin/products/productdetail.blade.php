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
      <!-- Hiển thị tên sản phẩm trên tiêu đề -->
       <!-- Gọi f đầu tiên là ra 1 nhóm gọi f 2 là ra ctiet 1 -->
      <h1>Chi tiết sản phẩm: {{ $groupedProductDetails->first()->first()->pname }}</h1>





<!-- Thêm modal cho chi tiết sản phẩm -->
<div class="container mt-4">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productDetailModal">
        Thêm chi tiết sản phẩm
    </button>

    <!-- Modal -->
    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailModalLabel">Thêm chi tiết sản phẩm</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.products.details.store', ['product_id' => $product_id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="size" class="form-label">Kích thước</label>
                            <input type="text" class="form-control" id="size" name="size" required>
                        </div>

                        <div class="mb-3">
                            <label for="color" class="form-label">Màu sắc</label>
                            <input type="text" class="form-control" id="color" name="color" required>
                        </div>

                        <div class="mb-3">
                            <label for="cost" class="form-label">Giá vốn</label>
                            <input type="number" class="form-control" id="cost" name="cost" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="selling_price" class="form-label">Giá bán</label>
                            <input type="number" class="form-control" id="selling_price" name="selling_price" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="stock_quantity" class="form-label">Số lượng trong kho</label>
                            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" required>
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Hình ảnh sản phẩm</label>
                            <input type="file" class="form-control" id="images" name="images[]" multiple>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Đảm bảo đã thêm Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>


<!-- Đảm bảo đã thêm Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js"></script>



    <table class="table table-bordered table-striped align-middle">
        <thead class="table-white">
            <tr>
                <th>ID</th>
                <th>Size</th>
                <th>Màu</th>
                <th>Giá gốc</th>
                <th>Tồn kho</th>
                <th>Ảnh</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($groupedProductDetails as $productDetailId => $details)
                @php
                    $detail = $details->first();
                @endphp
                <tr>
                    <td>{{ $detail->product_detail_id }}</td>
                    <td>{{ $detail->size }}</td>
                    <td>{{ $detail->color }}</td>
                    <td>{{ number_format($detail->cost, 0, ',', '.') }} đ</td>
                    <td>{{ $detail-> stock_quantity }}11</td>
                    <td>
                        @if($detail->image_url)
                        <img src="{{ asset('storage/product_details/' . $image->image_url) }}" alt="Product Image" class="img-fluid">
                        @else
                            Không có ảnh
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $detail->status === 'available' ? 'bg-success' : 'bg-danger' }}">
                            {{ $detail->status === 'available' ? 'Còn hàng' : 'Ngừng bán' }}
                        </span>
                    </td>
                    <td>
                       

                       
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Chưa có chi tiết sản phẩm nào.</td>
                </tr>
            @endforelse
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