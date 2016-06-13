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
                    <div class=" col-sm-11 col-xs-12 col-md-11 col-lg-8  menucolor menuhovercolor">
                        <input type="checkbox" name="menu-handler" class="check_handler" id="menu-handler" onclick="null" />
                        <header class="dark">
                            <nav>
                                <label id="navMenu" for="menu-handler" class="ic menu">
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <span class="line"></span>
                                </label>
                                <label for="menu-handler" id="closeNavMenu" class="ic close"></label>
                                <ul class="main-nav">
                                    <li>
                                        <a href="index.html"><span>Home</span></a>
                                    </li>


                                </ul>
                            </nav>
                        </header>
                    </div>
                    <!--/Main Naviagation End-->
                    <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 cart-box">

                    </div>
                    <div class="col-lg-3 col-md-12 col-xs-12 loginbg loginsearch-div group  ">
                        <div class="row form-small">
                            <!--Login Start-->
                            <div class="login-div ">
                                <div class="login-link">
                                    <i class="fa fa-user font-white"></i>
                                    <div class="login-controls loginbg group">
                                        <span class="font-white">Welcome back</span>
                                        <input type="text" placeholder="User Name" onfocus="this.placeholder = ''" onblur="this.placeholder = 'User Name'" />
                                        <input type="text" placeholder="Password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Password'" />
                                        <input type="button" title="Submit" value="submit" />
                                        <a href="#">New user? Register now</a>

                                    </div>
                                </div>

                            </div>
                            <!--Login End-->
                            <!--Search Start-->
                            <div class="search-div">
                                <div class="search-link  searchbg">
                                    <i class="fa fa-search font-white"></i>
                                    <div class="search-controls searchbg font-white">

                                        <span class="font-white">What are you looking for?</span>
                                        <input type="text" placeholder="Enter search text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Search Text'" />
                                        <input type="button" title="Search" value="Search" />

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
        <!--- Main Visual Div-->
        <div class="container-fluid " style="position:relative;">

            <div class="row">
                <div id="owl-main">
                    <div class="item">
                        <div class="svgoverlay1 bannerEffect"></div>
                        <div class="textoverlay ">
                            <h1>
                                <small class="font-white"> FASHION WEEK INSIGHTS</small>
                                <br />  SILK GOWNS AND MORE
                            </h1>
                        </div>

                        <img class="img-responsive" 
                              src="images/home1/desktop/mainvisual.jpg"   alt="">
                                  </div>
                    <div class="item">
                        <div class="svgoverlay1 bannerEffect"></div>
                        <div class="textoverlay">
                            <h1>
                                <small class="font-white"> Best beauty tricks</small>
                                <br />  Guide to Camera ready makeup
                            </h1>
                        </div>
                        <img class="img-responsive"  src="images/home1/desktop/mainvisual2.jpg" alt="">



                    </div>
                    <div class="item">
                        <div class="svgoverlay1 bannerEffect"></div>
                        <div class="textoverlay">
                            <h1 class="font-white">
                                <small class="font-white"> Trendy Accessories</small>
                                <br /> can top off  every outfit
                            </h1>
                        </div>
                        <img class="img-responsive"  src="images/home1/desktop/mainvisual4.jpg"  alt="yah">

                    </div>
                </div>
            </div>
        </div>
        <!--/ Main Visual Div End-->
        <div class="container homecontainer-margin group">
            <div class="row">

                <div class="col-lg-9 col-lg-push-3 ">
                    <!--Images Section Start-->
                    <div class="row">
                        <div class="view view-first img-big shadow imgheight">
                            <img class="img-responsive"  src="images/home1/desktop/img1.jpg"  alt="yah">

                            <!--<picture class="img-responsive">
                                <img src="images/home1/desktop/img1.jpg" alt="" />
                                <source srcset="images/home1/desktop/img1.jpg" media="(min-width: 1024px)">
                                <source srcset="images/home1/tablet/img1.jpg" media="(min-width: 768px)">
                                <source srcset="images/home1/mobile/img1.jpg" media="(min-width: 200px)">
                            </picture>-->


                            <div class="mask1 mask shadow thumbEffect">
                                <h3 class="font-white">This is the first article</h3>
                                <p>
                                    Aliquam quis pulvinar purus etiam cursus
                                </p>
                                <label class="link-effect cl-effect-5">
                                    <a class=""><span class="font-white" data-hover="#vacation">#Vacation</span></a>
                                    <span class="font-white">/</span>

                                    <a class=""><span class="font-white" data-hover="#Fashion">#Fashion</span></a>
                                    <span class="font-white">/</span>

                                    <a class=""><span class="font-white" data-hover="#Dress">#Dress</span></a>
                                </label>



                            </div>
                        </div>
                        <div class="view view-first img-small imgheight">
                            <img class="img-responsive"  src="images/home1/desktop/img2.jpg"   alt="yah">

                            <!--<picture class="img-responsive">
                                <img alt="" src="images/home1/desktop/img2.jpg" />
                                <source srcset="images/home1/desktop/img2.jpg" media="(min-width: 1024px)">
                                <source srcset="images/home1/tablet/img2.jpg" media="(min-width: 768px)">
                                <source srcset="images/home1/mobile/img2.jpg" media="(min-width: 200px)">
                            </picture>-->
                            <div class="mask1 mask shadow thumbEffect">
                                <h3 class="font-white">This is the first article</h3>
                                <p>
                                    Aliquam quis pulvinar purus etiam cursus
                                </p>
                                <label class="link-effect cl-effect-5">
                                    <a class=""><span class="font-white" data-hover="#vacation">#Vacation</span></a>
                                    <span class="font-white">/</span>

                                    <a class=""><span class="font-white" data-hover="#Fashion">#Fashion</span></a>
                                    <span class="font-white">/</span>

                                    <a class=""><span class="font-white" data-hover="#Dress">#Dress</span></a>
                                </label>



                            </div>
                        </div>
                        <div class="view view-first img-small imgheight">
                            <img class="img-responsive"  src="images/home1/desktop/img3.jpg"  alt="yah">

                            <!--<picture class="img-responsive">
                                <img alt="" src="images/home1/desktop/img3.jpg" />
                                <source srcset="images/home1/desktop/img3.jpg" media="(min-width: 1024px)">
                                <source srcset="images/home1/tablet/img3.jpg" media="(min-width: 768px)">
                                <source srcset="images/home1/mobile/img3.jpg" media="(min-width: 200px)">
                            </picture>-->
                            <div class="mask1 mask shadow thumbEffect">
                                <h3 class="font-white">This is the first article</h3>
                                <p>
                                    Aliquam quis pulvinar purus etiam cursus
                                </p>
                                <label class="link-effect cl-effect-5">
                                    <a class=""><span class="font-white" data-hover="#vacation">#Vacation</span></a>
                                    <span class="font-white">/</span>

                                    <a class=""><span class="font-white" data-hover="#Fashion">#Fashion</span></a>
                                    <span class="font-white">/</span>

                                    <a class=""><span class="font-white" data-hover="#Dress">#Dress</span></a>
                                </label>



                            </div>
                        </div>
                        <div class="view view-first img-big imgheight">
                            <img class="img-responsive"  src="images/home1/desktop/img4.jpg"  alt="yah">

                            <!--<picture class="img-responsive">
                                <img alt="" src="images/home1/desktop/img4.jpg" />
                                <source srcset="images/home1/desktop/img4.jpg" media="(min-width: 1024px)">
                                <source srcset="images/home1/tablet/img4.jpg" media="(min-width: 768px)">
                                <source srcset="images/home1/mobile/img4.jpg" media="(min-width: 200px)">
                            </picture>-->
                            <div class="mask1 mask shadow thumbEffect">
                                <h3 class="font-white">This is the first article</h3>
                                <p>
                                    Aliquam quis pulvinar purus etiam cursus
                                </p>
                                <label class="link-effect cl-effect-5">
                                    <a class=""><span class="font-white" data-hover="#vacation">#Vacation</span></a>
                                    <span class="font-white">/</span>

                                    <a class=""><span class="font-white" data-hover="#Fashion">#Fashion</span></a>
                                    <span class="font-white">/</span>

                                    <a class=""><span class="font-white" data-hover="#Dress">#Dress</span></a>
                                </label>



                            </div>
                        </div>
                        <div class="view view-first img-small imgheight">
                            <img class="img-responsive"  src="images/home1/desktop/img5.jpg"  alt="yah">

                            <!--<picture class="img-responsive">
                                <img alt="" src="images/home1/desktop/img5.jpg" />
                                <source srcset="images/home1/desktop/img5.jpg" media="(min-width: 1024px)">
                                <source srcset="images/home1/tablet/img5.jpg" media="(min-width: 768px)">
                                <source srcset="images/home1/mobile/img5.jpg" media="(min-width: 200px)">
                            </picture>-->
                            <div class="mask1 mask shadow thumbEffect">
                                <h3 class="font-white">This is the first article</h3>
                                <p>
                                    Aliquam quis pulvinar purus etiam cursus
                                </p>
                                <label class="link-effect cl-effect-5">
                                    <a class=""><span class="font-white" data-hover="#vacation">#Vacation</span></a>
                                    <span class="font-white">/</span>

                                    <a class=""><span class="font-white" data-hover="#Fashion">#Fashion</span></a>
                                    <span class="font-white">/</span>

                                    <a class=""><span class="font-white" data-hover="#Dress">#Dress</span></a>
                                </label>



                            </div>
                        </div>
                        <div class="view view-first img-small imgheight">
                            <img class="img-responsive"  src="images/home1/desktop/img6.jpg"  alt="yah">

                            <!--<picture class="img-responsive">
                                <img alt="" src="images/home1/desktop/img6.jpg" />
                                <source srcset="images/home1/desktop/img6.jpg" media="(min-width: 1024px)">
                                <source srcset="images/home1/tablet/img6.jpg" media="(min-width: 768px)">
                                <source srcset="images/home1/mobile/img6.jpg" media="(min-width: 200px)">
                            </picture>-->
                            <div class="mask1 mask thumbEffect">
                                <h3 class="font-white">This is the first article</h3>
                                <p>
                                    Aliquam quis pulvinar purus etiam cursus
                                </p>
                                <label class="link-effect cl-effect-5">
                                    <a class=""><span class="font-white" data-hover="#vacation">#Vacation</span></a>
                                    <span class="font-white">/</span>

                                    <a class=""><span class="font-white" data-hover="#Fashion">#Fashion</span></a>
                                    <span class="font-white">/</span>

                                    <a class=""><span class="font-white" data-hover="#Dress">#Dress</span></a>
                                </label>



                            </div>
                        </div>
                    </div>
                    <!--/ . images Section End-->
                    <!--Featured posts Section -->



                </div>

                <div class="col-lg-3 shift-up  col-md-pull-9">

                    <!-- Latest Stories Section(Listing)-->
                    <div class=" latest-div group">
                        <div class="section-head topsectionbg ">
                            <h4>Most Recent</h4>
                        </div>F
                        <div class="listing-div hovercolor latest-div white group">

                            <ul>
                                <li>
                                    <a href="#">
                                        <img alt="" src="images/home1/thumb1.jpg" />
                                        <span>
                                            Weird Make Up Products That Go Too Far.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img alt="" src="images/home1/thumb2.jpg" />
                                        <span>
                                            GABBANA Has launched it's first collection of Hijabs
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img alt="" src="images/home1/thumb3.jpg" />
                                        <span>
                                            Best look at Paris fashion show week.
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img alt="" src="images/home1/thumb4.jpg" />
                                        <span>
                                            All hail Lily-Rose Depp, the new face of Chanel
                                        </span>
                                    </a>
                                </li>

                                <li>
                                    <a href="#">
                                        <img alt="" src="images/home1/thumb5.jpg" />
                                        <span>
                                            John Galliano debuts his first Artisanal collection

                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img alt="" src="images/home1/thumb6.jpg" />
                                        <span>
                                            Haidi returns as the face of Guess for Spring 2015
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <img alt="" src="images/home1/thumb7.jpg" />
                                        <span>
                                            The Best of summmer 2016 Fashion Ads new gallery.
                                        </span>
                                    </a>
                                </li>

                            </ul>


                        </div>
                    </div>
                    <!--/  Latest Stories Section (Listing) End-->


                </div>

            </div>
        </div>
        <!--Horizontal Banner Start-->
        <div class="container-fluid  group ">
            <div class=" horizontal-banner row">
                <div class="container">
                    <h1>
                        <small> FAHSION SHOW 2016</small>
                        <br />BEST OF FALL SHOW
                    </h1>
                    <input type="button" value="Get your copy now" />
                </div>
            </div>
        </div>
        <!--/. Horizontal Banner End-->
        <div class="container-fluid">
            <!--Main Footer Section-->
            <div class="container-fluid footerbg2 row">
                <div class="container footer  ">
                    <div class="col-md-6 ">
                        <div class="row">
                            <!--About Section-->
                            <section class="col-md-7 col-xs-12 col-sm-6 footerbg1 font-white">
                                <h4>About Women Magazine</h4>


                                <p>
                                    Belladonna is HTML magazine theme,
                                    It comes with flexiable structure that can be applied to any business needs.
                                </p><p>
                                    The theme is fully responsive uses minified light weighted scripts and  CSS for fast loading.
                                    Our team provide customer support  upon your purchase.
                                </p>

                            </section>
                            <!--Company Section-->
                            <section class="col-md-5 col-xs-12 col-sm-6  footerbg2">
                                <h4>company Info</h4>
                                <a><i class="fa fa-angle-right"></i> About Webizona</a>
                                <a><i class="fa fa-angle-right"></i> Affliate theme</a>
                                <a><i class="fa fa-angle-right"></i> More items</a>
                                <a><i class="fa fa-angle-right"></i> Help</a>
                                <a><i class="fa fa-angle-right"></i> Short codes</a>



                            </section>
                        </div>
                    </div>

                    <!-- Popular on Facebook-->
                    <section class="col-md-3 col-md-push-3  col-xs-12 col-sm-6  footerbg2">
                        <h4>Popular on Facebook</h4>
                        <p>
                            <a>Gigi Hadid Stuns in Sheer Dress at Fashion Awards.</a>
                            590 Comment
                        </p>
                        <p>
                            <a>Selma Director Takes on Fashion Film for HBO.</a>
                            748 Commentf
                        </p>
                    </section>

                    <!--Latest on Instegram-->
                    <section class="col-md-3 col-md-pull-3  col-xs-12 col-sm-6  footerbg1">
                        <h4>Latest on Instegram</h4><div class="img-div"><a href="#"><img alt="" src="images/home1/instagram8.jpg" class="img-responsive" /></a></div>
                        <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb8.jpg" class="img-responsive" /></a></div>
                        <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb9.jpg" class="img-responsive" /></a></div>
                        <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb10.jpg" class="img-responsive" /></a></div>
                        <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb11.jpg" class="img-responsive" /></a></div>
                        <div class="img-div"><a href="#"><img alt="" src="images/home1/thumb12.jpg" class="img-responsive" /></a></div>


                    </section>
                </div>
            </div>
            <!--/. Main Footer Section End-->
            <!-- End Footer Section-->
            <div class="row  container-fluid bottom-footer footerbg1 row">
                <div class="container ">
                    <div class="col-md-10 col-xs-12">
                        <a href="#">Powered by Webezona. Copyright 2016. All rights reserved.</a>
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
    <script src="{{asset('js/owl.carousel.min.js')}}" async></script>
    <!--Bootstrap Script-->
    <script src="{{asset('js/bootstrap.min.js')}}" async></script>
    <!--Popup Javascript-->
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}" async></script>
    <!--weather Script-->
    <!-- Image Customization Script-->
    <script src="{{asset('js/picturefill.min.js')}}" async></script>
    <!-- Link Effect Script-->
    <script src="{{asset('js/modernizr.custom.min.js')}}" async></script>
    <!-- Price Slider -->
    <script src="{{asset('js/bootstrap-slider.min.js')}}" async></script>
    <!--style switcher-->
    <script src="{{asset('js/style-switcher.min.js')}}" async></script>
    <!--wow animation-->
    <script src="{{asset('js/wow.min.js')}}" async></script>
    <!--Preview Toolbar-->
    <script src="{{asset('js/jquery.toolbar.min.js')}}" async></script>
    <!--Custom Javascript-->
    <script src="{{asset('js/custom2.js')}}" async></script>
</body>

</html>
