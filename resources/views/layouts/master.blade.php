<!DOCTYPE html>
<html lang="en" class="no-js">
<head>

    <title>Moremi</title>
    <link rel="shortcut icon" href="{{asset('images/home1/icon.ico')}}">
    <meta name="viewport" content="width=device-width">
    <meta charset="UTF-8">
    <!-- Preloader Css -->
    <link href="{{asset('css/preloader.min.css')}}" rel="stylesheet" media="screen, print" />
    <!--Bootstrap Css-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}" />
    <!--Main Custom Css-->
    <link href="{{asset('css/component.css')}}" rel="stylesheet" />
    <!-- Google Fonts-->
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700,500' rel='stylesheet' type='text/css'>
    <!-- Font Awesome-->
    <link rel="stylesheet" href="{{asset('font-awesome/4.5.0/css/font-awesome.min.css')}}">
    <!--Css Animation-->
    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet" />
    <!-- Owl Carousel Assets -->
    <link href="{{asset('css/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/owl.theme.default.min.css')}}" rel="stylesheet" />
    <!--Links Animation-->
    <link href="{{asset('css/link-css.min.css')}}" rel="stylesheet" />
    <!--Social Icons Hover Colors-->
    <link href="{{asset('css/socialicons.min.css')}}" rel="stylesheet" />
    <!--popup css-->
    <link href="{{asset('css/magnific-popup.min.css')}}" rel="stylesheet" />
    <!--Color CSS files-->
    <link href="{{asset('css/custom-blue.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom-yellow.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom-green.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom-red.min.css')}}" rel="stylesheet" id="style">

</head>

<body>
<!-- Preloader -->
<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
<!-- style switcher start -->

