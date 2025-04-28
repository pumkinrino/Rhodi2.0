<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE | Dashboard v3</title>


    <!--begin::Primary Meta Tags-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

                    @if($lowStockAlert)
    <div class="alert alert-warning">
        {{ $lowStockAlert }}
    </div>
@endif

                    <!-- Nội dung chín -->


                    <div class="container mt-4">
                        <!-- Hiển thị tên sản phẩm trên tiêu đề -->
                        <!-- Gọi f đầu tiên là ra 1 nhóm gọi f 2 là ra ctiet 1 -->
                       





                        <!-- Thêm modal cho chi tiết sản phẩm -->
                        <div class="container mt-4">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#productDetailModal">
                                Thêm chi tiết sản phẩm
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="productDetailModal" tabindex="-1"
                                aria-labelledby="productDetailModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="productDetailModalLabel">Thêm chi tiết sản phẩm
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form
                                            action="{{ route('admin.products.details.store', ['product_id' => $product_id]) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label for="size" class="form-label">Kích thước</label>
                                                    <input type="text" class="form-control" id="size" name="size"
                                                        required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="color" class="form-label">Màu sắc</label>
                                                    <input type="text" class="form-control" id="color" name="color"
                                                        required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="cost" class="form-label">Giá vốn</label>
                                                    <input type="number" class="form-control" id="cost" name="cost"
                                                        step="0.01" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="selling_price" class="form-label">Giá bán</label>
                                                    <input type="number" class="form-control" id="selling_price"
                                                        name="selling_price" step="0.01" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="description" class="form-label">Mô tả</label>
                                                    <textarea class="form-control" id="description" name="description"
                                                        rows="3" required></textarea>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="stock_quantity" class="form-label">Số lượng trong
                                                        kho</label>
                                                    <input type="number" class="form-control" id="stock_quantity"
                                                        name="stock_quantity" required>
                                                </div>

                                                <div class="mb-3">
                                                    <label for="images" class="form-label">Hình ảnh sản phẩm</label>
                                                    <input type="file" class="form-control" id="images" name="images[]"
                                                        multiple>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Đóng</button>
                                                <button type="submit" class="btn btn-primary">Lưu</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

               

                        @php
    use Illuminate\Pagination\LengthAwarePaginator;

    $search = request('search');
    $perPage = request('perPage', 15);
    $currentPage = LengthAwarePaginator::resolveCurrentPage();

    $filtered = $groupedProductDetails->filter(function ($details) use ($search) {
        $detail = $details->first();
        return !$search ||
            stripos($detail->size, $search) !== false ||
            stripos($detail->color, $search) !== false;
    });

    $sliced = $filtered->slice(($currentPage - 1) * $perPage, $perPage);
    $paginator = new LengthAwarePaginator(
        $sliced->values(), // dùng values() để reset key
        $filtered->count(),
        $perPage,
        $currentPage,
        [
            'path' => request()->url(),
            'query' => request()->query(), // để giữ lại ?search=...&perPage=...
        ]
    );
@endphp

{{-- Form tìm kiếm và perPage --}}
<form method="GET" class="row mb-3">
    <div class="col-md-4">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control"
               placeholder="Tìm theo size hoặc màu...">
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary" type="submit">Tìm kiếm</button>
    </div>
    <div class="col-md-3">
        <select name="perPage" onchange="this.form.submit()" class="form-select">
            <option value="10" {{ $perPage == 10 ? 'selected' : '' }}>10 sản phẩm/trang</option>
            <option value="15" {{ $perPage == 15 ? 'selected' : '' }}>15 sản phẩm/trang</option>
        </select>
    </div>
 
