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
                <a class="navbar-brand" href="{{route('index')}}"><img src="{{asset('images/logo3.png')}}" alt="" class="img-responsive"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse main-nav" id="sept-main-nav">
                <ul class="nav navbar-nav navbar-right">
                    @if(!isset($profile) || is_null($profile))
                        <li><a href="#" id="app-url" data-url="{{route("login")}}" data-url-app="{{route('app')}}" class="login"><span class="icon icon-facebook-official"></span> Login/Sign Up</a></li>
                    @else
                        <li><a href="{{route('app')}}"><span class="icon icon-play">&nbsp;</span>Connect Now</a></li>
                        <li><a href="#" class="edit_profile_btn"><span class="icon icon-user">&nbsp;</span>Edit Profile</a></li>
                        <li class="active">
                            @if($profile != null)
                                <a href="{{route("profile")}}" class="profile-btn">
                                    @if($profile->photo()->first())
                                        <img src="{{asset($profile->photo()->first()->thumb_path)}}" class="profile-thumb">
                                    @elseif($profile->sex == "male")
                                        <img src="{{asset('images/default-male.png')}}" class="profile-thumb">
                                    @elseif(($profile->sex == "female"))
                                        <img src="{{asset('images/default-female.png')}}" class="profile-thumb">
                                    @else
                                        <img src="{{asset('images/default.png')}}" class="profile-thumb">
                                    @endif
                                    <span>{{$profile->first_name}} {{$profile->last_name}}</span>
                                </a>
                            @endif
                        </li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </div>
</div>

<div id="app-header" class="hidden-xs hidden-sm">
    <div class="container-fluid">
        <div style="height: 70px;"></div>
    </div>
    <div class="container">
        <div class="row">
            @if(isset($p) && !is_null($p))
                <div class="col-md-4">
                    <div class="profile_info_item_left">
                        <p class="text-right text-white no-margin">Picks this Week</p>
                        <h4 class="no-margin text-white text-right">
                            <strong class="icon icon-heart3 text-white"></strong>
                            <span class="vote-count">{{$p->vote}}</span>
                        </h4>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="profile_info_item_center" id="profile_dp_container">
                        @if($p->photo()->first())
                            <img src="{{asset($p->photo()->first()->full_path)}}" alt="Profile DP" id="profile-cover_dp">
                        @elseif($p->sex == "male")
                            <img src="{{asset('images/default-male.png')}}" id="profile-cover_dp">
                        @elseif(($p->sex == "female"))
                            <img src="{{asset('images/default-female.png')}}" id="profile-cover_dp">
                        @endif
                    </div>
                </div>
                <div class="col-md-4" style="position: relative">
                    <div class="profile_info_item_right">
                        <h4 class="text-left text-white no-margin"> {{$p->first_name}} {{$p->last_name}} </h4>
                        @if($p->about)
                            <p class="no-margin text-white"><strong>Status:</strong></p>
                            <p class="no-margin text-white">{{$p->about}}</p>
                        @else
                            <br><br>
                        @endif
                    </div>

                </div>
            @endif
        </div>
    </div>
    <div class="hidden">
        <div id="profile_cover_info_container">
            @if(isset($p) && !is_null($p))
                <div class="profile_info_item">
                    <p class="profile_info_item text-center text-white no-margin">Picks this Week</p>
                    <h4 class="no-margin text-white text-center">
                        <strong class="icon icon-heart3 text-white">&nbsp;</strong>{{$p->vote}}
                    </h4>

                </div>
                <div class="profile_info_item text-center" id="profile_dp_container">
                    @if($p->photo()->first())
                        <img id="profile-cover_dp"  src="{{asset($p->photo()->first()->full_path)}}" alt="Profile DP">
                    @elseif($p->sex == "male")
                        <img src="{{asset('images/default-male.png')}}" id="profile-cover_dp">
                    @elseif(($p->sex == "female"))
                        <img src="{{asset('images/default-female.png')}}" id="profile-cover_dp">
                    @endif
                </div>

                <div class="profile_info_item text-left">
                    <h4 class="profile_info_item text-white no-margin"> {{$p->first_name}} {{$p->last_name}} </h4>
                    @if($p->about)
                        <p class="no-margin text-white"><strong>Status:</strong></p>
                        <p class="no-margin text-white">{{$p->about}}</p>
                    @else
                        <br><br>
                    @endif
                </div>
            @endif
        </div>
    </div>
    <div class="hidden">
        <div id="profile-container hidden-xs hidden-sm">
            @if(isset($p) && !is_null($p))
                <div id="profile-info-left" class="profile-info hidden-sm hidden-xs">
                    <h4 class="no-margin text-white">{{$p->first_name}} {{$p->last_name}}</h4>
                    <p class="no-margin text-white">
                        {{$p->about}}
                    </p>
                </div>
                <div id="profile-dp" class="hidden-sm hidden-xs">
                    @if($p->photo()->first())
                        <img src="{{asset($p->photo()->first()->full_path)}}" alt="Profile DP" class="img-responsive img-circle">
                    @elseif($p->sex == "male")
                        <img src="{{asset('images/default-male.png')}}" class="img-responsive img-circle">
                    @elseif(($p->sex == "female"))
                        <img src="{{asset('images/default-female.png')}}" class="img-responsive img-circle">
                    @endif
                </div>
                <div id="profile-info-right" class="profile-info hidden-sm hidden-xs">
                    <h4 class="no-margin text-white"><span class="vote-count">{{$p->vote}}<span class="vote-count"> picks</h4>
                    <p class="no-margin text-white">
                        <span class="icon icon-location"></span>
                        @if($p->venue()->first())
                            <span>{{$p->venue()->first()->name}}</span>
                            <span id='spot' class="hidden">{{$p->venue}}</span>
                        @else
                            <span>No venue selected</span>
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>

</div>

<div class="hidden visible-xs visible-sm" id="app-header">
    <div class="container-fluid" style="height: 15px;">

    </div>
    <div class="container">
        @if(isset($p) && !is_null($p))
            <h4 class="text-center no-margin-bottom">{{$p->first_name}} {{$p->last_name}}</h4>
        @endif
    </div>
</div>

@include('utils.account')
