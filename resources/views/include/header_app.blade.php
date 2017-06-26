<div class="st-navbar st-navbar-mini">
    <div class="navbar navbar-default navbar-fixed-top clearfix" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sept-main-nav">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{route('index')}}" title="Home">
                    <img src="{{asset('images/logo3.png')}}" alt="" class="img-responsive">
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse main-nav" id="sept-main-nav">
                <ul class="nav navbar-nav navbar-right">
                    @if(\Request::route()->getName() == "app")
                        <li><a href="#game"><span class="icon icon-play">&nbsp;</span>Connect Now</a></li>
                    @else
                        <li><a href="{{route('app')}}"><span class="icon icon-play">&nbsp;</span>Connect Now</a></li>
                    @endif
                    {{--<li><a href="#home" class="edit_profile_btn"><span class="icon icon-pencil2">&nbsp;</span>Account Details</a></li>--}}
                    <li><a href="#" class="edit_profile_btn"><span class="icon icon-user">&nbsp;</span>Edit Profile</a></li>
                    <li class="active">
                            @if($profile != null)
                            <a href="{{route("profile")}}" class="profile-btn">
                                @if($profile->photo()->first())
                                    <img src="{{asset($profile->photo()->first()->thumb_path)}}" class="profile-thumb profile-dp-img">
                                @elseif($profile->sex == "male")
                                    <img src="{{asset('images/default-male.png')}}" class="profile-thumb profile-dp-img">
                                @elseif(($profile->sex == "female"))
                                    <img src="{{asset('images/default-female.png')}}" class="profile-thumb profile-dp-img">
                                @endif
                                <span>{{$profile->first_name}} {{$profile->last_name}}</span>
                            @else
                                <a href="#" class="profile-btn" title="Public Profile">
                                    <img src="{{asset('images/default.png')}}" class="profile-thumb">
                            @endif
                        </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </div>
</div>

<div>
    <div id="app-header" class="hidden-xs hidden-sm">
        <div class="container-fluid">
            <div style="height: 70px;"></div>
        </div>
        <div class="container" data-step="1" data-intro='The Moree.me game is on!' data-position="bottom">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile_info_item_left" data-step="6" data-intro='Every week, we connect you to the person that picked you the most' data-position="right">
                        <p class="text-right text-white no-margin">Picks this Week</p>
                        <h4 class="no-margin text-white text-right">
                            <strong class="icon icon-heart3 text-white"></strong> {{$profile->vote}}
                        </h4>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="profile_info_item_center" id="profile_dp_container">
                        <a href="{{route("profile")}}" title="Edit Profile">
                            <btn class="dp-edit-btn edit_profile_btn">
                                <span class="icon icon-pencil2 text-white"></span>
                            </btn>
                            @if($profile->photo()->first())
                                <img src="{{asset($profile->photo()->first()->full_path)}}" class="profile-dp-img" alt="Profile DP" id="profile-cover_dp">
                            @elseif($profile->sex == "male")
                                <img src="{{asset('images/default-male.png')}}" class="profile-dp-img" id="profile-cover_dp">
                            @elseif(($profile->sex == "female"))
                                <img src="{{asset('images/default-female.png')}}" class="profile-dp-img" id="profile-cover_dp">
                            @endif
                        </a>
                    </div>
                </div>
                <div class="col-md-4" style="position: relative">
                    <div class="profile_info_item_right">
                        <h4 class="text-left text-white no-margin"> {{$profile->first_name}} {{$profile->last_name}} </h4>
                        @if($profile->about)
                            <p class="no-margin text-white"><strong>Status:</strong></p>
                            <p class="no-margin text-white status-content">{{$profile->about}}</p>
                        @else
                            <br><br>
                        @endif
                    </div>

                </div>
            </div>
        </div>
        <div class="hidden">
            <div id="profile_cover_info_container">
                <div class="profile_info_item">
                    <p class="profile_info_item text-center text-white no-margin">Picks this Week</p>
                    <h4 class="no-margin text-white text-center">
                        <strong class="icon icon-heart3 text-white">&nbsp;</strong>20
                    </h4>

                </div>
                <div class="profile_info_item text-center" id="profile_dp_container">
                        @if($profile->photo()->first())
                            <img src="{{asset($profile->photo()->first()->full_path)}}" alt="Profile DP" id="profile-cover_dp">
                        @elseif($profile->sex == "male")
                            <img src="{{asset('images/default-male.png')}}" id="profile-cover_dp">
                        @elseif(($profile->sex == "female"))
                            <img src="{{asset('images/default-female.png')}}" id="profile-cover_dp">
                        @endif
                    <a href="#" class="dp-edit-btn"><span class="icon icon-pencil2 text-white"></span></a>
                </div>

                <div class="profile_info_item text-left">
                    <h4 class="profile_info_item text-white no-margin"> {{$profile->first_name}} {{$profile->last_name}} </h4>
                    @if($profile->about)
                        <p class="no-margin text-white"><strong>Status:</strong></p>
                        <p class="no-margin text-white">{{$profile->about}}</p>
                    @else
                        <br><br>
                    @endif
                </div>
            </div>
        </div>
        <div class="hidden">
            <a href="{{route("profile")}}">
                <div id="profile-container hidden-xs hidden-sm">
                    <div id="profile-info-left" class="profile-info hidden-sm hidden-xs">
                        <h4 class="no-margin text-white">{{$profile->first_name}} {{$profile->last_name}}</h4>
                        <p class="no-margin text-white">
                            {{$profile->about}}
                        </p>
                    </div>
                    <div id="profile-dp" class="hidden-sm hidden-xs">
                        <a href="{{route("profile")}}" class="dp-edit-btn"><span class="icon icon-pencil2 text-white"></span></a>
                        @if($profile->photo()->first())
                            <img src="{{asset($profile->photo()->first()->full_path)}}" alt="Profile DP" class="img-responsive img-circle">
                        @elseif($profile->sex == "male")
                            <img src="{{asset('images/default-male.png')}}" class="img-responsive img-circle">
                        @elseif(($profile->sex == "female"))
                            <img src="{{asset('images/default-female.png')}}" class="img-responsive img-circle">
                        @endif
                    </div>
                    <div id="profile-info-right" class="profile-info hidden-sm hidden-xs">
                        <h4 class="no-margin text-white">{{$profile->vote}} picks</h4>
                        <p class="no-margin text-white">
                            <span class="icon icon-location"></span>
                            @if($profile->venue()->first())
                                <span>{{$profile->venue()->first()->name}}</span>
                                <span id='spot' class="hidden">{{$profile->venue}}</span>
                            @else
                                <span>No venue selected</span>
                            @endif
                        </p>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="hidden visible-xs visible-sm">
        <div class="container-fluid">
            <div style="height: 70px;"></div>
        </div>
    </div>
</div>
@include('utils.account')
