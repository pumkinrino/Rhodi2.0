<header class="header-area header-sticky text-center header-default">
    <div class="header-main-sticky">
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
                    <div class="header-middle float-md-left float-sm-left float-xs-none" style="top: 3%;">
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
                                            <li><b
                                                    style="color: black; text-decoration: underline;">{{ session('customer')->customer_id }}</b>
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
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>