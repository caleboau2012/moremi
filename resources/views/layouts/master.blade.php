<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
    <title>Moremi</title>
    <link rel="shortcut icon" href="{{asset('images/home1/icon.ico')}}">
    <meta name="viewport" content="width=device-width">
    <meta charset="UTF-8">
    <!-- Preloader Css -->
    <link href="{{asset('css/vendor/preloader.min.css')}}" rel="stylesheet" media="screen, print" />
    <!--Bootstrap Css-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/vendor/bootstrap.min.css')}}" />
    <!--Main Custom Css-->
    <link href="{{asset('css/vendor/component.css')}}" rel="stylesheet" />
    <!-- Google Fonts-->
    {{--<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>--}}
    <link href="https://fonts.googleapis.com/css?family=Ubuntu|Ubuntu+Condensed|Ubuntu+Mono" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" href="{{asset('font-awesome/4.5.0/css/font-awesome.min.css')}}">
    <!--Css Animation-->
    <link href="{{asset('css/vendor/animate.min.css')}}" rel="stylesheet" />
    <!-- Owl Carousel Assets -->
    <link href="{{asset('css/vendor/owl.carousel.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/vendor/owl.theme.default.min.css')}}" rel="stylesheet" />
    <!--Links Animation-->
    <link href="{{asset('css/vendor/link-css.min.css')}}" rel="stylesheet" />
    <!--Social Icons Hover Colors-->
    <link href="{{asset('css/vendor/socialicons.min.css')}}" rel="stylesheet" />
    <!--popup css-->
    <link href="{{asset('css/vendor/magnific-popup.min.css')}}" rel="stylesheet" />
    <link href="{{asset('css/vendor/sweetalert.css')}}" rel="stylesheet" />
    <!--Color CSS files-->
    <link href="{{asset('css/vendor/custom-blue.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/vendor/custom-yellow.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/vendor/custom-green.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/vendor/custom-red.min.css')}}" rel="stylesheet" id="style">
    <link href="{{asset('css/app/app.css')}}" rel="stylesheet">
</head>

<body>
@section('facebook')
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '469144689836682',
                xfbml      : true,
                version    : 'v2.7'
            });
            FB.Event.subscribe('xfbml.render', Facebook.status);
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    @show

            <!-- Preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    <!-- style switcher start -->

    <!-- style switcher end -->
    <form class="content">
        <!--End Preview Toolbar HTML-->
        <!--Logo and Social Icons Div Start-->

        <!--Logo and Social Icons Div End-->
        <!--Main Menu Div Start-->
        <div class="container">
            {{--<div class="row ">--}}
                {{--<div class="col-lg-2 fixed-sidebar">--}}
                    {{--<!-- Latest Stories Section(Listing)-->--}}
                    {{--<div class=" latest-div group">--}}


                        {{--<script id="cheeks-template" type="text/html">--}}
                            {{--<li>--}}
                                {{--<a href="#">--}}
                                    {{--<div class="row">--}}
                                        {{--<div>--}}
                                            {{--<img src="[[img-url]]" alt="[[name]]" />--}}
                                        {{--</div>--}}
                                        {{--<div class="col-sm-8">--}}
                                            {{--<span>[[name]]</span>--}}
                                            {{--<span>[[votes]] votes</span>--}}
                                            {{--<span><button class="btn btn-primary btn-xs vote-c" type="button" data-id="[[id]]"><i class="fa fa-square-o"></i> Vote</button></span>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--</script>--}}

                        {{--<script id="cheeks-none" type="text/html">--}}
                            {{--<li>--}}
                                {{--<a>--}}
                                    {{--<p>And... Your query matched no Cheek</p>--}}
                                {{--</a>--}}
                            {{--</li>--}}
                        {{--</script>--}}

                        {{--<div class="listing-div hovercolor latest-div white group pre-scrollable cheeks" id="cheeks" data-url="{{route("cheeks", 10)}}">--}}
                            {{--<div id="cheeks-loading" class="loading hidden"></div>--}}
                            {{--<ul id="contestant-parent">--}}
                            {{--</ul>--}}
                        {{--</div>--}}

                    {{--</div>--}}
                    {{--<!--/  Latest Stories Section (Listing) End-->--}}
                {{--</div>--}}
                {{--<div class="col-lg-8">--}}
                    <div class="row">
                        <div class=" col-lg-3 col-md-12 col-xs-12">
                            <a class="navbar-brand" href="{{route("home")}}">
                                <div class="lgo"><img src="{{asset('images/logo.png')}}"  height="30" alt="Logo"/></div>
                            </a>
                        </div>  <!--/. Logo Div End-->

                        <div class="col-lg-3 col-lg-offset-6 col-md-12 col-xs-12 loginbg loginsearch-div group  ">
                            <div class="row form-small text-center">
                                <button data-url="{{route("login")}}" id="login" class="profile-actions btn btn-primary hidden" type="button" style="background-color: #025DAC">
                                    <span class="fa fa-facebook-official"></span>
                                    <span>Login with Facebook</span>
                                </button>
                                <button id="login-cheek" data-url="{{route("profile")}}" class="profile-actions profile-button btn btn-danger hidden" type="button" style="background-color: #d9534f">
                                    <span class="fa fa-user"></span>
                                    <span>Edit your profile</span>
                                </button>
                                <button id="facebook-fetch" class="profile-actions btn btn-primary hidden" type="button" style="background-color: #025DAC">
                                    <span>Complete profile with </span>
                                    <span class="fa fa-facebook-official"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                {{--</div>--}}
            {{--</div>--}}
        </div>

        <br>

        <!--Main Menu Div End-->
        @yield('content')
        <div class="container-fluid">
            <!--Main Footer Section-->
            <div class="container-fluid footerbg2 row">
                <div class="container footer">
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
                        @yield('past_winners')

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

    @section('scripts')
            <!--JQuery Script-->
    @include('config.App')

    <script src="{{asset('js/vendor/jquery-1.9.1.min.js')}}" ></script>
    <script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>

    <!--Owl Carousel Script-->
    <!--Bootstrap Script-->
    <!--Popup Javascript
    <!--weather Script-->
    <!-- Image Customization Script-->
    <!-- Link Effect Script-->
    <script src="{{asset('js/vendor/modernizr.custom.min.js')}}"></script>
    <!-- Price Slider -->
    <!--style switcher-->
    <!--wow animation-->
    <!--Preview Toolbar-->
    <script src="{{asset('js/vendor/jquery.toolbar.min.js')}}"></script>
    <!--Custom Javascript-->
    <script src="{{asset('js/vendor/custom2.js')}}"></script>
    <script src="{{asset('js/app/Utils.js')}}" ></script>
    <script src="{{asset('js/app/Constants.js')}}" ></script>
    <script src="{{asset('js/vendor/sweetalert.min.js')}}" ></script>
    <script src="{{asset('js/app/Routes.js')}}" ></script>
    <!--FacebookScript-->
    <script src="{{asset('js/app/Facebook.js')}}"></script>
    <script src="{{asset('js/app/Profile.js')}}" ></script>

    <script src="{{asset('js/app/Home.js')}}" ></script>
    <script src="{{asset('js/app/Vote.js')}}"></script>
@show
</body>

</html>
