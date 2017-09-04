@extends('layouts.app')

@section('title')
    <title>Moree.me - Connecting people: The Game Page</title>
@endsection

@section('stylesheets')
    {{--<link href="{{asset('libs/bootstrap-slider/bslider.css')}}" rel="stylesheet">--}}
@endsection

@section('header')
    @include('include.header_app')
@endsection

@section('content')
    <div class="clearfix"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                {{--trending--}}
                <div class="bg-grey" id="trending_container" >
                    <div class="">
                        <div class="row">
                            <div class="col-md-6 col-md-offset-3">
                                <div class="btn-group btn-group-justified">
                                    <p class="subtitle fancy"><span>Trending</span></p>

                                    {{--<a href="#" class="btn  trending_menu">Trending</a>--}}
                                </div>
                            </div>
                        </div>
                        <div class="row trending-items">
                            @foreach($trending as $i => $t)
                                <div class="col-sm-12">
                                    <div class="trending-item">
                                        @if($i == 0)
                                            <div class="card hovercard" data-step="6" data-intro='Every week, we connect you to the person that picked you the most' data-position="bottom">
                                        @elseif($i == 1)
                                            <div class="card hovercard" data-step="1" data-intro='This is a potential connection!'>
                                        @elseif($i > 2)
                                            <div class="card hovercard hidden-xs hidden-sm">
                                        @else
                                            <div class="card hovercard">
                                        @endif
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

                                                @if($i == 1)
                                                    <div class="desc" data-step="2" data-intro='This is the spot this person would like to meet!' data-position="bottom">
                                                @else
                                                    <div class="desc">
                                                @endif
                                                    @if($t->venue()->first())
                                                        <strong class="icon icon-location font-main">&nbsp;</strong>{{$t->venue()->first()->name}}
                                                    @else
                                                        <strong class="icon icon-location font-main">&nbsp;</strong>No venue yet!
                                                    @endif
                                                </div>
                                                @if($i == 1)
                                                    <div class="desc" data-step="3" data-intro='This is the number of picks this person has so far this week!' data-position="bottom">
                                                @else
                                                    <div class="desc">
                                                @endif
                                                    <strong class="icon icon-heart3 font-main">&nbsp;</strong> <span class="vote-count">{{$t->vote}}</span>
                                                </div>

                                            </div>

                                            @if($i == 1)
                                                <div class="bottom" data-step="4" data-intro="Pick this person as many times as you can" data-position="top">
                                            @else
                                                <div class="bottom">
                                            @endif
                                                <a href="#" class="pick-btn main-btn vote-btn btn-sm btn-block" data-id="{{$t->id}}">
                                                    <strong class="icon icon-heart3" aria-hidden="true">&nbsp;</strong>Pick
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-9">
                {{--PICK SECTION--}}
                <div class="bg-grey">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="btn-group btn-group-justified hidden-xs hidden-sm" id="game">
                                <p class="subtitle fancy fancy-long"><span>Pick Now</span></p>
                            </div>
                        </div>
                    </div>

                    {{--Filter Panel--}}
                    <div class="row" id="filter-container" data-step="5" data-intro='Use this to filter, search and make your choice' data-position="top">
                        <div class="col-md-4">
                            <h5 class="text-muted">Filter</h5>
                            <div class="row">
                                <div class="col-xs-6 col-sm-4">
                                    <button id="femaleFilter" class="btn btn-block btn-default filter-btn-option btn-sm" data-filter-id="femaleFilter">Females</button>
                                </div>
                                <div class="col-xs-6 col-sm-4">
                                    <button id="maleFilter" class="btn btn-block btn-default filter-btn-option btn-sm" data-filter-id="maleFilter">Males</button>
                                </div>
                                <div class="col-xs-12 col-sm-4">
                                    <button id="spotFilter" class="btn btn-block btn-default filter-btn-option btn-sm" data-filter-id="spotFilter">My Spot</button>
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
                    <div class="">
                        {{--<div class="loading-area"></div>--}}
                        <script type="text/html" id="profile_TMP">
                            <div class="col-md-6">
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
                                                <h4 data-venue="[[VENUEID]]" data-sex="[[SEX]]" class="text-center">[[NAME]]</h4>
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
                                            <a href="#" class="pick-btn main-btn vote-btn btn-sm btn-block" data-id="[[ID]]">
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

                        {{--<div class="text-center">--}}
                        {{--<button class="btn btn-primary">Invite your friends to see more...</button>--}}
                        {{--</div>--}}
                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('utils.votePay')
    @include('utils.account')
@endsection

@section('bottomScripts')
    @parent
    {{--<script src="{{asset("libs/owl/owl.carousel.min.js")}}"></script>--}}
    {{--<script src="{{asset("libs/bootstrap-slider/bslider.js")}}"></script>--}}
    <script src="{{asset('js/app/infiniteScroll.js')}}"></script>
    <script src="{{asset('js/app/App.js')}}"></script>
    <script src="{{asset('js/app/Vote.js')}}"></script>
    <script src="{{asset('js/app/Pay.js')}}"></script>
    <script src="{{asset('js/app/Account.js')}}"></script>
@endsection