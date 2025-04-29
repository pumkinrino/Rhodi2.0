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
                        @if(session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @elseif(session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        @if (session('warning'))
                            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-4" role="alert">
                                <p class="font-bold">Cảnh báo</p>
                                <p>{{ session('warning') }}</p>
                            </div>
                        @endif

                    </div>



                    <!-- Nội dung chính -->

                    <!-- Button Thêm Voucher -->
                    <button class="btn btn-primary mb-1" data-bs-toggle="modal" data-bs-target="#addVoucherModal">Thêm
                        Voucher</button>
                    <form action="{{ route('admin.products.voucher.index') }}" method="GET">
                        <!-- Input tìm kiếm voucher -->
                        <input type="text" name="search" value="{{ request()->input('search') }}"
                            placeholder="Tìm kiếm theo mã voucher">

                        <!-- Dropdown chọn số lượng voucher hiển thị mỗi trang -->
                        <select name="per_page">
                            <option value="10" {{ request()->input('per_page') == 10 ? 'selected' : '' }}>10</option>
                            <option value="15" {{ request()->input('per_page') == 15 ? 'selected' : '' }}>15</option>
                        </select>

                        <button type="submit" class="btn btn-primary mb-1">Tìm kiếm</button>
                    </form>
                    <!-- Modal Thêm Voucher -->
                    <div class="modal fade" id="addVoucherModal" tabindex="-1" aria-labelledby="addVoucherModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="addVoucherModalLabel">Thêm Voucher Mới</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('admin.products.voucher.store') }}" method="POST">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="row">
                                            <!-- Mã Voucher -->
                                            <div class="col-md-6">
                                                <label for="code" class="form-label">Mã Voucher</label>
                                                <input type="text" class="form-control" id="code" name="code" required>
                                            </div>

                                            <!-- Mô Tả -->
                                            <div class="col-md-6">
                                                <label for="description" class="form-label">Mô Tả</label>
                                                <textarea class="form-control" id="description"
                                                    name="description"></textarea>
                                            </div>

                                            <!-- Loại Giảm Giá -->
                                            <div class="col-md-6">
                                                <label for="discount_type" class="form-label">Loại Giảm Giá</label>
                                                <select class="form-select" id="discount_type" name="discount_type"
                                                    required>
                                                    <option value="percentage">Phần trăm</option>
                                                    <option value="fixed">Cố định</option>
                                                </select>
                                            </div>

                                            <!-- Giá trị giảm giá -->
                                            <div class="col-md-6">
                                                <label for="discount_value" class="form-label">Giá trị giảm giá</label>
                                                <input type="number" class="form-control" id="discount_value"
                                                    name="discount_value" required>
                                            </div>

                                            <!-- Giảm tối đa (ẩn khi loại giảm giá là 'fixed') -->
                                            <div class="col-md-6" id="maxDiscountField" style="display: none;">
                                                <label for="max_discount" class="form-label">Giảm tối đa</label>
                                                <input type="number" class="form-control" id="max_discount"
                                                    name="max_discount">
                                            </div>

                                            <!-- Giá trị đơn hàng tối thiểu -->
                                            <div class="col-md-6">
                                                <label for="min_order_value" class="form-label">Giá trị đơn hàng tối
                                                    thiểu</label>
                                                <input type="number" class="form-control" id="min_order_value"
                                                    name="min_order_value">
                                            </div>

                                            <!-- Số lượng Voucher -->
                                            <div class="col-md-6">
                                                <label for="quantity" class="form-label">Số lượng</label>
                                                <input type="number" class="form-control" id="quantity" name="quantity"
                                                    required>
                                            </div>

                                            <!-- Ngày bắt đầu -->
                                            <div class="col-md-6">
                                                <label for="start_date" class="form-label">Ngày bắt đầu</label>
                                                <input type="date" class="form-control" id="start_date"
                                                    name="start_date" required>
                                            </div>

                                            <!-- Ngày kết thúc -->
                                            <div class="col-md-6">
                                                <label for="end_date" class="form-label">Ngày kết thúc</label>
                                                <input type="date" class="form-control" id="end_date" name="end_date"
                                                    required>
                                            </div>

                                            <!-- Số lượng Voucher -->
                                            <div class="col-md-6">
                                                <label for="quantity" class="form-label">Số lượng</label>
                                                <input type="number" class="form-control" id="quantity" name="quantity"
                                                    required>
                                            </div>

                                            <!-- Trạng thái -->
                                            <div class="col-md-6">
                                                <label for="is_active" class="form-label">Trạng thái</label>
                                                <select class="form-select" id="is_active" name="is_active" required>
                                                    <option value="1">Hoạt động</option>
                                                    <option value="0">Ngừng hoạt động</option>
                                                </select>
                                            </div>
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

                    <!-- JavaScript -->
                    <script>
                        // Hàm điều khiển hiển thị/ẩn ô "Giảm tối đa"
                        function toggleMaxDiscount() {
                            const discountType = document.getElementById('discount_type');
                            const maxDiscountField = document.getElementById('maxDiscountField');

                            // Nếu loại giảm giá là phần trăm, hiển thị ô giảm tối đa
                            if (discountType && maxDiscountField) {
                                if (discountType.value === 'percentage') {
                                    maxDiscountField.style.display = 'block';
                                } else {
                                    maxDiscountField.style.display = 'none';
                                }
                            }
                        }

                        // Lắng nghe sự kiện thay đổi loại giảm giá
                        document.getElementById('discount_type').addEventListener('change', toggleMaxDiscount);

                        // Gọi hàm khi mở modal để đảm bảo ô "Giảm tối đa" có đúng trạng thái
                        const addVoucherModal = document.getElementById('addVoucherModal');
                        addVoucherModal.addEventListener('shown.bs.modal', function () {
                            toggleMaxDiscount();
                        });
                    </script>








                    <div class="card-body">


                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Mã Voucher</th>
                                    <th>Loại Giảm Giá</th>
                                    <th>Giảm Giá</th>
                                    <th>Ngày Bắt Đầu</th>
                                    <th>Ngày Kết Thúc</th>
                                    <th>Trạng Thái</th>
                                    <th>Mô Tả</th>
                                    <th>Giá Trị Đơn Hàng Tối Thiểu</th>
                                    <th>Giảm Giá Tối Đa</th>
                                    <th>Số Lượng</th>
                                    <th>Thao Tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($vouchers as $voucher)


                                    <tr>
                                        <td>{{ $voucher->code }}</td>
                                        <td>
                                            {{ $voucher->discount_type }}
                                            @if($voucher->discount_type == 'percentage')
                                                (Phần trăm)
                                            @else
                                                (Cố định)
                                            @endif
                                        </td>

                                        <td>
                                            {{ $voucher->discount_value }}
                                            @if($voucher->discount_type == 'percentage')
                                                %
                                            @else
                                                VNĐ
                                            @endif
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($voucher->start_date)->format('d/m/Y H:i') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($voucher->end_date)->format('d/m/Y H:i') }}</td>
                                        <td>{{ $voucher->is_active ? 'Hoạt động' : 'Ngừng hoạt động' }}</td>
                                        <td>{{ $voucher->description ?? 'Không có mô tả' }}</td>
                                        <td>{{ $voucher->min_order_value ? number_format($voucher->min_order_value, 2) : 'Không yêu cầu' }}
                                        </td>
                                        <td>{{ $voucher->max_discount ? number_format($voucher->max_discount, 2) : 'Không giới hạn' }}
                                        </td>
                                        <td>{{ $voucher->quantity }}</td>
                                        <td>
                                            <!-- Button mở modal sửa (tuỳ chọn thêm vào danh sách voucher) -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editVoucherModal">
                                                Sửa
                                            </button>

                                            <!-- Modal Sửa Voucher -->
                                            <div class="modal fade" id="editVoucherModal" tabindex="-1"
                                                aria-labelledby="editVoucherModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editVoucherModalLabel">Sửa Voucher
                                                            </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <form
                                                            action="{{ route('admin.products.voucher.update', $voucher->voucher_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <!-- Mã Voucher -->
                                                                    <div class="col-md-6">
                                                                        <label for="edit_code" class="form-label">Mã
                                                                            Voucher</label>
                                                                        <input type="text" class="form-control"
                                                                            id="edit_code" name="code"
                                                                            value="{{ $voucher->code }}" required>
                                                                    </div>

                                                                    <!-- Mô Tả -->
                                                                    <div class="col-md-6">
                                                                        <label for="edit_description" class="form-label">Mô
                                                                            Tả</label>
                                                                        <textarea class="form-control" id="edit_description"
                                                                            name="description">{{ $voucher->description }}</textarea>
                                                                    </div>

                                                                    <!-- Loại Giảm Giá -->
                                                                    <div class="col-md-6">
                                                                        <label for="edit_discount_type"
                                                                            class="form-label">Loại Giảm Giá</label>
                                                                        <select class="form-select" id="edit_discount_type"
                                                                            name="discount_type" required>
                                                                            <option value="percentage" {{ $voucher->discount_type == 'percentage' ? 'selected' : '' }}>Phần trăm</option>
                                                                            <option value="fixed" {{ $voucher->discount_type == 'fixed' ? 'selected' : '' }}>Cố định</option>
                                                                        </select>
                                                                    </div>

                                                                    <!-- Giá trị giảm giá -->
                                                                    <div class="col-md-6">
                                                                        <label for="edit_discount_value"
                                                                            class="form-label">Giá trị giảm giá</label>
                                                                        <input type="number" class="form-control"
                                                                            id="edit_discount_value" name="discount_value"
                                                                            value="{{ $voucher->discount_value }}" required>
                                                                    </div>

                                                                    <!-- Giảm tối đa -->
                                                                    <div class="col-md-6" id="edit_maxDiscountField"
                                                                        style="{{ $voucher->discount_type == 'percentage' ? '' : 'display: none;' }}">
                                                                        <label for="edit_max_discount"
                                                                            class="form-label">Giảm tối đa</label>
                                                                        <input type="number" class="form-control"
                                                                            id="edit_max_discount" name="max_discount"
                                                                            value="{{ $voucher->max_discount }}">
                                                                    </div>

                                                                    <!-- Giá trị đơn hàng tối thiểu -->
                                                                    <div class="col-md-6">
                                                                        <label for="edit_min_order_value"
                                                                            class="form-label">Giá trị đơn hàng tối
                                                                            thiểu</label>
                                                                        <input type="number" class="form-control"
                                                                            id="edit_min_order_value" name="min_order_value"
                                                                            value="{{ $voucher->min_order_value }}">
                                                                    </div>

                                                                    <!-- Số lượng -->
                                                                    <div class="col-md-6">
                                                                        <label for="edit_quantity" class="form-label">Số
                                                                            lượng</label>
                                                                        <input type="number" class="form-control"
                                                                            id="edit_quantity" name="quantity"
                                                                            value="{{ $voucher->quantity }}" required>
                                                                    </div>

                                                                    <!-- Ngày bắt đầu -->
                                                                    <div class="col-md-6">
                                                                        <label for="edit_start_date" class="form-label">Ngày
                                                                            bắt đầu</label>
                                                                        <input type="date" class="form-control"
                                                                            id="edit_start_date" name="start_date"
                                                                            value="{{ \Carbon\Carbon::parse($voucher->start_date)->format('Y-m-d') }}"
                                                                            required>
                                                                    </div>

                                                                    <!-- Ngày kết thúc -->
                                                                    <div class="col-md-6">
                                                                        <label for="edit_end_date" class="form-label">Ngày
                                                                            kết thúc</label>
                                                                        <input type="date" class="form-control"
                                                                            id="edit_end_date" name="end_date"
                                                                            value="{{ \Carbon\Carbon::parse($voucher->end_date)->format('Y-m-d') }}"
                                                                            required>
                                                                    </div>

                                                                    <!-- Trạng thái -->
                                                                    <div class="col-md-6">
                                                                        <label for="edit_is_active" class="form-label">Trạng
                                                                            thái</label>
                                                                        <select class="form-select" id="edit_is_active"
                                                                            name="is_active" required>
                                                                            <option value="1" {{ $voucher->is_active ? 'selected' : '' }}>Hoạt động</option>
                                                                            <option value="0" {{ !$voucher->is_active ? 'selected' : '' }}>Ngừng hoạt động</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Đóng</button>
                                                                <button type="submit" class="btn btn-primary">Cập
                                                                    nhật</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Script ẩn/hiện trường giảm tối đa -->
                                            <script>
                                                document.getElementById('edit_discount_type').addEventListener('change', function () {
                                                    const maxDiscountField = document.getElementById('edit_maxDiscountField');
                                                    if (this.value === 'percentage') {
                                                        maxDiscountField.style.display = '';
                                                    } else {
                                                        maxDiscountField.style.display = 'none';
                                                    }
                                                });
                                            </script>

                                            <!-- //NÚt xóa -->
                                            <form
                                                action="{{ route('admin.products.voucher.destroy', $voucher->voucher_id) }}"
                                                method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa voucher này không?')">Xóa</button>
                                            </form>

                                        </td>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>
                                    {{-- Bootstrap pagination --}}

                                    <div class="d-flex justify-content-center mt-4">
    {{ $vouchers->links('pagination::bootstrap-5') }}
</div>
                    </div>
                </div>
            </div>
    </div>
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


</body>
<!--end::Body-->

</html>