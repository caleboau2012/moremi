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
    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Ubuntu:400,700,500' rel='stylesheet' type='text/css'>
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
                version    : 'v2.6'
            });
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
    <div class=" container-fluid whitebg nopadding">

        <div class="container nopadding">
            <div class="row  ">
                <!-- Logo Div Start-->
                <div class=" col-lg-3 col-md-12 col-xs-12">

                    <a class="navbar-brand" href="#">
                        <div class="lgo"><img src="{{asset('images/logo.png')}}"  height="40" alt="Logo"/></div>
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
                <div class="col-lg-3 col-lg-offset-9 col-md-12 col-xs-12 loginbg loginsearch-div group  ">
                    <div class="row form-small text-center">
                        <button data-url="{{route("login")}}" id="login" class="btn btn-primary" style="background-color: #025DAC">
                            <span class="fa fa-facebook-official"></span>
                            <span>Login with Facebook</span>
                        </button>
                        <a id="login-cheek" href="{{route("profile")}}" class="profile-button btn hidden">
                            <span class="fa fa-user"></span>
                            <span>Edit your profile</span>
                        </a>
                        <a class="profile-button btn hidden" id="login-not-cheek">
                            <span>Please vote for cheeks to enjoy Moremi</span>
                        </a>
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

@section('scripts')
<!--JQuery Script-->
<script src="{{asset('js/vendor/jquery-1.9.1.min.js')}}" ></script>
<!--Owl Carousel Script-->
<script src="{{asset('js/vendor/owl.carousel.min.js')}}"></script>
<!--Bootstrap Script-->
<script src="{{asset('js/vendor/bootstrap.min.js')}}"></script>
<!--Popup Javascript-->
<script src="{{asset('js/vendor/jquery.magnific-popup.min.js')}}"></script>
<!--weather Script-->
<!-- Image Customization Script-->
<script src="{{asset('js/vendor/picturefill.min.js')}}"></script>
<!-- Link Effect Script-->
<script src="{{asset('js/vendor/modernizr.custom.min.js')}}"></script>
<!-- Price Slider -->
<script src="{{asset('js/vendor/bootstrap-slider.min.js')}}"></script>
<!--style switcher-->
<script src="{{asset('js/vendor/style-switcher.min.js')}}"></script>
<!--wow animation-->
<script src="{{asset('js/vendor/wow.min.js')}}"></script>
<!--Preview Toolbar-->
<script src="{{asset('js/vendor/jquery.toolbar.min.js')}}"></script>
<!--Custom Javascript-->
<script src="{{asset('js/vendor/custom2.js')}}"></script>
<!--FacebookScript-->
<script src="{{asset('js/app/Facebook.js')}}"></script>
@show
</body>

</html>
