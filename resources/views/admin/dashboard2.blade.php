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
                
           
<div class="container">
    <h2>POS - Bán hàng</h2>

    {{-- Thông báo thành công / lỗi --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Tìm kiếm khách hàng --}}
    <div class="card mb-4">
        <div class="card-header">
            <h4>Tìm kiếm khách hàng</h4>
        </div>
        <div class="card-body">
            <input type="text" id="customer_search" class="form-control" placeholder="Nhập email hoặc số điện thoại khách hàng...">
            <button id="search_customer_btn" class="btn btn-primary mt-2">Tìm kiếm</button>

            <div id="customer_info" class="mt-3" style="display: none;">
                <h5>Thông tin khách hàng:</h5>
                <p><strong>Tên:</strong> <span id="customer_name"></span></p>
                <p><strong>Email:</strong> <span id="customer_email"></span></p>
                <p><strong>Số điện thoại:</strong> <span id="customer_phone"></span></p>
            </div>
        </div>
    </div>

    {{-- Thêm sản phẩm bằng product code --}}
    <div class="card mb-4">
        <div class="card-header">
            <h4>Thêm sản phẩm vào giỏ hàng</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.pos.add.product') }}" method="POST" class="form-inline">
                <div class="form-group">
                    <input type="text" name="product_code" class="form-control" placeholder="Nhập mã sản phẩm..." required>
                </div>
                <button type="submit" class="btn btn-success ml-2">Thêm vào giỏ</button>
            </form>
        </div>
    </div>

    {{-- Hiển thị giỏ hàng --}}
    <div class="card">
        <div class="card-header">
            <h4>Giỏ hàng</h4>
        </div>
        <div class="card-body">
            @if (!empty($cart))
                <table class="table">
                    <thead>
                        <tr>
                            <th>Mã sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Màu sắc</th>
                            <th>Size</th>
                            <th>Giá bán</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $code => $item)
                        <tr>
                            <td>{{ $item['product_code'] }}</td>
                            <td>{{ $item['product_name'] }}</td>
                            <td>{{ $item['color'] }}</td>
                            <td>{{ $item['size'] }}</td>
                            <td>{{ number_format($item['selling_price']) }}đ</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>{{ number_format($item['selling_price'] * $item['quantity']) }}đ</td>
                            <td>
                                <form action="{{ route('admin.pos.remove.product', $code) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" type="submit">Xóa</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h5 class="mt-3">Tổng tiền: <strong>{{ number_format($totalAmount) }}đ</strong></h5>

                {{-- Form thanh toán --}}
                <form action="{{ route('admin.pos.checkout') }}" method="POST">
                    @csrf
                    <input type="hidden" name="customer_id" id="customer_id" value="{{ session('customer_id') ?? 0 }}">
                    
                    @foreach ($cart as $code => $item)
                        <input type="hidden" name="products[{{ $code }}][quantity]" value="{{ $item['quantity'] }}">
                    @endforeach

                    <div class="form-group mt-3">
                        <label for="payment_method_id">Phương thức thanh toán:</label>
                        <select name="payment_method_id" class="form-control" required>
                            @foreach ($paymentMethods as $method)
                                <option value="{{ $method->payment_method_id }}">{{ $method->method_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">Thanh toán</button>
                </form>
            @else
                <p>Giỏ hàng trống.</p>
            @endif
        </div>
    </div>
</div>


<script>
$(document).ready(function() {
    $('#search_customer_btn').click(function() {
        var info = $('#customer_search').val();
        if (info.trim() == '') {
            alert('Vui lòng nhập thông tin khách hàng.');
            return;
        }

        $.ajax({
            url: '{{ route('admin.pos.searchCustomers') }}',
            method: 'POST',
            data: {
                customer_info: info,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if (response.success) {
                    $('#customer_name').text(response.customer.name);
                    $('#customer_email').text(response.customer.email);
                    $('#customer_phone').text(response.customer.phone);
                    $('#customer_info').show();

                    // Lưu customer_id vào hidden input cho đơn hàng
                    $('#customer_id').val(response.customer.customer_id);

                    // Lưu vào session bằng AJAX (gọi API khác nếu cần, hoặc backend lưu trực tiếp qua session())
                } else {
                    alert(response.message);
                    $('#customer_info').hide();
                    $('#customer_id').val(0);
                }
            }
        });
    });
});
</script>







                  
                    <!--end::Row-->
                </div>
                <!--end::Container-->


                    
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