</form>
{{-- Bảng hiển thị thông tin chi tiết sản phẩm --}}
<table class="table table-bordered table-striped align-middle">
    <thead class="table-white">
        <tr>
            <th>ID</th>
            <th>Mã sản phẩm</th>
            <th>Size</th>
            <th>Màu</th>
            <th>Giá gốc</th>
            <th>Tồn kho</th>
            <th style="width: 10%;">Ảnh</th>
            <th>Trạng thái</th>
 
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($paginator as $productDetailId => $details)
            @php $detail = $details->first(); @endphp
            <tr>
                <td>{{ $detail->product_detail_id }}</td>
                <td> {{ $detail ->product_code }} </td>
                <td>{{ $detail->size }}</td>
                <td>{{ $detail->color }}</td>
                <td>{{ number_format($detail->cost, 0, ',', '.') }} đ</td>
                <td>{{ $detail->stock_quantity }}</td>
                <td>
                    @if($details->count() > 0)
                        <div id="carousel-{{ $detail->product_detail_id }}" class="carousel slide"
                             data-bs-ride="carousel" style="width: 200px; height: 200px; overflow: hidden;">
                            <div class="carousel-inner" style="width: 100%; height: 100%;">
                                @foreach ($details as $index => $image)
                                    @if($image->image_url)
                                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                            <img src="{{ asset('storage/' . $image->image_url) }}"
                                                 class="d-block mx-auto"
                                                 style="max-width: 100%; max-height: 100%; object-fit: contain;"
                                                 alt="Ảnh sản phẩm">
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @if($details->count() > 1)
                                <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carousel-{{ $detail->product_detail_id }}"
                                        data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button"
                                        data-bs-target="#carousel-{{ $detail->product_detail_id }}"
                                        data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            @endif
                        </div>
                    @else
                        Không có ảnh
                    @endif
                </td>
                <td>
                @php
    switch ($detail->status) {
        case 'available':
            $badgeClass = 'bg-success';
            $statusText = 'Còn hàng';
            break;
        case 'out_of_stock':
            $badgeClass = 'bg-warning text-dark';
            $statusText = 'Hết hàng';
            break;
        case 'discontinued':
            $badgeClass = 'bg-danger';
            $statusText = 'Ngừng kinh doanh';
            break;
        default:
            $badgeClass = 'bg-secondary';
            $statusText = 'Không xác định';
            break;
    }
@endphp

<span class="badge {{ $badgeClass }}">
    {{ $statusText }}
</span>

                </td>
                <td>
                  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editProductDetailModal{{ $detail->product_detail_id }}">
    Sửa
</button>
<!-- Button để mở Modal -->
<button type="button" class="btn btn-warning" onclick="document.getElementById('restockModal').style.display='block'">Bù hàng</button>



                </td>
   <!-- Modal sửa -->
