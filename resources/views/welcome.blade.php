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
                            <div class="slider-subtitle mb-50 text-capitalize float-left w-100 text-shadow">fashion trend</div>
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
                        @include('components.users.product')
                        <!-- end tab sản phẩm -->
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    @include('components.users.footer')

    <!-- Register modal -->
    @include('components.users.registerform')

    <!-- Login modal -->
    @include('components.users.loginform')

    <!-- script hiển thị sản phẩm theo carousel KHÔNG XÓA!!! -->
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