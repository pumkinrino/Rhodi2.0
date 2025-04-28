<div class="cart-wrapper">
    <button type="button" class="btn">
        <i class="material-icons">shopping_cart</i>
        <span class="ttcount">{{ $count }}</span> </button>
    <div id="cart-dropdown" class="cart-menu">
        <ul class="w-100 float-left">
            <li class="scrollable-cart" class="scrollable-cart">
                @if(count($cartlist) > 0)
                    @foreach ($cartlist as $item)
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <td class="text-center ">
                                        <a href="{{ route('product.show', $item->productDetail->product->product_id) }}">
                                            <img src="{{ $item->productDetail->product->main_image }}" height="104" width="50">
                                        </a>
                                    </td>
                                    <td class="text-left product-name">
                                        <a href="{{ route('product.show', $item->productDetail->product->product_id) }}">
                                            {{ $item->productDetail->dname }}
                                        </a>
                                        <div class="quantity float-left w-100">
                                            <span class="cart-qty">{{ $item->quantity }} x</span>
                                            <span class="text-left price">
                                                {{ number_format($item->productDetail->selling_price, 0, ',', '.') }}$
                                            </span>
                                        </div>
                                    </td>
                                    <td class=" ml-2 text-center close text-white btn btn-rounded">
                                        <form action="{{ route('cart.remove') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="cart_id" value="{{ $item->cart_id }}">
                                            <button type="submit" class="close-cart border btn btn-rounded ">
                                                x
                                            </button>
                                        </form>
                                    </td>

                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                @else
                    <p class="text-center">You have nothing in here :(</p>
                @endif
            </li>
            <li>
                @php
                    $total = 0;
                @endphp

                @foreach ($cartlist as $item)
                                @php
                                    $total += $item->quantity * $item->productDetail->selling_price;
                                @endphp
                @endforeach

                <table class="table price mb-30">
                    <tbody>
                        <tr>
                            <td class="text-left"><strong>Total</strong></td>
                            <td class="text-right"><strong>{{number_format($total, 0, ',', '.')}}$</strong></td>
                        </tr>
                    </tbody>
                </table>
            </li>
            <li class="buttons w-100 float-left">
                <form action="https://demo.templatetrip.com/Html/HTML001_victoria/cart_page.html">
                    <input class="btn pull-left mt_10 btn-primary btn-rounded w-100" value="View cart" type="submit">
                </form>
                <form action="{{route('checkout')}}">
                    <input class="btn pull-right mt_10 btn-primary btn-rounded w-100" value="Checkout" type="submit">
                </form>
            </li>
        </ul>
    </div>
</div>

<!-- <script>
    document.querySelectorAll('.close-cart').forEach(button => {
        button.addEventListener('click', function () {
            event.stopPropagation();
            let cartId = this.getAttribute('data-id');

            fetch("{{ route('cart.remove') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify({ cart_id: cartId })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        this.closest('tr').remove();
                    } else {
                        alert(data.message);
                    }
                });
        });
    });
</script> -->