<div class="modal fade" id="editProductDetailModal{{ $detail->product_detail_id }}" tabindex="-1" aria-labelledby="editProductDetailModalLabel{{ $detail->product_detail_id }}" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form action="{{ route('admin.products.details.update', $detail->product_detail_id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="modal-header">
          <h5 class="modal-title" id="editProductDetailModalLabel{{ $detail->product_detail_id }}">Cập nhật chi tiết sản phẩm</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>

        <div class="modal-body">
          <!-- Size -->
          <div class="mb-3">
            <label for="size" class="form-label">Size</label>
            <input type="text" class="form-control" name="size" value="{{ $detail->size }}">
          </div>

          <!-- Color -->
          <div class="mb-3">
            <label for="color" class="form-label">Màu sắc</label>
            <input type="text" class="form-control" name="color" value="{{ $detail->color }}">
          </div>

          <!-- Cost -->
          <div class="mb-3">
            <label for="cost" class="form-label">Giá nhập</label>
            <input type="number" step="0.01" class="form-control" name="cost" value="{{ $detail->cost }}">
          </div>

          <!-- Selling Price -->
          <div class="mb-3">
            <label for="selling_price" class="form-label">Giá bán</label>
            <input type="number" step="0.01" class="form-control" name="selling_price" value="{{ $detail->selling_price }}">
          </div>

          <!-- Description -->
          <div class="mb-3">
            <label for="description" class="form-label">Mô tả</label>
            <textarea class="form-control" name="description" rows="3">{{ $detail->description }}</textarea>
          </div>

          <!-- Stock Quantity -->
          <div class="mb-3">
            <label for="stock_quantity" class="form-label">Số lượng tồn kho</label>
            <input type="number" class="form-control" name="stock_quantity" value="{{ $detail->stock_quantity }}">
          </div>

          <!-- Status -->
          <div class="mb-3">
            <label for="status" class="form-label">Trạng thái</label>
            <select class="form-select" name="status">
              <option value="available" {{ $detail->status == 'available' ? 'selected' : '' }}>Còn hàng</option>
              <option value="out_of_stock" {{ $detail->status == 'out_of_stock' ? 'selected' : '' }}>Hết hàng</option>
              <option value="discontinued" {{ $detail->status == 'discontinued' ? 'selected' : '' }}>Ngưng bán</option>
            </select>
          </div>

          <!-- Upload Images -->
          <div class="mb-3">
            <label for="images" class="form-label">Ảnh sản phẩm (có thể chọn nhiều)</label>
            <input type="file" class="form-control" name="images[]" multiple accept="image/*">
          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button type="submit" class="btn btn-primary">Cập nhật</button>
        </div>
      </form>
    </div>
  </div>
</div>








<!-- Modal Bù Hàng -->
<div id="restockModal" class="modal">
    <div id="modalContent" class="modal-content">
        <!-- Form bù hàng -->
        <form id="restockForm" method="POST" action="{{ route('admin.product.restock', $detail->product_detail_id) }}">
            @csrf
            <label for="restockQuantity">Số lượng bù hàng:</label>
            <input type="number" id="restockQuantity" name="restock_quantity" required>
            <button id="submitRestock" type="submit">Bù hàng</button>
        </form>
        <button id="closeModal" onclick="document.getElementById('restockModal').style.display='none'">Đóng</button>
    </div>
</div>






            </tr>
        @empty
            <tr>
                <td colspan="8" class="text-center">Không tìm thấy sản phẩm phù hợp.</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{-- Bootstrap pagination --}}

<div class="d-flex justify-content-center mt-4">
    {{ $paginator->links('pagination::bootstrap-5') }}
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

<!-- Đặt mã AJAX trong thẻ <script> ngay trước thẻ đóng </body> -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> <!-- Bao gồm jQuery nếu chưa có -->


<style>

/* Modal Styling */
#restockModal {
    display: none; /* Modal ẩn theo mặc định */
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0, 0, 0, 0.5); /* Hiệu ứng nền tối */
}

#modalContent {
    background-color: #fefefe;
    margin: 10% auto;
    padding: 20px;
    border: 1px solid #888;
    width: 40%;
    border-radius: 8px; /* Bo góc modal */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Hiệu ứng đổ bóng */
}

/* Input Styling */
#restockForm input[type="number"] {
    width: 100%;
    padding: 8px;
    margin: 10px 0;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

/* Button Styling */
#submitRestock {
    background-color: #007bff;
    color: white;
    border: none;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 10px 0;
    cursor: pointer;
    border-radius: 5px;
}

#submitRestock:hover {
    background-color: #0056b3; /* Hiệu ứng hover */
}

#closeModal {
    background-color: #dc3545;
    color: white;
    padding: 10px;
    font-size: 16px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

#closeModal:hover {
    background-color: #a71d2a; /* Hiệu ứng hover cho nút đóng */
}

/* Empty Row Styling */
#emptyRow td {
    text-align: center;
    font-style: italic;
    color: #999;
}

/* Responsive Design */
@media (max-width: 768px) {
    #modalContent {
        width: 90%; /* Modal rộng hơn trên màn hình nhỏ */
    }
}




</style>
</body>
<!--end::Body-->

</html>