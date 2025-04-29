<head>
    <title>Fashion Template for Bootstrap</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Demo powered by Templatetrip">
    <meta name="author" content="">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @include('components.users.dashboardlink')
</head>
@include('components.users.header')
<div class="checkout-inner float-left w-100">
    <div class="container">
        <!-- Form checkout chứa thông tin voucher, giỏ hàng, địa chỉ giao hàng, v.v. -->
        <form action="{{ route('checkout.process') }}" method="POST" class="needs-validation">
            @csrf
            <div class="row">
                <!-- Cột bên trái: Giỏ hàng, voucher & phương thức thanh toán -->
                <div class="cart-block-left col-md-4 order-md-2 mb-4">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span>Your cart</span>
                    </h4>
                    <div class="list-group mb-3">
                        @foreach ($cart as $item)
                            <div class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">{{ $item->productDetail->dname }}</h6>
                                </div>
                                <span class="text-muted">
                                    {{ number_format($item->productDetail->selling_price, 0, ',', '.') }}$
                                </span>
                            </div>
                        @endforeach

                        <!-- Phần nhập và kiểm tra voucher (nút Check là submit) -->
                        <div class="list-group-item">
                            <div class="text-success">
                                <h6 class="my-0">Promo code</h6>
                                <small>
                                    <input type="text" name="voucher_code" class="border"
                                        placeholder="Paste your coupon here">
                                </small>
                                <!-- Nút Check voucher: dùng submit với name action = check_voucher -->
                                <button type="submit" name="action" value="check_voucher"
                                    class="btn btn-sm btn-outline-primary mt-2">
                                    Check
                                </button>
                            </div>
                            <!-- Hiển thị thông báo voucher (sẽ được điền lại nếu controller gửi về) -->
                            @if(session('voucher_message'))
                                <span id="voucher-message" class="text-success">{{ session('voucher_message') }}</span>
                            @endif
                        </div>

                        <!-- Hiển thị tổng đơn hàng (tính lại từ giỏ hàng) -->
                        <div class="list-group-item d-flex justify-content-between">
                            @php $total = 0; @endphp
                            @foreach ($cart as $item)
                                @php $total += $item->quantity * $item->productDetail->selling_price; @endphp
                            @endforeach
                            <strong>Total (VND)</strong>
                            <strong id="">{{ number_format($total, 0, ',', '.') }}$</strong>
                        </div>

                        <!-- Phương thức thanh toán (luôn hiển thị) -->
                        <div class="list-group-item d-flex justify-content-between mb-3">
                            <div class="custom-control custom-radio">
                                <input id="credit" name="payment_method" type="radio" class="custom-control-input"
                                    value="2" required>
                                <label class="custom-control-label" for="credit">Bank Transfer</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="debit" name="payment_method" type="radio" class="custom-control-input"
                                    value="1" required>
                                <label class="custom-control-label" for="debit">COD</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input id="paypal" name="payment_method" type="radio" class="custom-control-input"
                                    value="3" required>
                                <label class="custom-control-label" for="paypal">QR Code</label>
                            </div>
                        </div>

                        <!-- Container QR code, ẩn mặc định -->
                        <div id="qr-code-container" class="text-center mb-3" style="display: none;">
                            <img src="/path/to/your/qrcode.png" alt="QR Code" class="img-fluid"
                                style="max-width: 250px;">
                        </div>
                        <!-- Nút submit đặt hàng -->
                        <button type="submit" name="action" value="place_order" class="btn btn-primary btn-lg">Place an
                            order</button>
                    </div>
                </div>


                <!-- Cột bên phải: Thông tin địa chỉ giao hàng -->
                <div class="cart-block-right col-md-8 order-md-1">
                    <h4 class="mb-3">Shipping address</h4>

                    <!-- Dropdown chọn địa chỉ đã lưu -->
                    <div class="mb-3">
                        <label for="saved_address" class="form-label">Chọn địa chỉ giao hàng đã lưu:</label>
                        <select name="saved_address_id" id="saved_address" class="form-select">
                            <option value="">-- Chọn địa chỉ có sẵn --</option>
                            @foreach ($addresses as $address)
                                <option value="{{ $address->address_id }}">
                                    {{ $address->full_name }} - {{ $address->address_line }} ({{ $address->postal_code }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" class="btn-check" id="otherAddressToggle" autocomplete="off"
                            data-bs-toggle="collapse" data-bs-target="#collapseOtherAddress" aria-expanded="false"
                            aria-controls="collapseOtherAddress">
                        <label class="btn btn-outline-decondary" for="otherAddressToggle">Sử dụng địa chỉ khác</label>
                    </div>

                    <!-- Phần collapse chứa các input nhập địa chỉ khác -->
                    <div class="collapse" id="collapseOtherAddress">
                        <div class="card card-body">
                            <div class="mb-3">
                                <label for="other_full_name" class="form-label">Họ và tên:</label>
                                <input type="text" class="form-control" id="other_full_name" name="other_full_name"
                                    placeholder="Nhập họ và tên của bạn">
                            </div>
                            <div class="mb-3">
                                <label for="other_phone" class="form-label">Số điện thoại:</label>
                                <input type="text" class="form-control" id="other_phone" name="other_phone"
                                    placeholder="Nhập số điện thoại">
                            </div>
                            <div class="mb-3">
                                <label for="other_mail" class="form-label">Email:</label>
                                <input type="text" class="form-control" id="other_phone" name="other_phone"
                                    placeholder="Nhập số điện thoại">
                            </div>
                            <div class="mb-3">
                                <label for="other_address_line" class="form-label">Địa chỉ:</label>
                                <textarea class="form-control" id="other_address_line" name="other_address_line"
                                    placeholder="Nhập địa chỉ giao hàng"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="city">Thành phố:</label>
                                <input type="text" name="other_city" id="city" class="form-control"
                                    placeholder="Nhập thành phố">
                            </div>

                            <div class="form-group">
                                <label for="district">Quận/Huyện:</label>
                                <input type="text" name="other_district" id="district" class="form-control"
                                    placeholder="Nhập quận/huyện">
                            </div>
                        </div>
                    </div>

                    <hr class="mb-4">
                </div>

                <!-- Include Bootstrap JS (nếu chưa có) -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


            </div>
        </form>
    </div>
</div>
<script>
    document.querySelectorAll('input[name="payment_method"]').forEach(function (radio) {
        radio.addEventListener('change', function () {
            var qrContainer = document.getElementById("qr-code-container");
            if (this.value === '3') {  // Nếu giá trị là QR code
                qrContainer.style.display = 'block';
            } else {
                qrContainer.style.display = 'none';
            }
        });
    });
</script>
@include('components.users.footer')