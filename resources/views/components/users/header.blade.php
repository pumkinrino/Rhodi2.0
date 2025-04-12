<header class="header-area header-sticky text-center header-default" style="background-color: #e0d7c6;">
    <div class="header-main-sticky" style="background-color: #e0d7c6;">
        <div class="header-nav">
            <div class="container">
                <div class="nav-left float-left">
                    <div class="ttheader-service">Wants to explore Upcoming Deals on Weekends?</div>
                </div>
                <div class="ttheader-mail">
                    <a href="mailto:rhodishop@gmail.com?subject=Chủ đề&body=Nội dung">rhodishop@gmail.com</a>
                </div>
            </div>
        </div>
        <div class="header-main-head">
            <div class="header-main">
                <div class="container">
                    <div class="header-left float-left d-flex d-lg-flex d-md-block d-xs-block">
                        <div class="contact">
                            <i class="material-icons">phone</i>
                            <a href="tel:+1234567890">0934591228</a>
                        </div>
                    </div>
                    <div class="header-middle float-md-left float-sm-left float-xs-none">
                        <div class="logo">
                            <a href="#"><img src="/image/20240820_jRhCzjIO.jpg" alt="logo" width="200" height="50"></a>
                        </div>
                    </div>
                    <div class="header-right d-flex d-xs-flex d-sm-flex justify-content-end float-right">
                        <div class="search-wrapper">
                            <a>
                                <i class="material-icons search">search</i>
                                <i class="material-icons close">close</i> </a>
                            <form autocomplete="off" action="https://demo.templatetrip.com/action_page.php"
                                class="search-form">
                                <div class="autocomplete">
                                    <input id="myInput" type="text" name="myCountry" placeholder="Search here">
                                    <button type="button"><i class="material-icons">search</i></button>
                                </div>
                            </form>
                        </div>
                        <div class="user-info">
                            <button type="button" class="btn">
                                <i class="material-icons">perm_identity</i> </button>
                            <div id="user-dropdown" class="user-menu">
                                @if(session('customer'))
                                    <ul>
                                        <form action="{{ route('customer.logout') }}" method="POST">
                                            @csrf
                                            <li><b
                                                    style="color: black; text-decoration: underline;">{{ session('customer')->full_name }}</b>
                                            </li>
                                            <li><a href="#" class="modal-view button"><button
                                                        style="background: none; border: none; color: inherit; padding: 0; cursor: pointer;">logout</button></a>
                                            </li>
                                        </form>
                                    </ul>
                                @else

                                    <ul>
                                        <li><a href="https://demo.templatetrip.com/Html/HTML001_victoria/my-account.html"
                                                class="text-capitalize">my account</a></li>
                                        <li><a href="#" class="modal-view button" data-toggle="modal"
                                                data-target="#modalRegisterForm">Register</a></li>
                                        <li><a href="#" class="modal-view button" data-toggle="modal"
                                                data-target="#modalLoginForm">login</a></li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                        @include('components.users.cartpopup')
                    </div>
                </div>
            </div>
            <div class="menu">
                <div class="container">
                    <!-- Navbar -->
                    <nav class="navbar navbar-expand-lg navbar-light d-sm-none d-xs-none d-lg-block navbar-full">

                        <!-- Navbar brand -->
                        <a class="navbar-brand text-uppercase d-none" href="#">Navbar</a>

                        <!-- Collapse button -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Collapsible content -->
                        <div class="collapse navbar-collapse">

                            <!-- Links -->
                            <ul class="navbar-nav m-auto justify-content-center">
                                <li class="nav-item dropdown active">
                                    <a class="nav-link  text-uppercase" href="#">
                                        Home
                                        <span class="sr-only">(current)</span> </a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-uppercase"
                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/category.html">Category</a>
                                    <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3">
                                        <div class="row">
                                            <div class="col-md-6 col-xl-4 sub-menu mb-md-0 mb-4">
                                                <h6 class="sub-title text-uppercase font-weight-bold white-text">
                                                    Category</h6>
                                                <ul class="list-unstyled">
                                                    @foreach ($categories as $category)
                                                        <li>
                                                            <a class="menu-item pl-0 text-nowrap fs-6"
                                                                href="{{ route('category.products', $category->category_id) }}">
                                                                {{ $category->category_name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-uppercase"
                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/category.html">
                                        Shop
                                        <span class="sr-only">(current)</span> </a>
                                    <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3">
                                        <div class="sub-menu mb-xl-0 mb-4">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/product-grid.html">
                                                        product grid </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-uppercase"
                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/category.html">Pages</a>
                                    <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3">
                                        <div class="sub-menu">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/about-us.html">
                                                        About us </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/accordions.html">
                                                        Accordions </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/buttons.html">
                                                        Buttons </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link text-uppercase"
                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/contact-us.html">contact
                                        us</a>
                                </li>
                            </ul>
                            <!-- Links -->
                        </div>
                        <!-- Collapsible content -->
                    </nav>
                    <!-- Navbar -->
                    <nav class="navbar navbar-expand-lg navbar-light d-lg-none navbar-responsive">

                        <!-- Navbar brand -->
                        <a class="navbar-brand text-uppercase d-none" href="#">Navbar</a>

                        <!-- Collapse button -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent2" aria-controls="navbarSupportedContent2"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"><i class='material-icons'>sort</i></span>
                        </button>

                        <!-- Collapsible content -->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent2">

                            <!-- Links -->
                            <ul class="navbar-nav m-auto justify-content-center">

                                <!-- Features -->
                                <li class="nav-item dropdown active">
                                    <a class="nav-link dropdown-toggle text-uppercase" data-toggle="collapse"
                                        data-target="#menu1" aria-controls="menu1" aria-expanded="false"
                                        aria-label="Toggle navigation" href="#">
                                        Home
                                        <span class="sr-only">(current)</span> </a>
                                    <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3"
                                        id="menu1">
                                        <div class="sub-menu mb-xl-0 mb-4">
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/index.html">
                                                        Home 1 </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/index2.html">
                                                        Home 2 </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/index3.html">
                                                        Home 3 </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/index4.html">
                                                        Home 4 </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/index5.html">
                                                        Home 5 </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li class="nav-item dropdown mega-dropdown">
                                    <a class="nav-link dropdown-toggle text-uppercase" data-toggle="collapse"
                                        data-target="#menu3" aria-controls="menu3" aria-expanded="false"
                                        aria-label="Toggle navigation" href="#">Category</a>
                                    <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3"
                                        id="menu3">
                                        <div class="row">
                                            <div class="col-md-12 col-xl-4 sub-menu mb-xl-0 mb-4">
                                                <h6 class="sub-title text-uppercase font-weight-bold white-text">
                                                    Variation 1</h6>
                                                <!--Featured image-->
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <a class="menu-item pl-0"
                                                            href="https://demo.templatetrip.com/Html/HTML001_victoria/filter-toggle.html">
                                                            filter toggle </a>
                                                    </li>
                                                    <li>
                                                        <a class="menu-item pl-0"
                                                            href="https://demo.templatetrip.com/Html/HTML001_victoria/off-canvas-left.html">
                                                            off canvas left </a>
                                                    </li>
                                                    <li>
                                                        <a class="menu-item pl-0"
                                                            href="https://demo.templatetrip.com/Html/HTML001_victoria/off-canvas-right.html">
                                                            off canvas right </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 col-xl-4 sub-menu mb-md-0 mb-4">
                                                <h6 class="sub-title text-uppercase font-weight-bold white-text">
                                                    Variation 2</h6>
                                                <ul class="list-unstyled">
                                                    <li>
                                                        <a class="menu-item pl-0"
                                                            href="https://demo.templatetrip.com/Html/HTML001_victoria/category-5-col.html">
                                                            grid 5 column </a>
                                                    </li>
                                                    <li>
                                                        <a class="menu-item pl-0"
                                                            href="https://demo.templatetrip.com/Html/HTML001_victoria/category-6-col.html">
                                                            grid 6 column </a>
                                                    </li>
                                                    <li>
                                                        <a class="menu-item pl-0"
                                                            href="https://demo.templatetrip.com/Html/HTML001_victoria/category-7-col.html">
                                                            grid 7 column </a>
                                                    </li>
                                                    <li>
                                                        <a class="menu-item pl-0"
                                                            href="https://demo.templatetrip.com/Html/HTML001_victoria/category-8-col.html">
                                                            grid 8 column </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="col-md-6 col-xl-4 sub-menu mb-0">

                                                <ul class="list-unstyled">
                                                    <li>
                                                        <span class="menu-banner"><img
                                                                src="https://demo.templatetrip.com/Html/HTML001_victoria/img/banner/menu-banner.jpg"
                                                                alt="menu-banner" width="210" height="300" /></span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-uppercase" data-toggle="collapse"
                                        data-target="#menu2" aria-controls="menu2" aria-expanded="false"
                                        aria-label="Toggle navigation" href="#">
                                        Shop
                                        <span class="sr-only">(current)</span> </a>
                                    <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3"
                                        id="menu2">
                                        <div class="sub-menu mb-xl-0 mb-4">
                                            <h6 class="sub-title text-uppercase font-weight-bold white-text">
                                                Featured</h6>
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/product-grid.html">
                                                        product grid </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/product-sticky-right.html">
                                                        sticky right </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/product-extended-layout.html">
                                                        Extended layout </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/product-details.html">
                                                        Default layout </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/product-compact.html">
                                                        compact layout </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <!-- Technology -->



                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-uppercase" data-toggle="collapse"
                                        data-target="#menu4" aria-controls="menu4" aria-expanded="false"
                                        aria-label="Toggle navigation" href="#">Blog</a>
                                    <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3"
                                        id="menu4">
                                        <div class="sub-menu">
                                            <h6 class="sub-title text-uppercase font-weight-bold white-text d-none">
                                                Featured</h6>
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/blog-2-column.html">
                                                        blog 2 column </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/blog-3-column.html">
                                                        blog 3 column </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/blog-2-column-masonary.html">
                                                        blog masonary </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/blog-list.html">
                                                        blog list </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/blog-details.html">
                                                        blog details </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link text-uppercase"
                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/contact-us.html">contact
                                        us</a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-uppercase" data-toggle="collapse"
                                        data-target="#menu5" aria-controls="menu5" aria-expanded="false"
                                        aria-label="Toggle navigation" href="#">Pages</a>
                                    <div class="dropdown-menu mega-menu v-2 z-depth-1 special-color py-3 px-3"
                                        id="menu5">
                                        <div class="sub-menu">
                                            <h6 class="sub-title text-uppercase font-weight-bold white-text d-none">
                                                Featured</h6>
                                            <ul class="list-unstyled">
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/about-us.html">
                                                        About us </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/accordions.html">
                                                        Accordions </a>
                                                </li>
                                                <li>
                                                    <a class="menu-item pl-0"
                                                        href="https://demo.templatetrip.com/Html/HTML001_victoria/buttons.html">
                                                        Buttons </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <!-- Links -->
                        </div>
                        <!-- Collapsible content -->

                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>