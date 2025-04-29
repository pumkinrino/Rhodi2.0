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
                            <a href="/"><img src="/image/20240820_jRhCzjIO.jpg" alt="logo" width="200" height="50"></a>
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
                    @if(session('error'))
                        <div style="z-index: 5;"
                            class="alert alert-danger text-center header-right d-flex d-xs-flex d-sm-flex justify-content-end float-right">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if(session('success'))
                        <div style="z-index: 5;" class="alert alert-success text-center header-right d-flex d-xs-flex d-sm-flex justify-content-end float-right">
                            {{ session('success') }}
                        </div>
                    @endif
                </div>
            </div>
            <div class="menu">
                <div class="container">
                    <!-- Navbar -->
                    <nav class="navbar navbar-expand-lg navbar-light d-sm-none d-xs-none d-lg-block navbar-full">
                        <!-- Collapsible content -->
                        <div class="collapse navbar-collapse">

                            <!-- Links -->
                            <ul class="navbar-nav m-auto justify-content-center">
                                <li class="nav-item dropdown active">
                                    <a class="nav-link  text-uppercase" href="/">
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
                                    <a class="nav-link text-uppercase"
                                        href="{{ route('aboutus') }}">contact
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