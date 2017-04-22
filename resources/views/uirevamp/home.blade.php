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
                        <div class="col-md-6" data-scrollreveal="enter left after 0.15s over 1s">
                            <h2 class="text-white">
                                It all begins with a
                                <br>
                                <span class="bg-text text-primary">DATE!</span>
                            </h2>
                        </div>

                        <div class="col-md-5 col-md-offset-1" data-scrollreveal="enter right after 0.15s over 1s">
                           <div id="login_container">
                                <h3 class="no-margin text-white">Starts Here</h3>
                               <p class="text-grey">
                                   Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci deleniti, dignissimos dolore error incidunt nam?
                               </p>
                               <div>
                                   <button class="btn btn-lg btn-brand-primary btn-primary btn-fill">Get Started</button>
                               </div>
                           </div>
                        </div><!--Col-md-6-->
                    </div><!-- Row -->
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="roundabout roundabout-holder" style="padding: 0; position: relative;">
                    <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/0.jpg') }}" alt="Cheek of the moment"></li>
                    <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/6.jpg') }}" alt="Cheek of the moment"></li>
                    <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/1.jpg') }}" alt="Cheek of the moment"></li>
                    <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/2.jpg') }}" alt="Cheek of the moment"></li>
                    <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/3.jpg') }}" alt="Cheek of the moment"></li>
                    <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/7.jpg') }}" alt="Cheek of the moment"></li>
                </ul>
            </div>
            
            <div class="col-md-5 col-md-offset-2">
                <h3>Cheek Of The Moment</h3>
                <hr class="no-margin-top">
                <h4 class="text-primary">
                    Adedoyin Omotayo
                </h4>
                <p>
                    <span class="icon icon-location">&nbsp;</span>Lagos, Nigeria
                </p>
                <p>
                    <strong>Bio:</strong> <br>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores quibusdam sequi voluptate. Asperiores, laborum, sint.
                </p>
                <h5>
                    <a href="#"><span class="icon icon-instagram text-instagram"></span></a>
                    <a href="#"><span class="icon icon-facebook-official text-facebook"></span></a>
                    <a href="#"><span class="icon icon-twitter text-twitter"></span></a>
                </h5>
            </div>
            
        </div>

    </div>

    <div class="container-fluid bg-grey" >
        <div class="container">
            <h3 class="text-center margin-top-md">TRENDING</h3>
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
                                <button class="btn btn-primary btn-sm vote-btn btn-fill">Vote</button>
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
                                <button class="btn btn-primary btn-sm vote-btn btn-fill">Vote</button>
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
                                <button class="btn btn-primary btn-sm vote-btn btn-fill">Vote</button>
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
                                <button class="btn btn-primary btn-sm vote-btn btn-fill">Vote</button>
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
                                <button class="btn btn-primary btn-sm vote-btn btn-fill">Vote</button>
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
                                <button class="btn btn-primary btn-sm vote-btn btn-fill">Vote</button>
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
                                <button class="btn btn-primary btn-sm vote-btn btn-fill">Vote</button>
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
                <h2 class="text-center text-white">Over 20,0000 Cheeks</h2>
                <div class="text-center">
                    <a href="#" class="btn btn-primary btn-lg">Connect Now</a>
                </div>
            </div>
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