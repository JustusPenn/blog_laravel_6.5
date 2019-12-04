<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="icon" href="{{ asset('ui/img/favicon.png') }}" type="image/png">
        <title>Social - @yield('title')</title>
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('ui/css/bootstrap.css') }}">
        <link rel="stylesheet" href="{{ asset('ui/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('ui/vendors/fontawesome/css/all.min.css') }}">
        <link rel="stylesheet" href="{{ asset('ui/vendors/owl-carousel/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ asset('ui/vendors/animate-css/animate.css') }}">
        <!-- main css -->
        <link rel="stylesheet" href="{{ asset('ui/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('ui/css/responsive.css') }}">
        @yield('styles')
    </head>
    <body>
        <!--================Header Menu Area =================-->
        <header class="header_area">	
            <div class="main_menu">
                <nav class="navbar navbar-expand-lg navbar-light bg-dark">
                    <div class="container">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <a class="navbar-brand logo_h" href="/">Social</a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        @auth
                            <!-- Collect the nav links, forms, and other content for toggling -->
                            <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                                <ul class="nav navbar-nav menu_nav ml-auto">
                                    <li class="nav-item"><a class="nav-link" href="{{ route('index') }}">Home</a></li> 
                                    <li class="nav-item"><a class="nav-link" href="{{ route('post.create') }}"><i class="fa fa-plus-circle fa-2x"></i></a></li>
                                    <li class="nav-item submenu dropdown">
                                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle fa-2x"></i> {{ Auth::user()->username }}</a>
                                        <ul class="dropdown-menu">
                                            <li class="nav-item"><a class="nav-link" href="{{ route('get-profile', Auth::user()->username)}}">Profile</a></li> 
                                            {{-- <li class="nav-item"><a class="nav-link" href="#">Friend list</a></li> --}}
                                            <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a></li>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </ul>
                                    </li>      
                                </ul>
                            </div>
                        @else
                            <div class="right-button">
                                <ul>
                                    <li><a class="sign_up" href="/login">Sign In</a></li>
                                    <li><a class="sign_up" href="/register">Sign Up</a></li>
                                </ul>
                            </div>
                        @endauth
                    </div>
                </nav>
            </div>
        </header>
        <!--================Header Menu Area =================-->

        @yield('content')
        @include('sweetalert::alert')
        <!-- ================ start footer Area ================= -->
        <footer class="pt-0 footer-area">
            <div class="container">
                <div class="footer-bottom row align-items-center text-center text-lg-left no-gutters">
                    <p class="footer-text m-0 col-lg-8 col-md-12"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved ~ WHNerds</a>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                    <div class="col-lg-4 col-md-12 text-center text-lg-right footer-social">
                        <a href="#"><i class="ti-facebook"></i></a>
                        <a href="#"><i class="ti-twitter-alt"></i></a>
                        <a href="#"><i class="ti-instagram"></i></a>
                        <a href="#"><i class="ti-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- ================ End footer Area ================= -->
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="{{ asset('ui/js/jquery-2.2.4.min.js') }}"></script>
        <script src="{{ asset('ui/js/popper.js') }}"></script>
        <script src="{{ asset('ui/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('ui/vendors/owl-carousel/owl.carousel.min.js') }}"></script>
        <script src="{{ asset('ui/js/jquery.ajaxchimp.min.js') }}"></script>
        <script src="{{ asset('ui/js/waypoints.min.js') }}"></script>
        <script src="{{ asset('ui/js/mail-script.js') }}"></script>
        <script src="{{ asset('ui/js/contact.js') }}"></script>
        <script src="{{ asset('ui/js/jquery.form.js') }}"></script>
        <script src="{{ asset('ui/js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('ui/js/mail-script.js') }}"></script>
        <script src="{{ asset('ui/js/theme.js') }}"></script>
        @yield('scripts')
    </body>
</html>