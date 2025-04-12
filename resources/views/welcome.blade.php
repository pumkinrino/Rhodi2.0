<!doctype html>
<html lang="en">

<head>
    <title>Fashion Template for Bootstrap</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Demo powered by Templatetrip">
    <meta name="author" content="">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('components.users.dashboardlink')

</head>

<body class="index layout1">
    <!--header-->
    @include('components.users.header')
    <!--header-->

    <main>

        <!-- Top banner -->
        <div class="slider-wrapper my-40 my-sm-25 float-left w-100">
            <div class="container">
                <div class="ttloading-bg"></div>
                <div class="slider slider-for owl-carousel">
                    <div>
                        <a href="#">
                            <img src="https://pos.nvncdn.com/e41e16-5527/bn/20250403_306Vcj1I.gif" alt="" height="800"
                                width="1600" />
                        </a>
                        <div class="slider-content-wrap center effect_top">
                            <div class="slider-title mb-20 text-capitalize float-left w-100">our specials</div>
                            <div class="slider-subtitle mb-50 text-capitalize float-left w-100">fashion trend</div>
                            <div class="slider-button text-uppercase float-left w-100"><a href=" #">Shop Now</a></div>
                        </div>
                    </div>
                    <div>
                        <a href="#">
                            <img src="https://pos.nvncdn.com/e41e16-5527/bn/20250403_306Vcj1I.gif" alt="" height="800"
                                width="1600" />
                        </a>
                        <div class="slider-content-wrap center effect_bottom">
                            <div class="slider-title mb-20 text-capitalize float-left w-100">about us</div>
                            <div class="slider-subtitle mb-50 text-capitalize float-left w-100">fashion style</div>
                            <div class="slider-button text-uppercase float-left w-100"><a href=" #">Shop Now</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- main content -->
        <div class="main-content">
            <div id="main">
                <div id="hometab" class="home-tab my-40 my-sm-25 bottom-to-top hb-animate-element">
                    <div class="container">
                        <!-- tab sản phẩm -->
                        {@include('components.users.product')}
                        <!-- end tab sản phẩm -->
                    </div>
                </div>
            </div>
        </div>
    </main>

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

    <!-- product_view modal -->
    <div class="modal fade product_view" id="product_view" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title w-100w-100w-100 font-weight-bold d-none">Quick view</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 left-columm">
                            <div class="product-large-image tab-content">
                                <div class="tab-pane active" id="product-1" role="tabpanel"
                                    aria-labelledby="product-tab-1">
                                    <div class="single-img img-full">
                                        <a
                                            href="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/01.jpg"><img
                                                src="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/01.jpg"
                                                class="img-fluid" alt="" width="368" height="478"></a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="product-2" role="tabpanel" aria-labelledby="product-tab-2">
                                    <div class="single-img">
                                        <a
                                            href="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/02.jpg"><img
                                                src="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/02.jpg"
                                                class="img-fluid" alt="" width="368" height="478"></a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="product-3" role="tabpanel" aria-labelledby="product-tab-3">
                                    <div class="single-img">
                                        <a
                                            href="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/03.jpg"><img
                                                src="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/03.jpg"
                                                class="img-fluid" alt="" width="368" height="478"></a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="product-4" role="tabpanel" aria-labelledby="product-tab-4">
                                    <div class="single-img">
                                        <a
                                            href="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/04.jpg"><img
                                                src="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/04.jpg"
                                                class="img-fluid" alt="" width="368" height="478"></a>
                                    </div>
                                </div>
                                <div class="tab-pane" id="product-5" role="tabpanel" aria-labelledby="product-tab-5">
                                    <div class="single-img">
                                        <a
                                            href="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/05.jpg"><img
                                                src="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/05.jpg"
                                                class="img-fluid" alt="" width="368" height="478"></a>
                                    </div>
                                </div>
                            </div>
                            <div class="small-image-list float-left w-100">
                                <div class="nav-add small-image-slider-single-product-tabstyle-3 owl-carousel"
                                    role="tablist">
                                    <div class="single-small-image img-full">
                                        <a data-toggle="tab" id="product-tab-1" href="#product-1"
                                            class="img active"><img
                                                src="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/01.jpg"
                                                class="img-fluid" alt=""></a>
                                    </div>
                                    <div class="single-small-image img-full">
                                        <a data-toggle="tab" id="product-tab-2" href="#product-2" class="img"><img
                                                src="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/02.jpg"
                                                class="img-fluid" alt=""></a>
                                    </div>
                                    <div class="single-small-image img-full">
                                        <a data-toggle="tab" id="product-tab-3" href="#product-3" class="img"><img
                                                src="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/03.jpg"
                                                class="img-fluid" alt=""></a>
                                    </div>
                                    <div class="single-small-image img-full">
                                        <a data-toggle="tab" id="product-tab-4" href="#product-4" class="img"><img
                                                src="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/04.jpg"
                                                class="img-fluid" alt=""></a>
                                    </div>
                                    <div class="single-small-image img-full">
                                        <a data-toggle="tab" id="product-tab-5" href="#product-5" class="img"><img
                                                src="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/05.jpg"
                                                class="img-fluid" alt=""></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 product_content">
                            <h4 class="product-title text-capitalize">Printed Polo Collar T-shirt</h4>
                            <div class="rating">
                                <div class="product-ratings d-inline-block align-middle">
                                    <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                    <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                    <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                    <span class="fa fa-stack"><i class="material-icons off">star</i></span>
                                    <span class="fa fa-stack"><i class="material-icons off">star</i></span>
                                </div>
                            </div>
                            <span class="description float-left w-100">Lorem Ipsum is simply dummy text of the printing
                                and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever
                                since the 1500s, when an unknown printer took a galley of type and scrambled it to make
                                a type specimen book.</span>
                            <h3 class="price float-left w-100"><span
                                    class="regular-price align-middle">$75.00</span><span
                                    class="old-price align-middle">$60.00</span></h3>

                            <div class="product-variants float-left w-100">
                                <div class="col-md-4 col-sm-6 col-xs-12 size-options d-flex align-items-center">
                                    <h5>Size:</h5>

                                    <select class="form-control" name="select">
                                        <option value="" selected="">Size</option>
                                        <option value="black">Medium</option>
                                        <option value="white">Large</option>
                                        <option value="gold">Small</option>
                                        <option value="rose gold">Extra large</option>
                                    </select>
                                </div>
                                <div class="color-option d-flex align-items-center">
                                    <h5>color :</h5>
                                    <ul class="color-categories">
                                        <li class="active">
                                            <a class="tt-pink" href="#" title="Pink"></a>
                                        </li>
                                        <li>
                                            <a class="tt-blue" href="#" title="Blue"></a>
                                        </li>
                                        <li>
                                            <a class="tt-yellow" href="#" title="Yellow"></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="btn-cart d-flex align-items-center float-left w-100">
                                <h5>qty:</h5>
                                <input value="1" type="number">
                                <button type="button" class="btn btn-primary"><i
                                        class="material-icons">shopping_cart</i> Add To Cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- cart-pop modal -->
    <div class="modal fade" id="cart-pop" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header alert-success">
                    <h4 class="modal-title w-100w-100w-100">Product successfully added to your shopping cart</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 divide-right">
                            <div class="row">
                                <div class="col-md-5 col-sm-4 col-xs-12 product-img float-left">
                                    <img src="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/01.jpg"
                                        class="img-responsive" alt="01">
                                </div>
                                <div class="col-md-7 col-sm-8 col-xs-12 product-desc float-left">
                                    <h4 class="product-title text-capitalize">Burgundy Small Dress</h4>
                                    <div class="rating">
                                        <div class="product-ratings d-inline-block align-middle">
                                            <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                            <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                            <span class="fa fa-stack"><i class="material-icons">star</i></span>
                                            <span class="fa fa-stack"><i class="material-icons off">star</i></span>
                                            <span class="fa fa-stack"><i class="material-icons off">star</i></span>
                                        </div>
                                    </div>
                                    <h3 class="price float-left w-100"><span
                                            class="regular-price align-middle">$75.00</span><span
                                            class="old-price align-middle">$60.00</span></h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 divide-left">
                            <p class="cart-products-count">There are 2 items in your cart.</p>
                            <p class="total-products float-left w-100">
                                <strong>Total products:</strong> $150.00
                            </p>
                            <p class="shipping float-left w-100">
                                <strong>Total shipping:</strong> free
                            </p>
                            <p class="total-price float-left w-100">
                                <strong>Total:</strong> $150.00(tax incl.)
                            </p>
                            <div class="cart-content-btn float-left w-100">
                                <form action="#">
                                    <input class="btn pull-right mt_10 btn-primary" value="Continue shopping"
                                        type="submit">
                                </form>
                                <form action="https://demo.templatetrip.com/Html/HTML001_victoria/checkout_page.html">
                                    <input class="btn pull-right mt_10 btn-secondary" value="Proceed to checkout"
                                        type="submit">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="compare-wrapper float-left w-100">
        <div class="compare-inner d-flex align-items-center p-20">
            <span class="close"><i class='material-icons'>
                    close
                </i></span>
            <div class="col-xs-12 col-sm-2 col-md-3 float-left d-flex align-items-center flex-column compare-left">
                <h2>compare products</h2>
                <div class="compare-btn">show all</div>
            </div>
            <div class="col-xs-12 col-sm-10 col-md-9 d-flex float-left align-items-center compare-right">
                <div class="compare-close-btn"></div>
                <div class="compare-products d-flex col-sm-7 col-lg-5">
                    <div class="row">
                        <div class="single-item col-sm-4 col-xs-4">
                            <div class="remove"></div>
                            <div class="image"><img
                                    src="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/01.jpg"
                                    class="img-fluid" alt=""></div>
                        </div>
                        <div class="single-item col-sm-4 col-xs-4">
                            <div class="remove"></div>
                            <div class="image"><img
                                    src="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/02.jpg"
                                    class="img-fluid" alt=""></div>
                        </div>
                        <div class="single-item col-sm-4 col-xs-4">
                            <div class="remove"></div>
                            <div class="image"><img
                                    src="https://demo.templatetrip.com/Html/HTML001_victoria/img/products/03.jpg"
                                    class="img-fluid" alt=""></div>
                        </div>
                    </div>
                </div>
                <div class="buttons col-sm-5 col-lg-2">
                    <a href="https://demo.templatetrip.com/Html/HTML001_victoria/compare.html"
                        class="compare-btn btn btn-secondary float-left w-100 mb-15">compare</a>
                    <div class="clear-btn btn btn-primary float-left w-100">clear</div>
                </div>
            </div>
        </div>
    </div>


    <!-- Facebook Pixel Code - PUNIT -->
    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            '../../../connect.facebook.net/en_US/fbevents.js');
        fbq('init', '3156992947902949');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id={3156992947902949}&amp;ev=PageView&amp;noscript=1" />
    </noscript>
    <!-- End Facebook Pixel Code -->
    <script>
        $(document).ready(function () {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                dots: true,
                responsive: {
                    0: { items: 1 },
                    600: { items: 2 },
                    1000: { items: 3 }
                }
            });
        });
    </script>

</body>

</html>