@extends('layouts.app')
@section('stylesheets')
    <link href="{{asset('libs/owl/owl.carousel.css')}}" rel="stylesheet">
@endsection

@section('content')
    <div id="home_banner">
        <div class="overlay">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1" data-scrollreveal="enter left after 0.15s over 1s">
                            <h1 class="text-white text-center text-uppercase">
                                <strong>
                                    It all begins with a Date
                                </strong>
                            </h1>
                            <div class="row">
                                <p class="text-center text-white col-md-6 col-md-offset-3">
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque eligendi impedit laudantium pariatur provident velit.
                                </p>
                            </div>
                            <div class="row text-center">
                                <button class="btn btn-default get_started">Get Started</button>
                            </div>
                        </div>

                    </div><!-- Row -->
                </div>
            </div>
        </div>
    </div>

    {{--About Moore.me--}}
    <div id="about_content">
        <div class="row">
            <div class="col-md-6">
                <img src="{{asset('images/about_banner.jpg')}}" alt="" class="img-responsive">
            </div>
            <div class="col-md-4 col-md-offset-1">
                <div id="about_caption_content">
                    <h4 class="text-primary text-center">Get Connected on Moree.me</h4>
                    <p>
                        Moore.me is a best application that brings out the best in people. It's easy to use
                    </p>
                    <ul>
                        <li>
                            Login with your facebook account
                        </li>
                        <li>
                            Create a profile
                        </li>
                        <li>
                            Start voting or accumulate vote to get to your office
                        </li>
                    </ul>
                    <div class="text-center">
                        <button class="btn get_started">Get Started</button>
                    </div>
                </div>

            </div>

        </div>
    </div>

    {{--PICK OF THE MOMENT--}}
    <div id="moment_pick_container" >
        <div class="row">
            <h3 id="header" class="text-center text-white">Pick of the Moment</h3>
        </div>

        <div class="center-block moment_pick_container_width">
        <div class="container">
            <div class="row moment_pick_container_content" style="position:relative;">
                <div class="moment_pics_container pull-left">
                    <ul class="roundabout roundabout-holder" style="padding: 0; position: relative;">
                        <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/0.jpg') }}" alt="Cheek of the moment"></li>
                        <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/6.jpg') }}" alt="Cheek of the moment"></li>
                        <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/1.jpg') }}" alt="Cheek of the moment"></li>
                        <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/2.jpg') }}" alt="Cheek of the moment"></li>
                        <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/3.jpg') }}" alt="Cheek of the moment"></li>
                        <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/7.jpg') }}" alt="Cheek of the moment"></li>
                    </ul>
                </div>
                <div class="pull-left moment_profile_container">
                    <div class="content name_content">
                        <h4 class="no-margin-bottom name">Chioma Nwakezuologoomigwojere</h4>
                        <span class="content-end"></span>

                    </div>
                    <p class="content no-margin-bottom">
                        <span class="icon icon-location text-primary">&nbsp;</span>Lagos, Nigeria
                    </p>
                    <p class="content no-margin-top">
                        <span class="icon icon-heart3 text-primary">&nbsp;</span>5,000
                    </p>
                    <p class="content">
                        <strong>Status:</strong> <br>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores quibusdam sequi voluptate.
                    </p>
                    <h5 class="content">
                        <a href="#"><span class="icon icon-instagram text-primary"></span></a>
                        <a href="#"><span class="icon icon-facebook-official text-primary"></span></a>
                        <a href="#"><span class="icon icon-twitter text-primary"></span></a>
                    </h5>
                </div>

                <div class="moment_pick_voter_container">
                    <img src="{{asset('images/users/moses.jpg')}}" alt="" width="65" class="img-circle">
                    <div class="description">
                        <h5 class="no-margin">Highest Picker</h5>
                        <p class="no-margin text-white">Adamu Musa</p>
                        <p class="no-margin text-white">Lagos, Nigeria</p>
                    </div>
                </div>

            </div>
    </div>
    </div>
    </div>

    <div class="container-fluid bg-grey" id="trending_container" >
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="btn-group btn-group-justified">
                        <a href="#" class="btn active  trending_menu">Trending</a>
                        <a href="#" class="btn  trending_menu">Vote Your Pick</a>
                    </div>
                </div>
            </div>
            <div class="row trending-items">
                <div class="trending-item">
                    <div class="profile-card">
                        <div class="profile-card-heading">
                            <img class="img-responsive img-circle" src="{{asset('images/cheeks/0.jpg')}}" alt="Moses">
                        </div>
                        <div class="profile-card-content">
                            <div class="profile-card-name">
                                <h4 class="text-center">Adebayo Sannnimulwirrr</h4>
                                <span class="content-end"></span>
                            </div>
                            <p class="text-center">
                                <span class="icon icon-location">&nbsp;</span>Lagos, Nigeria
                            </p>
                            <p class="text-center">
                                <span class="icon icon-heart3">&nbsp;</span>5,000
                            </p>
                            <div class="text-center">
                                <button class="btn get_started btn-sm vote-btn btn-fill">Vote</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="trending-item">
                    <div class="profile-card">
                        <div class="profile-card-heading">
                            <img class="img-responsive img-circle" src="{{asset('images/cheeks/1.jpg')}}" alt="Moses">
                        </div>
                        <div class="profile-card-content">
                            <div class="profile-card-name">
                                <h4 class="text-center">Adebayo Moses</h4>
                                <span class="content-end"></span>
                            </div>

                            <p class="text-center">
                                <span class="icon icon-location">&nbsp;</span>Lagos, Nigeria
                            </p>
                            <p class="text-center">
                                <span class="icon icon-heart3">&nbsp;</span>1,000
                            </p>
                            <div class="text-center">
                                <button class="btn get_started btn-sm vote-btn btn-fill">Vote</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="trending-item">
                    <div class="profile-card">
                        <div class="profile-card-heading">
                            <img class="img-responsive img-circle" src="{{asset('images/cheeks/5.jpg')}}" alt="Moses">
                        </div>
                        <div class="profile-card-content">
                            <div class="profile-card-name">
                                <h4 class="text-center">Mbakwe Chukwulegezookwe</h4>
                                <span class="content-end"></span>
                            </div>
                            <p class="text-center">
                                <span class="icon icon-location">&nbsp;</span>Lagos, Nigeria
                            </p>
                            <p class="text-center">
                                <span class="icon icon-heart3">&nbsp;</span>80
                            </p>
                            <div class="text-center">
                                <button class="btn get_started btn-sm vote-btn btn-fill">Vote</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="trending-item">
                    <div class="profile-card">
                        <div class="profile-card-heading">
                            <img class="img-responsive img-circle" src="{{asset('images/users/moses.jpg')}}" alt="Moses">
                        </div>
                        <div class="profile-card-content">
                            <div class="profile-card-name">
                                <h4 class="text-center">Adebayo Sannnimulwirrr</h4>
                                <span class="content-end"></span>
                            </div>

                            <p class="text-center">
                                <span class="icon icon-location">&nbsp;</span>Lagos, Nigeria
                            </p>
                            <p class="text-center">
                                <span class="icon icon-heart3">&nbsp;</span>300
                            </p>
                            <div class="text-center">
                                <button class="btn get_started btn-sm vote-btn btn-fill">Vote</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="trending-item">
                    <div class="profile-card">
                        <div class="profile-card-heading">
                            <img class="img-responsive img-circle" src="{{asset('images/cheeks/6.jpg')}}" alt="Moses">
                        </div>
                        <div class="profile-card-content">
                            <div class="profile-card-name">
                                <h4 class="text-center">Mbakwe Chukwulegezookwe</h4>
                                <span class="content-end"></span>
                            </div>

                            <p class="text-center">
                                <span class="icon icon-location">&nbsp;</span>Lagos, Nigeria
                            </p>
                            <p class="text-center">
                                <span class="icon icon-heart3">&nbsp;</span>1,000
                            </p>
                            <div class="text-center">
                                <button class="btn get_started btn-sm vote-btn btn-fill">Vote</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="trending-item">
                    <div class="profile-card">
                        <div class="profile-card-heading">
                            <img class="img-responsive img-circle" src="{{asset('images/cheeks/7.jpg')}}" alt="Moses">
                        </div>
                        <div class="profile-card-content">
                            <div class="profile-card-name">
                                <h4 class="text-center">Adebayo Caleb</h4>
                                <span class="content-end"></span>
                            </div>

                            <p class="text-center">
                                <span class="icon icon-location">&nbsp;</span>Lagos, Nigeria
                            </p>
                            <p class="text-center">
                                <span class="icon icon-heart3">&nbsp;</span>48,000
                            </p>
                            <div class="text-center">
                                <button class="btn get_started btn-sm vote-btn btn-fill">Vote</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="trending-item">
                    <div class="profile-card">
                        <div class="profile-card-heading">
                            <img class="img-responsive img-circle" src="{{asset('images/cheeks/0.jpg')}}" alt="Moses">
                        </div>
                        <div class="profile-card-content">
                            <div class="profile-card-name">
                                <h4 class="text-center">Adebayo Caleb</h4>
                                <span class="content-end"></span>
                            </div>

                            <p class="text-center">
                                <span class="icon icon-location">&nbsp;</span>Lagos, Nigeria
                            </p>
                            <p class="text-center">
                                <span class="icon icon-heart3">&nbsp;</span>39,010
                            </p>
                            <div class="text-center">
                                <button class="btn get_started btn-sm vote-btn btn-fill">Vote</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="profile-counter-container">
        <div class="overlay">
            <div class="container">
                <div class="col-md-4">
                    <div class="text-center">
                        <span class="text-white icon icon-profile-female"></span>
                        <h3 class="no-margin text-center text-white">2000+</h3>
                        <div class="divider"></div>
                        <h5 class="no-margin text-white text-center">Registered Ladies</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <span class="text-white icon icon-profile-male"></span>
                        <h3 class="no-margin text-center text-white">2000+</h3>
                        <div class="divider"></div>
                        <h5 class="no-margin text-white text-center">Registered Men</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <span class="text-white icon icon-tags"></span>
                        <h3 class="no-margin text-center text-white">2000+</h3>
                        <div class="divider"></div>
                        <h5 class="no-margin text-white text-center">Sponsored Dates</h5>
                    </div>
                </div>
                <div class="text-center margin-top-sm">
                    <a href="#" class="btn get_started btn-lg">Connect Now</a>
                </div>
            </div>
        </div>
    </div>

    {{--PARTNERS--}}
    <div class="container" id="partners_section">
        <h3 class="text-center">Partners</h3>
        <div class="row">

        </div>
    </div>
@endsection

@section('bottomScripts')
@parent
<script src="{{ asset('libs/roundabout/roundabout.js') }}"></script>
<script src="{{ asset('libs/jquery/jquery.event.drag.js') }}"></script>
<script src="{{ asset('libs/jquery/jquery-event-drop.js') }}"></script>
<script src="{{ asset('libs/jquery/jquery-easing.js') }}"></script>
<script src="{{asset("libs/owl/owl.carousel.min.js")}}"></script>

<script src="{{ asset('js/Home.js') }}"></script>
<script>
$(function() {

/* Trending Block */
$(".trending-items").owlCarousel({
autoPlay: 3000, //Set AutoPlay to 3 seconds
items : 4,
itemsDesktop : [1199,4],
itemsDesktopSmall : [979,3],
itemsTablet	: [768,2],
navigation : false,
pagination : false
});
})

</script>

@endsection