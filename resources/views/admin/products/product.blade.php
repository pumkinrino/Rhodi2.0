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




                    <!-- Button mở modal -->
                    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#addProductModal">
                        Thêm sản phẩm
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <form action="{{ route('admin.products.store') }}" method="POST"
                                enctype="multipart/form-data" class="modal-content">
                                @csrf
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addProductModalLabel">Thêm sản phẩm mới</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Đóng"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="pname" class="form-label">Tên sản phẩm</label>
                                        <input type="text" class="form-control" name="pname" id="pname" required>
                                    </div>

                                    <div class="mb-3">
                                        <label for="category_id" class="form-label">Danh mục</label>
                                        <select name="category_id" id="category_id" class="form-select" required>
                                            <option value="">-- Chọn danh mục --</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->category_id }}">{{ $category->category_name }}
                                                    - {{ $category->category_detail_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="brand_id" class="form-label">Thương hiệu</label>
                                        <select name="brand_id" id="brand_id" class="form-select" required>
                                            <option value="">-- Chọn thương hiệu --</option>
                                            @foreach($brands as $brand)
                                                <option value="{{ $brand->brand_id }}">{{ $brand->brand_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="status" class="form-label">Trạng thái</label>
                                        <select name="status" id="status" class="form-select" required>
                                            <option value="active">Hoạt động</option>
                                            <option value="inactive">Không hoạt động</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="main_image" class="form-label">Ảnh đại diện (tùy chọn)</label>
                                        <input type="file" class="form-control" name="main_image" id="main_image"
                                            accept=".jpg,.jpeg,.png,.webp">
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    <button type="submit" class="btn btn-success">Lưu sản phẩm</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <form method="GET" action="{{ route('admin.products.product') }}" class="row g-3 mb-4">
    <div class="col-4">
        <input 
            type="text" 
            name="search" 
            class="form-control" 
            placeholder="Tìm kiếm sản phẩm dựa theo tên, chi tiết thể loại hoặc brand..." 
            value="{{ request('search') }}"
        >
    </div>

    <div class="col-auto">
        <select name="per_page" class="form-select" onchange="this.form.submit()">
            <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10 sản phẩm/trang</option>
            <option value="15" {{ request('per_page') == 15 ? 'selected' : '' }}>15 sản phẩm/trang</option>
            <option value="20" {{ request('per_page') == 20 ? 'selected' : '' }}>20 sản phẩm/trang</option>
        </select>
    </div>

    <div class="col-auto">
        <button type="submit" class="btn btn-primary">Tìm kiếm</button>
    </div>
</form>
                    <!-- Bảng sản phẩm -->

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Thương hiệu</th>
                                <th>Trạng thái</th>
                                <th>Ảnh sản phẩm</th>
                                <th>Chi tiết sản phẩm</th>
                                <th>Thao tác</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $product)
                           
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->pname }} </td>
                                    <td>{{ $product->category_name }} - {{ $product->category_detail_name }}</td>
                                    <td>{{ $product->brand_name }}</td>
                                    <td>{{ $product->status }}</td>
                                    <td>
                                  
        @if($product->main_image)
      <img src="{{ asset('storage/' . $product->main_image) }}" alt="Product Image" width="80"
      class="rounded object-cover" />

    @else
    <span>No Image</span>
  @endif
  <td>
                                         <a href="{{ route('admin.products.details.index', ['product_id' => $product->product_id]) }}">📋 Detail
                                    List {{ $product->product_id }}</a>
                                </td>
  
        </td>
                               
                                    <td>
                                            <!-- Nút xóa -->
                                            <form action="{{ route('admin.products.destroy', $product->product_id) }}"
                                            method="POST" style="display:inline-block;"
                                            onsubmit="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                                        </form>

                                        <!-- Nút chỉnh sửa -->
                                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editProductModal{{ $product->product_id }}">
                        Sửa
                    </button>       
                                        <!-- Modal chỉnh sửa -->

@foreach($products as $product)
<div class="modal fade" id="editProductModal{{ $product->product_id }}" tabindex="-1" aria-labelledby="editProductModalLabel{{ $product->product_id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel{{ $product->product_id }}">Chỉnh sửa sản phẩm</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.products.update', $product->product_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Tên sản phẩm -->
                    <div class="mb-3">
                        <label for="pname" class="form-label">Tên sản phẩm</label>
                        <input type="text" class="form-control" id="pname" name="pname" value="{{ old('pname', $product->pname) }}" required>
                    </div>

                    <!-- Danh mục -->
                    <div class="mb-3">
                        <label for="category_id" class="form-label">Danh mục</label>
                        <select class="form-select" id="category_id" name="category_id" required>
                            @foreach($categories as $category)
                                <option value="{{ $category->category_id }}" {{ $product->category_id == $category->category_id ? 'selected' : '' }}>
                                    {{ $category->category_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Thương hiệu -->
                    <div class="mb-3">
                        <label for="brand_id" class="form-label">Thương hiệu</label>
                        <select class="form-select" id="brand_id" name="brand_id" required>
                            @foreach($brands as $brand)
                                <option value="{{ $brand->brand_id }}" {{ $product->brand_id == $brand->brand_id ? 'selected' : '' }}>
                                    {{ $brand->brand_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Trạng thái -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Trạng thái</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Ảnh chính sản phẩm -->
                    <div class="mb-3">
                        <label for="main_image" class="form-label">Ảnh chính</label>
                        <input type="file" class="form-control" id="main_image" name="main_image">
                        @if($product->main_image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $product->main_image) }}" alt="Current image" style="max-width: 100px;">
                            </div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
                                        <!-- Kết thúc modal chỉnh sửa -->
                                    </td>
   
                                  
                                </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                    <!-- Kết thúc bảng -->

                </div>

{{-- Bootstrap 5 pagination --}}
<div class="d-flex justify-content-center mt-4">
    {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
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