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
                        <h1>Chi tiết đơn hàng</h1>

                        @if (isset($error))
                            <div class="alert alert-danger">
                                {{ $error }}
                            </div>
                        @else
                                                <!-- Hiển thị thông tin chi tiết đơn hàng -->
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Order ID</th>
                                                            <th>Ngày Đặt Hàng</th>
                                                            <th>Tên Khách Hàng</th>
                                                            <th>Email Khách Hàng</th>
                                                            <th>Sản phẩm</th>
                                                            <th>Size</th>
                                                            <th>Màu sắc</th>
                                                            <th>Số lượng</th>
                                                            <th>Đơn giá</th>
                                                            <th>Tổng</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @php
                                                            $total = 0; // Khởi tạo biến tổng số tiền
                                                        @endphp
                                                        @foreach ($orderDetails as $orderDetail)
                                                            <tr>
                                                                <td>{{ $orderDetail->order_id }}</td>
                                                                <td>{{ $orderDetail->order_date }}</td>
                                                                <td>{{ $orderDetail->customer_name }}</td>
                                                                <td>{{ $orderDetail->customer_email }}</td>
                                                                <td>{{ $orderDetail->product_name }}</td>
                                                                <td>{{ $orderDetail->size }}</td>
                                                                <td>{{ $orderDetail->color }}</td>
                                                                <td>{{ $orderDetail->quantity }}</td>
                                                                <td>{{ number_format($orderDetail->unit_price, 2) }}</td>
                                                                <td>{{ number_format($orderDetail->subtotal, 2) }}</td>
                                                            </tr>
                                                        @endforeach
                                                        @php
                                                            // Cộng dồn tổng số tiền từ các sản phẩm trong đơn hàng
                                                            $total += $orderDetail->subtotal;
                                                        @endphp
                                                    </tbody>
                                                </table>


                                                <!-- Hiển thị thông tin mã giảm giá nếu có -->
                                                @if ($orderDetails[0]->voucher_code)
                                                    <div class="mt-3">
                                                        <h4>Thông tin mã giảm giá:</h4>
                                                        <p><strong>Mã giảm giá:</strong> {{ $orderDetails[0]->voucher_code }}</p>
                                                        <p><strong>Loại giảm giá:</strong> {{ ucfirst($orderDetails[0]->discount_type) }}</p>
                                                        <p><strong>Mức giảm tối đa:</strong> {{ number_format($orderDetails[0]->max_discount, 2) }}
                                                            VND</p>
                                                        <h4>Tổng số tiền sản phẩm trước giảmgiảm: {{ number_format($total, 2) }} VND</h4>
                                                    </div>
                                                @endif

                        @endif
                        <!-- Hiển thị tổng số tiền của đơn hàng -->
                        <div class="mt-3">
                            <h4>Tổng số tiền: {{ number_format($orderDetails[0]->total_amount, 2) }} VND</h4>
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