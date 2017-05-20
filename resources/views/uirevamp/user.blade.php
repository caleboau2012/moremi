@extends('layouts.app')
@section('stylesheets')
    <link href="{{asset('libs/owl/owl.carousel.css')}}" rel="stylesheet">
    <link href="{{asset('libs/bootstrap-slider/bslider.css')}}" rel="stylesheet">
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
                        <div class="profile-card">
                            <div class="profile-card-heading">
                                <img class="img-responsive img-circle" src="{{asset($t->photo()->first()->full_path)}}" alt="Moses">
                            </div>
                            <div class="profile-card-content text-center">
                                <div class="profile-card-name">
                                    <h4 class="text-center">{{$t->first_name}} {{$t->last_name}}</h4>
                                </div>
                                <p class="about">{{$t->about}} &nbsp;</p>
                                <p>
                                    <span class="icon icon-earth">&nbsp;</span>{{$t->venue()->first()->name}}
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

                <button id="femaleFilter" class="btn btn-default filter-btn-option" data-filter-id="femaleFilter">Females</button>
                <button id="maleFilter" class="btn btn-default filter-btn-option" data-filter-id="maleFilter">Males</button>
                <button id="spotFilter" class="btn btn-default filter-btn-option" data-filter-id="spotFilter">My Spot</button>

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
                        <div class="profile-card">
                            <div class="profile-card-heading">
                                <img class="img-responsive img-circle" src="{{\Illuminate\Support\Facades\URL::to('/')}}/[[PHOTO]]" alt="Moses">
                            </div>
                            <div class="profile-card-content text-center">
                                <div class="profile-card-name" data-sex="[[SEX]]" data-venue="[[VENUEID]]">
                                    <h4 class="text-center">[[NAME]]</h4>
                                </div>
                                <p class="about">[[DATA-ABOUT]] &nbsp;</p>
                                <p>
                                    <span class="icon icon-earth">&nbsp;</span>[[VENUE]]
                                </p>
                                <p>
                                    <span class="icon icon-heart3">&nbsp;</span><span class="vote-count">[[VOTE]]</span>
                                </p>
                                <div>
                                    <button class="btn get_started btn-sm vote-btn btn-fill" data-id="[[ID]]">
                                        Pick <span class="icon [[SEXICON]]"></span>
                                    </button>
                                </div>
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

    @include('utils.votePay');
@endsection

@section('bottomScripts')
    @parent
    <script src="{{asset("libs/owl/owl.carousel.min.js")}}"></script>
    <script src="{{asset("libs/bootstrap-slider/bslider.js")}}"></script>
    <script src="{{asset('js/app/infiniteScroll.js')}}"></script>
    <script src="{{asset('js/app/Home.js')}}"></script>
    <script src="{{asset('js/app/Vote.js')}}"></script>
    <script src="{{asset('js/app/VotePay.js')}}"></script>
@endsection