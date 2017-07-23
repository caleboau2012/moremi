@extends('layouts.app')
@section('stylesheets')
    @parent
@endsection

@section('header')
    @include('include.header')
@endsection

@section('content')

    <div class="home relative" id="home" data-stellar-background-ratio="0.4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="st-home-unit">
                        <div class="hero-txt">
                            <h2 class="hero-title">Connecting people</h2>
                            <h3 class="text-white">
                                It's <b>FREE</b>. You PICK the person, you PICK the SPOT, we PAY for the HANGOUT.
                            </h3>
                            <p class="">
                                Moore.me will help you meet new people and give you the opportunity to hangout. All expenses paid by us.
                                <br>
                                Simply pick someone and pick a spot.
                            </p>
                            @if(!$loggedIn)
                                <button class="btn btn-lg main-btn login"  data-url="{{route("login")}}"><span class="icon icon-play"></span> Get Started</button>
                            @else
                                <a href="{{route('app')}}" class="btn btn-lg main-btn profile" ><span class="icon icon-play"></span> Connect Now</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mouse-icon"><div class="wheel"></div></div>
        <div class="col-md-12 end"></div>
    </div>

    {{--About Moore.me--}}
    <div class="" id="about">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-6 no-padding">
                            <img src="{{asset('images/about_banner.jpg')}}" alt="" class="img-responsive">
                        </div>
                        <div class="col-md-6 about-text">
                            <div class="col-md-8 pull-center">
                                <h2 class="font-main m-title mb10">Get Connected On Moree.me </h2>
                                <p>Meeting people has never been this easy. Pick someone from Monday through to Saturday and meet on Sunday. Here's how:</p>
                                <ul>
                                    <li> <i class="icon icon-check-square-o" aria-hidden="true"></i>
                                        Log in with your facebook Account </li>
                                    <li><i class="icon icon-check-square-o" aria-hidden="true"></i>Create a Profile  </li>
                                    <li><i class="icon icon-check-square-o" aria-hidden="true"></i> Pick someone </li>
                                    <li><i class="icon icon-check-square-o" aria-hidden="true"></i> Keep picking the same person in a week. We connect the  highest pickers and the person they pick </li>
                                    <li> <i class="icon icon-check-square-o" aria-hidden="true"></i>Everything resets at the end of the week so you can pick someone new and get to meet every week </li>
                                </ul>
                                <div class="text-center xs-mb10"><a href="#" class="btn main-btn btn-sm pull-center "><span class="icon icon-play"></span> Get Started</a></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="about_content" class="hidden">
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
                        Everything resets at the end of the week so you can pick someone new and get to meet every week
                    </li>
                </ul>

                <div class="text-center">
                    @if(!$loggedIn)
                        <button class="btn get_started login"  data-url="{{route("login")}}"><span class="icon icon-play"></span> Get Started</button>
                    @else
                        <a href="{{route('app')}}" class="btn get_started profile"  data-url="{{route("login")}}"><span class="icon icon-play"></span> Connect Now</a>
                    @endif
                </div>
            </div>

        </div>
        <div class="clearfix"></div>

    </div>

    {{--PICK OF THE MOMENT--}}
    {{--<div class="hidden-xs hidden-sm">--}}
        {{--@if($winner != null)--}}
            {{--<div class="week-pick" id="pick-of-the-week">--}}
                {{--<div class="container">--}}
                    {{--<div class="row">--}}
                        {{--<h3 id="header" class="text-center text-white m-title">Pick of the Moment</h3>--}}
                    {{--</div>--}}

                    {{--<div class="row relative">--}}
                        {{--<div class="col-md-12 pick-container">--}}
                            {{--<div class="col-md-3 col-xs-8 pick-img">--}}
                                {{--<ul class="roundabout roundabout-holder" style="">--}}
                                    {{--@foreach($winner->profile()->first()->photos()->get() as $photo)--}}
                                        {{--<li class="roundabout-slide"><img class="img-thumbnail img-responsive" src="{{ asset($photo->full_path) }}" alt="Cheek of the moment"></li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            {{--<div class=" col-md-5 pick_profile">--}}
                                {{--<div class="content name_content">--}}
                                    {{--<h4 class="no-margin-bottom name">{{$winner->profile()->first()->first_name}} {{$winner->profile()->first()->last_name}}</h4>--}}
                                {{--</div>--}}
                                {{--<p class="content no-margin">--}}
                                    {{--@if($winner->profile()->first()->venue()->first() != null)--}}
                                        {{--<span class="icon icon-location text-primary">&nbsp;</span>{{$winner->profile()->first()->venue()->first()->name}}--}}
                                    {{--@else--}}
                                        {{--<span class="icon icon-location text-primary">&nbsp;</span>Venue Undisclosed--}}
                                    {{--@endif--}}
                                {{--</p>--}}
                                {{--<p class="content">--}}
                                    {{--<span class="icon icon-heart3 text-primary">&nbsp;</span>{{$winner->votes}}--}}
                                {{--</p>--}}
                                {{--@if($winner->profile()->first()->status))--}}
                                {{--<p class="content">--}}
                                    {{--<strong>Status:</strong> <br>--}}
                                    {{--{{$winner->profile()->first()->status}}--}}
                                {{--</p>--}}
                                {{--@endif--}}
                                {{--<h5 class="content">--}}
                                    {{--<a href="#"><span class="icon icon-instagram text-primary"></span></a>--}}
                                    {{--<a href="#"><span class="icon icon-facebook-official text-primary"></span></a>--}}
                                    {{--<a href="#"><span class="icon icon-twitter text-primary"></span></a>--}}
                                {{--</h5>--}}
                            {{--</div>--}}

                            {{--<div class="col-md-3 picker no-margin">--}}
                                {{--<div class="picker-profile">--}}
                                    {{--@if($winner->picker()->first()->photo()->first())--}}
                                        {{--<img src="{{asset($winner->picker()->first()->photo()->first()->thumb_path)}}" alt="" width="65" class="img-circle">--}}
                                    {{--@else--}}
                                        {{--<img class="img-circle"  src="{{asset('images/default.png')}}" alt="" width="65">--}}
                                    {{--@endif--}}
                                    {{--<div class="description" style="float:right;">--}}
                                        {{--<h5 class="no-margin">Highest Picker</h5>--}}
                                        {{--<p class="no-margin text-white">{{$winner->picker()->first()->first_name}} {{$winner->picker()->first()->last_name}}</p>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endif--}}
    {{--</div>--}}

    <div class="trending" id="trending">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="tabs tabs-style-bar">
                        <nav style="">
                            <ul>
                                <li class="left tab-current"><a href="#trending" class="left"><span>Trending</span></a></li>
                                <li class="right">
                                    @if($loggedIn)
                                        <a href="{{route("app")}}" class="right"><span>Make Your Pick</span></a>
                                    @else
                                        <a href="#" data-url="{{route("app")}}" class="right login"><span>Make Your Pick</span></a>
                                    @endif

                                </li>

                            </ul>
                        </nav>
                    </div>

                </div>

            </div>
            <div class="row trending-items">
                @foreach($trending as $t)
                    <div class="trending-item">
                        <div class="card hovercard">
                            <div class="cardheader">
                            </div>
                            <a target="_blank" href="{{route("my_profile", \Illuminate\Support\Facades\Crypt::encrypt($t->id))}}">
                                <div class="avatar">
                                    @if($t->photo()->first())
                                        <img class="img-responsive img-circle" src="{{asset($t->photo()->first()->full_path)}}" alt="{{$t->first_name .' '. $t->last_name}}">
                                    @elseif($t->sex == "male")
                                        <img class="img-responsive img-circle"  src="{{asset('images/default-male.png')}}">
                                    @elseif($t->sex == "female")
                                        <img class="img-responsive img-circle"  src="{{asset('images/default-female.png')}}">
                                    @endif
                                </div>
                            </a>
                            <div class="info">
                                <div class="title name">
                                    <h3 class="text-capitalize">{{$t->first_name}} {{$t->last_name}}</h3>
                                    <div class="content-end"></div>
                                </div>
                                <div class="desc">
                                    @if($t->about)
                                        <p class="about text-center text-muted">{{$t->about}} &nbsp;</p>
                                    @else
                                        <p class="about">No info!</p>
                                    @endif
                                </div>

                                <div class="desc">
                                    @if($t->venue()->first())
                                        <strong class="icon icon-location font-main">&nbsp;</strong>{{$t->venue()->first()->name}}
                                    @else
                                        <strong class="icon icon-location font-main">&nbsp;</strong>No venue yet!
                                    @endif
                                </div>
                                <div class="desc">
                                    <strong class="icon icon-heart3 font-main">&nbsp;</strong> <span class="vote-count">{{$t->vote}}</span>
                                </div>
                            </div>

                            <div class="bottom">
                                <a href="#" class="pick-btn main-btn vote-btn btn-sm pull-center " data-id="{{$t->id}}">
                                    <strong class="icon icon-heart3" aria-hidden="true">&nbsp;</strong>Pick
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div id="profile-counter-container" data-stellar-background-ratio="0.4">
        <div class="">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="funfact">
                            <div class="st-funfact-icon">
                                <img class="img-responsive" width="15%;" src="{{asset('images/counter/ladies.png')}}" >
                            </div>
                            <div class="st-funfact-counter" ><span class="st-ff-count" data-from="0" data-to="{{$females}}" data-runit="1">0</span>+</div>
                            <strong class="funfact-title">Registered Ladies</strong>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="funfact">
                            <div class="st-funfact-icon">
                                <img class="img-responsive" width="15%;" src="{{asset('images/counter/men.png')}}">
                            </div>
                            <div class="st-funfact-counter" ><span class="st-ff-count" data-from="0" data-to="{{$males}}" data-runit="1">0</span>+</div>
                            <strong class="funfact-title">Registered Men</strong>
                        </div><!-- .funfact -->
                    </div>
                    <div class="col-md-4">
                        <div class="funfact">
                            <div class="st-funfact-icon">
                                <img class="img-responsive" width="20%;" src="{{asset('images/counter/table.png')}}">
                            </div>
                            <div class="st-funfact-counter" ><span class="st-ff-count" data-from="0" data-to="{{$dates->count()}}" data-runit="1">0</span>+</div>
                            <strong class="funfact-title">Sponsored Hangouts</strong>
                        </div><!-- .funfact -->
                    </div>
                </div>
                <div class="row">
                    <div class="text-center margin-top-sm">
                        @if(!$loggedIn)
                            <button class="btn get_started login"  data-url="{{route("login")}}"><span class="icon icon-play">&nbsp;</span>Get Started</button>
                        @else
                            <a href="{{route('app')}}" class="btn btn-lg get_started profile"  data-url="{{route("login")}}">Connect Now</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--PARTNERS--}}
    <div class="container" id="partners_section">
        <h3 class="text-center">Spots</h3>
        <div class="row">
            <div class="col-md-12">
                <ul class="clients-carousel list-unstyled">
                    @foreach($spots as $venue)
                        <li>
                            <a href="{{route('spot_redirect', \Illuminate\Support\Facades\Crypt::encrypt($venue->url))}}" target="_blank">
                                <h4 class="text-center text-primary">{{$venue->name}}</h4>
                                <img src="{{route('spot_redirect', \Illuminate\Support\Facades\Crypt::encrypt($venue->thumb))}}" class="img-responsive" alt="{{$venue->title}}">
                            </a>
                        </li>
                    @endforeach
                </ul>

            </div>

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
{{--    <script src="{{ asset('libs/roundabout/roundabout.js') }}"></script>--}}
{{--    <script src="{{ asset('libs/jquery/jquery.event.drag.js') }}"></script>--}}
{{--<script src="{{ asset('libs/jquery/jquery-event-drop.js') }}"></script>--}}
    <script src="{{asset('js/app/Vote.js')}}"></script>
    <script src="{{asset('js/app/Pay.js')}}"></script>
    <script src="{{asset('js/app/Account.js')}}"></script>
    <script src="{{ asset('js/app/Home.js') }}"></script>
@endsection