<!-- style switcher end -->
<form class="content">
    <!--End Preview Toolbar HTML-->
    <!--Logo and Social Icons Div Start-->
    <div class=" container-fluid whitebg nopadding">

        <div class="container nopadding">
            <div class="row  ">
                <!-- Logo Div Start-->
                <div class=" col-lg-3 col-md-12 col-xs-12">

                    <a class="navbar-brand" href="#">
                        <div class="logo"></div>
                    </a>

                </div>  <!--/. Logo Div End-->
                <!-- Optional Ad Div -->
                <div class="col-md-6 ">
                </div>

            </div>
        </div>

    </div>
    <!--Logo and Social Icons Div End-->
    <!--Main Menu Div Start-->
    <div class=" container-fluid menucolor">
        <div class="container  nav-div nopadding">
            <div class="row ">
                <!-- Main Navigation Start-->
                {{--<div class=" col-sm-11 col-xs-12 col-md-11 col-lg-8  menucolor menuhovercolor">--}}
                    {{--<input type="checkbox" name="menu-handler" class="check_handler" id="menu-handler" />--}}
                    {{--<header class="dark">--}}
                        {{--<nav>--}}
                            {{--<label id="navMenu" for="menu-handler" class="ic menu">--}}
                                {{--<span class="line"></span>--}}
                                {{--<span class="line"></span>--}}
                                {{--<span class="line"></span>--}}
                            {{--</label>--}}
                            {{--<label for="menu-handler" id="closeNavMenu" class="ic close"></label>--}}
                            {{--<ul class="main-nav">--}}
                                {{--<li>--}}
                                    {{--<a href="index.html"><span>About</span></a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</nav>--}}
                    {{--</header>--}}
                {{--</div>--}}
                <!--/Main Naviagation End-->
                {{--<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 cart-box">--}}

                {{--</div>--}}
                <div class="col-lg-3 col-lg-offset-9 col-md-12 col-xs-12 loginbg loginsearch-div group  ">
                    <div class="row form-small text-center">
                        <!--Login Start-->
                        <div class="login-div ">
                            <div class="login-link">
                                <i class="fa fa-user font-white"></i>
                                <div class="login-controls loginbg group">
                                    <span class="font-white">Welcome</span>
                                    <button type="button" class="btn btn-sm btn-primary"><span class="fa fa-facebook-official"></span> <span>Login with Facebook</span></button>
                                    {{--<input type="button" title="Submit" value="submit" />--}}
                                    <span>New user? Login now</span>
                                </div>
                            </div>

                        </div>
                        <!--Login End-->
                        <!--Search Start-->
                        <div class="search-div">
                            <div class="search-link  searchbg">
                                <i class="fa fa-search font-white"></i>
                                <div class="search-controls searchbg font-white">

                                    <span class="font-white">Who are you looking for?</span>
                                    <input type="text" placeholder="Enter a name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter a Name'" />
                                    <button type="button" class="btn btn-primary btn-sm"><span class="fa fa-search"></span> <span>Search</span></button>

                                </div>
                            </div>
                            <!---   <input id="search" name="search" type="text" placeholder="What're we looking for ?">



                            <input id="search_submit" value="&#xf002;" type="submit">-->
                        </div>
                        <!--/ . Search End-->
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!--Main Menu Div End-->
    @yield('content')
    <div class="container-fluid">
        <!--Main Footer Section-->
        <div class="container-fluid footerbg2 row">
            <div class="container footer  ">
                <div class="col-md-3">
                    <div class="row">
                        <!--About Section-->
                        <section class="col-xs-12 footerbg1 font-white">
                            <h4>About Moremi</h4>


                            <p>
                                Moremi is a web application that brings out the best in women.
                                It is easy to use. Just vote your most beautiful lady.
                            </p>
                            <p>
                                There is only one caveat. You can only vote once a day. The day starts 0:00 GMT
                            </p>

                        </section>
                        {{--<!--Company Section-->--}}
                        {{--<section class="col-md-5 col-xs-12 col-sm-6  footerbg2">--}}
                            {{--<h4>Info</h4>--}}
                            {{--<a><i class="fa fa-angle-right"></i> FAQ</a>--}}
                            {{--<a><i class="fa fa-angle-right"></i> Affliate theme</a>--}}
                            {{--<a><i class="fa fa-angle-right"></i> More items</a>--}}
                            {{--<a><i class="fa fa-angle-right"></i> Help</a>--}}
                            {{--<a><i class="fa fa-angle-right"></i> Short codes</a>--}}



                        {{--</section>--}}
                    </div>
                </div>

                <!--Latest on Instegram-->
                <section class="col-md-6 col-xs-12 col-sm-6  footerbg1">
                    <h4>Previous Winners</h4><div class="img-div"><a href="#"><img alt="" src="images/home1/instagram8.jpg" class="img-responsive" /></a></div>
                    <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb8.jpg" class="img-responsive" /></a></div>
                    <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb9.jpg" class="img-responsive" /></a></div>
                    <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb10.jpg" class="img-responsive" /></a></div>
                    <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb11.jpg" class="img-responsive" /></a></div>
                    <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb12.jpg" class="img-responsive" /></a></div>
                    <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb8.jpg" class="img-responsive" /></a></div>
                    <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb9.jpg" class="img-responsive" /></a></div>
                    <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb10.jpg" class="img-responsive" /></a></div>
                    <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb11.jpg" class="img-responsive" /></a></div>
                    <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb12.jpg" class="img-responsive" /></a></div>
                    <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb8.jpg" class="img-responsive" /></a></div>
                    <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb9.jpg" class="img-responsive" /></a></div>
                    <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb10.jpg" class="img-responsive" /></a></div>
                    <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb11.jpg" class="img-responsive" /></a></div>
                    <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb12.jpg" class="img-responsive" /></a></div>
                </section>

                <!-- Popular on Facebook-->
                <section class="col-md-3 col-xs-12 col-sm-6  footerbg2">
                    <h4>Twitter Timeline</h4>
                    <p>
                        <a>Gigi Hadid Stuns in Sheer Dress at Fashion Awards.</a>
                        590 Comment
                    </p>
                    <p>
                        <a>Selma Director Takes on Fashion Film for HBO.</a>
                        748 Comment
                    </p>
                </section>

            </div>
        </div>
        <!--/. Main Footer Section End-->
        <!-- End Footer Section-->
        <div class="row  container-fluid bottom-footer footerbg1 row">
            <div class="container ">
                <div class="col-md-10 col-xs-12">
                    <a href="#">Copyright 2016. All rights reserved.</a>
                </div>
                <div class="col-md-2 col-xs-12 ">
                    <a href="#"><i class="fa fa-facebook icon-rotate"></i></a><a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-google-plus"></i></a> <a href="#"><i class="fa fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <!--/. End Footer Section -->
    </div>
</form>

<!--JQuery Script-->
<script src="{{asset('js/jquery-1.9.1.min.js')}}" ></script>
<!--Owl Carousel Script-->
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<!--Bootstrap Script-->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!--Popup Javascript-->
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<!--weather Script-->
<!-- Image Customization Script-->
<script src="{{asset('js/picturefill.min.js')}}"></script>
<!-- Link Effect Script-->
<script src="{{asset('js/modernizr.custom.min.js')}}"></script>
<!-- Price Slider -->
<script src="{{asset('js/bootstrap-slider.min.js')}}"></script>
<!--style switcher-->
<script src="{{asset('js/style-switcher.min.js')}}"></script>
<!--wow animation-->
<script src="{{asset('js/wow.min.js')}}"></script>
<!--Preview Toolbar-->
<script src="{{asset('js/jquery.toolbar.min.js')}}"></script>
<!--Custom Javascript-->
<script src="{{asset('js/custom2.js')}}"></script>
</body>

</html>
