<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('components.users.dashboardlink')
</head>
@include('components.users.header')

<body>
    <div class="cart-area table-area pt-110 pb-95 float-left w-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 float-left cart-wrapper">
                    <div class="table-responsive">
                        <table class="table product-table text-center">
                            <thead>
                                <tr>
                                    <th class="table-remove text-capitalize">remove</th>
                                    <th class="table-image text-capitalize">image</th>
                                    <th class="table-p-name text-capitalize">product</th>
                                    <th class="table-p-price text-capitalize">price</th>
                                    <th class="table-p-qty text-capitalize">quantity</th>
                                    <th class="table-total text-capitalize">total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartlist as $item)
                                    <tr>
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="cart_id" value="{{ $item->cart_id }}">
                                            <td class="table-remove"><button><i class="material-icons">delete</i></button>
                                            </td>
                                        </form>
                                        <td class="table-image"><a
                                                href="{{ route('product.show', $item->productDetail->product->product_id) }}"><img
                                                    src="{{ $item->productDetail->product->main_image }}" alt=""></a></td>
                                        <td class="table-p-name text-capitalize"> <a
                                                href="{{ route('product.show', $item->productDetail->product->product_id) }}">
                                                {{ $item->productDetail->dname }}
                                            </a>
                                        </td>
                                        <td class="table-p-price">
                                            <p>{{ number_format($item->productDetail->selling_price, 0, ',', '.') }}$</p>
                                        </td>
                                        <td class="table-p-qty">{{ $item->quantity }}
                                        </td>
                                        <td class="table-total">
                                            <p>{{ number_format((($item->productDetail->selling_price) * ($item->quantity)), 0, ',', '.') }}$
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <div @php
                    $total = 0;
                @endphp @foreach ($cartlist as $item) @php
                    $total += $item->quantity * $item->productDetail->selling_price;
                @endphp @endforeach
                    class="table-total-wrapper d-flex justify-content-end pt-60 col-md-12 col-sm-12 col-lg-4 float-left  align-items-center">
                    <div class="table-total-content">
                        <h2 class="pb-20">Cart totals</h2>
                        <div class="table-total-amount">
                            <div class="single-total-content d-flex justify-content-between float-left w-100">
                                <strong>Subtotal</strong>
                                <span class="c-total-price">{{ number_format($total,0,',','.') }}$</span>
                            </div>
                            <div class="single-total-content d-flex justify-content-between float-left w-100">
                                <strong>Shipping</strong>
                                <span class="c-total-price"><span>Flat Rate:</span> 30.000$</span>
                            </div>
                            <div class="single-total-content tt-total d-flex justify-content-between float-left w-100">
                                <strong>Total</strong>
                                <span class="c-total-price">{{ number_format($total+30000,0,',','.') }}$</span>
                            </div>
                            <a href="checkout_page.html" class="btn btn-primary float-left w-100 text-center">Proceed to
                                checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>