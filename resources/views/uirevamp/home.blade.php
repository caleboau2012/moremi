@extends('layouts.app')
@section('stylesheets')
    <link href="{{asset('libs/owl/owl.carousel.css')}}" rel="stylesheet">
@endsection

@section('header')
    @include('include.header')
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
@endsection

@section('content')
    <div id="home_banner" class="non-xs">
        <div class="overlay">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1" data-scrollreveal="enter left after 0.15s over 1s">
                            <h1 class="text-white text-center text-uppercase">
                                <strong>
                                    It all begins with a date
                                </strong>
                            </h1>
                            <div class="row">
                                <p class="text-center text-white col-md-6 col-md-offset-3">
                                    Moore.me will help you meet people and set you up on a date. All expenses paid by us.
                                    <br>
                                    Simply pick someone and pick a spot.
                                </p>
                            </div>
                            <div class="row text-center">
                                @if(!$loggedIn)
                                    <button class="btn btn-default get_started login"  data-url="{{route("login")}}">Get Started</button>
                                @else
                                    <a href="{{route('app')}}" class="btn btn-default get_started profile" >Find A Date</a>
                                @endif
                            </div>
                        </div>

                    </div><!-- Row -->
                </div>
            </div>
        </div>
    </div>

    {{--About Moore.me--}}
    <div id="about_content">
        <div class="col-md-6 no-padding">
            <img src="{{asset('images/about_banner.jpg')}}" alt="" class="img-responsive">

        </div>
        <div class="col-md-6">
            <div id="about_caption_content">
                <h4 class="text-primary text-center">Get Connected on Moree.me</h4>
                <p>
                    Meeting people has never been this easy. Pick someone from Monday through to Saturday and meet on Sunday. Here's how:
                </p>
                <ul>
                    <li>
                        Login with your facebook account
                    </li>
                    <li>
                        Create a profile
                    </li>
                    <li>
                        Pick someone
                    </li>
                    <li>
                        Keep picking the same person in a week. We connect the highest pickers and the person they pick
                    </li>
                    <li>
                        Everything resets at the end of the week so you can pick someone new and go on a date every week
                    </li>
                </ul>

                <div class="text-center">
                    @if(!$loggedIn)
                        <button class="btn get_started login"  data-url="{{route("login")}}">Get Started</button>
                    @else
                        <a href="{{route('app')}}" class="btn get_started profile"  data-url="{{route("login")}}">Connect Now</a>
                    @endif
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
        {{--<div class="row">
            <div class="col-md-6">
            </div>
            <div class="col-md-6">
                <div id="about_caption_content">
                    <h4 class="text-primary text-center">Get Connected on Moree.me</h4>
                    <p>
                        Meeting people has never been this easy. Pick someone from Monday through to Saturday and meet on Sunday. Here's how:
                    </p>
                    <ul>
                        <li>
                            Login with your facebook account
                        </li>
                        <li>
                            Create a profile
                        </li>
                        <li>
                            Pick someone
                        </li>
                        <li>
                            Keep picking the same person in a week. We connect the highest pickers and the person they pick
                        </li>
                        <li>
                            Everything resets at the end of the week so you can pick someone new and go on a date every week
                        </li>
                    </ul>

                    <div class="text-center">
                        @if(!$loggedIn)
                            <button class="btn get_started login"  data-url="{{route("login")}}">Get Started</button>
                        @else
                            <a href="{{route('app')}}" class="btn get_started profile"  data-url="{{route("login")}}">Connect Now</a>
                        @endif
                    </div>
                </div>

                <div class="clearfix"></div>
            </div>
        </div>--}}
    </div>

    {{--PICK OF THE MOMENT--}}
    @if($winner != null)
        <div id="moment_pick_container" >
            <div class="container">
                <div class="row">
                    <h3 id="header" class="text-center text-white">Pick of the Moment</h3>
                </div>

                <div class="center-block moment_pick_container_width visible-md visible-lg">
                    <div class="row moment_pick_container_content" style="position:relative;">
                        <div class="moment_pics_container pull-left">
                            <ul class="roundabout roundabout-holder" style="padding: 0; position: relative;">
                                @foreach($winner->profile()->first()->photos()->get() as $photo)
                                <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset($photo->full_path) }}" alt="Cheek of the moment"></li>
                                @endforeach
                            </ul>

                            {{--<ul class="roundabout roundabout-holder" style="padding: 0; position: relative;">
                                <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/0.jpg') }}" alt="Cheek of the moment"></li>
                                <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/6.jpg') }}" alt="Cheek of the moment"></li>
                                <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/1.jpg') }}" alt="Cheek of the moment"></li>
                                <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/2.jpg') }}" alt="Cheek of the moment"></li>
                                <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/3.jpg') }}" alt="Cheek of the moment"></li>
                                <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset('images/cheeks/7.jpg') }}" alt="Cheek of the moment"></li>
                            </ul>--}}
                        </div>
                        <div class="moment_profile_container">
                            <div>
                                <div class="content name_content">
                                    <h4 class="no-margin-bottom name">{{$winner->profile()->first()->first_name}} {{$winner->profile()->first()->last_name}}</h4>
                                    <span class="content-end"></span>

                                </div>
                                <p class="content no-margin-bottom">
                                    @if($winner->profile()->first()->venue()->first() != null)
                                        <span class="icon icon-location text-primary">&nbsp;</span>{{$winner->profile()->first()->venue()->first()->name}}
                                    @else
                                        <span class="icon icon-location text-primary">&nbsp;</span>Venue Undisclosed
                                    @endif
                                </p>
                                <p class="content no-margin-top">
                                    <span class="icon icon-heart3 text-primary">&nbsp;</span>{{$winner->votes}}
                                </p>
                                <p class="content">
                                    <strong>Status:</strong> <br>
                                    {{$winner->profile()->first()->status}}
                                </p>
                                <h5 class="content">
                                    <a href="#"><span class="icon icon-instagram text-primary"></span></a>
                                    <a href="#"><span class="icon icon-facebook-official text-primary"></span></a>
                                    <a href="#"><span class="icon icon-twitter text-primary"></span></a>
                                </h5>
                                
                            </div>

                        </div>

                        <div class="moment_pick_voter_container">
                            @if($winner->picker()->first()->photo()->first())
                                <img src="{{asset($winner->picker()->first()->photo()->first()->thumb_path)}}" alt="" width="65" class="img-circle">
                            @else
                                <img class="img-circle"  src="{{asset('images/apple-icon.png')}}" alt="" width="65">
                            @endif
                            <div class="description">
                                <h5 class="no-margin">Picker</h5>
                                <p class="no-margin text-white">{{$winner->picker()->first()->first_name}} {{$winner->picker()->first()->last_name}}</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="row  hidden-md hidden-lg">
                    <div class="col-md-6 col-md-offset-3">
                        <ul class="roundabout roundabout-holder" style="padding: 0; position: relative;">
                            @foreach($winner->profile()->first()->photos()->get() as $photo)
                                <li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset($photo->full_path) }}" alt="Cheek of the moment"></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-warning">
                            <div class="panel-body">
                                <div class="content name_content">
                                    <h4 class="no-margin-bottom name">Chioma Nwakezuologoomigwojere</h4>
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
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
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
    @endif


    <div class="container-fluid bg-grey" id="trending_container" >
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="btn-group btn-group-justified">
                        <a href="#" class="btn active  trending_menu">Trending</a>
                        <a href="{{route("app")}}" class="btn  trending_menu">Vote Your Pick</a>
                    </div>
                </div>
            </div>
            <div class="row trending-items">
                @foreach($trending as $t)
                    <div class="trending-item">
                        <div class="profile-card">
                            <div class="profile-card-heading">
                                @if($t->photo()->first())
                                    <img class="img-responsive img-circle" src="{{asset($t->photo()->first()->full_path)}}" alt="{{$t->first_name .' '. $t->last_name}}">
                                @else
                                    <img class="img-responsive img-circle"  src="{{asset('images/apple-icon.png')}}">
                                @endif

                            </div>
                            <div class="profile-card-content text-center">
                                <div class="profile-card-name">
                                    <h4 class="text-center">{{$t->first_name}} {{$t->last_name}}</h4>
                                    <div class="content-end"></div>
                                </div>
                                @if($t->about)
                                    <p class="about text-center text-muted">{{$t->about}} &nbsp;</p>
                                @else
                                    <p class="about">No info!</p>
                                @endif
                                <p>
                                    @if($t->venue()->first())
                                        <span class="icon icon-earth">&nbsp;</span>{{$t->venue()->first()->name}}
                                    @else
                                        <span class="icon icon-location">&nbsp;</span>No venue yet!
                                    @endif
                                </p>
                                <p>
                                    <span class="icon icon-heart3">&nbsp;</span> <span class="vote-count">{{$t->vote}}</span>
                                </p>
                                <div>
                                    <button class="btn get_started btn-sm vote-btn btn-fill" data-id="{{$t->id}}">PICK
                                        @if($t->sex ==  "male")
                                            <span class="icon icon-profile-male"></span>
                                        @else
                                            <span class="icon icon-profile-female"></span>
                                        @endif
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="profile-counter-container">
        <div class="overlay">
            <div class="container">
                <div class="col-md-4">
                    <div class="text-center">
                        <span class="text-white icon icon-profile-female"></span>
                        <h3 class="no-margin text-center text-white">{{$females}}+</h3>
                        <div class="divider"></div>
                        <h5 class="no-margin text-white text-center">Registered Ladies</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <span class="text-white icon icon-profile-male"></span>
                        <h3 class="no-margin text-center text-white">{{$males}}+</h3>
                        <div class="divider"></div>
                        <h5 class="no-margin text-white text-center">Registered Men</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="text-center">
                        <span class="text-white icon icon-tags"></span>
                        <h3 class="no-margin text-center text-white">{{$dates->count()}}+</h3>
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
        <h3 class="text-center">Spots</h3>
        <div class="row trending-items">
            @foreach($partners as $venue)
                <div class="trending-item">
                    <div class="panel panel-warning">
                        <div class="panel-body text-center">
                            <a href="{{$venue->url}}" target="_blank">
                                <img class="img-responsive img-circle" src="{{asset($venue->thumb)}}" alt="{{$venue->name}}">
                                <div class="clearfix"></div>
                                <h4 class="text-primary">{{$venue->name}}</h4>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @include('utils.votePay');
    @include('utils.account');
@endsection

@section('footer')
    @include('include.footer')
@endsection

@section('bottomScripts')
    @parent
    <script src="{{ asset('libs/roundabout/roundabout.js') }}"></script>
    <script src="{{ asset('libs/jquery/jquery.event.drag.js') }}"></script>
    <script src="{{ asset('libs/jquery/jquery-event-drop.js') }}"></script>
    <script src="{{ asset('libs/jquery/jquery-easing.js') }}"></script>
    <script src="{{asset("libs/owl/owl.carousel.min.js")}}"></script>
    <script src="{{asset('js/app/Vote.js')}}"></script>
    <script src="{{asset('js/app/VotePay.js')}}"></script>
    <script src="{{asset('js/app/Account.js')}}"></script>

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