@extends('layouts.app')

@section('title')
    <title>Moree.me - Connecting people: The Game Page</title>
@endsection

@section('stylesheets')
    <link href="{{asset('libs/owl/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-slider/bslider.css')}}" rel="stylesheet">
@endsection

@section('header')
    @include('include.header_app')
@endsection

@section('content')
    {{--trending--}}
    <div class="container-fluid bg-grey" id="trending_container" >
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="btn-group btn-group-justified">
                        <a href="#" class="btn active  trending_menu">Trending</a>
                        {{--<a href="#" class="btn  trending_menu">Trending</a>--}}
                    </div>
                </div>
            </div>
            <div class="row trending-items">
                @foreach($trending as $t)
                    <div class="trending-item">
                        <div class="card hovercard">
                            <div class="cardheader">
                            </div>
                                <a href="{{route("my_profile", \Illuminate\Support\Facades\Crypt::encrypt($t->id))}}">
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
                                    <h4 class="text-center text-capitalize">{{$t->first_name}} {{$t->last_name}}</h4>
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

    {{--PICK SECTION--}}
    <div class="container-fluid bg-grey">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="btn-group btn-group-justified">
                    <a href="#" class="btn active  trending_menu">Pick</a>
                </div>
            </div>
        </div>

        {{--Filter Panel--}}
        <div class="container" id="filter-container">
            <div class="col-md-4">
                <h5 class="text-muted">Filter</h5>
                <div class="row">
                    <div class="col-xs-6 col-sm-4">
                        <button id="femaleFilter" class="btn btn-block btn-default filter-btn-option" data-filter-id="femaleFilter">Females</button>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                        <button id="maleFilter" class="btn btn-block btn-default filter-btn-option" data-filter-id="maleFilter">Males</button>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <button id="spotFilter" class="btn btn-block btn-default filter-btn-option" data-filter-id="spotFilter">My Spot</button>
                    </div>
                </div>

                &nbsp;&nbsp;
                {{--<strong>Age: </strong>&nbsp;&nbsp;--}}
                {{--<b> 16</b>--}}
                {{--<input id="age_range" type="text" class="span2" value="" data-slider-min="16" data-slider-max="100" data-slider-step="5" data-slider-value="[25,35]"/> <b> 100</b>--}}

            </div>

            <div class="col-md-8">
                <h5 class="text-right text-muted hidden-sm hidden-xs">Search</h5>
                <div class="input-group input-group-lg">
                    <span class="input-group-addon" id="sizing-addon1">
                        <span class="icon icon-search text-muted"></span>
                    </span>
                    <input type="text" id="input-filter-search" data-url="{{route('cheeks', '10')}}" class="form-control" placeholder="Search..." aria-describedby="sizing-addon1">
                </div>
            </div>

        </div>

        {{--PICKS AREA--}}
        <div class="container">
            {{--<div class="loading-area"></div>--}}
            <script type="text/html" id="profile_TMP">
                <div class="col-md-3">
                    <div class="pick-item">
                        <div class="card hovercard">
                            <div class="cardheader"></div>
                            <a href="[[URL]]">
                                <div class="avatar center-block">
                                    <img class="img-responsive img-circle" src="{{\Illuminate\Support\Facades\URL::to('/')}}/[[PHOTO]]" alt="[[NAME]]">
                                </div>
                            </a>
                            <div class="info">
                                <div class="title name">
                                    <h4 class="text-center">[[NAME]]</h4>
                                    <div class="content-end"></div>
                                </div>
                                <div class="desc">
                                    <p>[[DATA-ABOUT]]</p>
                                </div>
                                <div class="desc">
                                    <strong class="icon icon-location font-main">&nbsp;</strong>[[VENUE]]
                                </div>
                                <div class="desc">
                                    <strong class="icon icon-heart3 font-main">&nbsp;</strong> <span class="vote-count">[[VOTE]]</span>
                                </div>
                            </div>

                            <div class="bottom">
                                <a href="#" class="pick-btn main-btn vote-btn btn-sm pull-center " data-id="[[ID]]">
                                    <strong class="icon icon-heart3" aria-hidden="true">&nbsp;</strong>Pick
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </script>
            <div class="pick-items">
                <div id="cheeks-inf">

                </div>
                <div class="loading-area">

                </div>
            </div>

            <div class="clearfix"></div>

            <div class="text-center">
                <button class="btn btn-primary">Invite your friends to see more...</button>
            </div>
        </div>

    </div>

    @include('utils.votePay')
    @include('utils.account')
@endsection

@section('bottomScripts')
    @parent
    <script src="{{asset("libs/owl/owl.carousel.min.js")}}"></script>
    <script src="{{asset("libs/bootstrap-slider/bslider.js")}}"></script>
    <script src="{{asset('js/app/infiniteScroll.js')}}"></script>
    <script src="{{asset('js/app/App.js')}}"></script>
    <script src="{{asset('js/app/Vote.js')}}"></script>
    <script src="{{asset('js/app/VotePay.js')}}"></script>
    <script src="{{asset('js/app/Account.js')}}"></script>
@endsection