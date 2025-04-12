<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>{{ $category->category_name }}</title>
    @include('components.users.dashboardlink')
</head>

<body>
    @include('components.users.header')
    <!-- Hiển thị sản phẩm của danh mục hiện tại -->
    <div class="main-content w-100 float-left">
        <div class="container">
            <header class="product-grid-header d-flex justify-content-between align-items-center w-100 float-left">
                <h2>{{ $category->category_name }}</h2>
            </header>
            <div class="tab-content text-center products w-100 float-left category-col-5">
                <div class="tab-pane grid fade active" id="grid" role="tabpanel">
                    <div class="row">
                        @forelse ($category->products as $product)
                            <div class="product-layouts col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="product-thumb">
                                    <div class="image zoom">
                                        <a href="product-details.html">
                                            <img src="{{$product->main_image}}" alt="02">
                                            <img src="{{$product->main_image}}" alt="03" class="second_image img-responsive">
                                        </a>
                                    </div>
                                    <div class="thumb-description">
                                        <div class="caption">
                                            <h4 class="product-title text-capitalize w-100 float-left"><a
                                                    href="product-details.html">{{$product->pname}}</a></h4>
                                        </div>
                                        <div class="rating">
                                            <div class="product-ratings d-inline-block align-middle">
                                                <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                                <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                                <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                                <span class="fa fa-stack"><i class="material-icons off">star</i></span>
                                                <span class="fa fa-stack"><i class="material-icons off">star</i></span>
                                            </div>
                                        </div>
                                        <div class="price">
                                            <div class="regular-price">$100.00</div>
                                            <div class="old-price">$150.00</div>
                                        </div>
                                        <div class="button-wrapper">
                                            <div class="button-group text-center">
                                                <button type="button" class="btn btn-primary btn-cart"
                                                    data-target="#cart-pop" data-toggle="modal"><i
                                                        class="material-icons">shopping_cart</i><span>Add to
                                                        cart</span></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <p>Không có sản phẩm nào trong danh mục này.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    @include('components.users.footer')
    <!-- Cookie -->
    <div class="alert text-center cookiealert" role="alert">
        <b>Do you like cookies?</b> We use cookies to ensure you get the best experience on our website. <a
            href="index.html" rel="noreferrer">learn more</a>

        <button type="button" class="btn btn-primary btn-sm acceptcookies" aria-label="Close">
            I agree
        </button>
    </div>

    <!-- Register modal -->
    @include('components.users.registerform')

    <!-- Login modal -->
    @include('components.users.loginform')
</body>

</html>