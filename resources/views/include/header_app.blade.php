<div id="app-header" class="hidden-xs hidden-sm">
    <div class="container-fluid">
        <a href="{{route('index')}}">
            <img id="logo" src="{{asset('images/logo.png')}}" alt="">
        </a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="profile_info_item_left">
                    <p class="text-right text-white no-margin">Pick of the Week</p>
                    <h4 class="no-margin text-white text-right">
                        <strong class="icon icon-heart3 text-white"></strong> {{$profile->vote}}
                    </h4>
                </div>

            </div>
            <div class="col-md-4">
                <div class="profile_info_item_center" id="profile_dp_container">
                    <a href="{{route("profile")}}">
                        <btn class="dp-edit-btn edit_profile_btn">
                            <span class="icon icon-pencil2 text-white"></span>
                        </btn>
                        @if($profile->photo()->first())
                            <img src="{{asset($profile->photo()->first()->full_path)}}" alt="Profile DP" id="profile-cover_dp">
                        @else
                            <img src="{{asset('images/apple-icon.png')}}" id="profile-cover_dp">
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-md-4" style="position: relative">
                <div class="profile_info_item_right">
                    <h4 class="text-left text-white no-margin"> {{$profile->first_name}} {{$profile->last_name}} </h4>
                    @if($profile->about)
                        <p class="no-margin text-white"><strong>Status:</strong></p>
                        <p class="no-margin text-white">{{$profile->about}}</p>
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
                <p class="profile_info_item text-center text-white no-margin">Pick of the Week</p>
                <h4 class="no-margin text-white text-center">
                    <strong class="icon icon-heart3 text-white">&nbsp;</strong>20
                </h4>

            </div>
            <div class="profile_info_item text-center" id="profile_dp_container">
                @if($profile->photo()->first())
                    <img id="profile-cover_dp"  src="{{asset($profile->photo()->first()->full_path)}}" alt="Profile DP">
                @else
                    <img src="{{asset('images/apple-icon.png')}}" id="profile-cover_dp">
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
                    @else
                        <img src="{{asset('images/apple-icon.png')}}" class="img-circle img-responsive">
                    @endif
                </div>
                <div id="profile-info-right" class="profile-info hidden-sm hidden-xs">
                    <h4 class="no-margin text-white">{{$profile->vote}} picks</h4>
                    <p class="no-margin text-white">
                        <span class="icon icon-earth"></span>
                        @if($profile->venue()->first())
                            <span>{{$profile->venue()->first()->name}}</span>
                            <span id='spot' class="hidden">{{$profile->venue}}</span>
                        @else
                            <span>No venue selected</span>
                        @endif
                    </p>
                </div>
            </div>
        </a></div>
</div>

<div class="hidden visible-xs visible-sm" id="app-header">
    <div class="container-fluid">
        <img id="logo" src="{{asset('images/logo.png')}}" alt="">
    </div>
    <div class="container">
        <div class="text-center">
            <div id="profile-dp-xs" class="center-block">
                @if($profile->photo()->first())
                    <img src="{{asset($profile->photo()->first()->full_path)}}" alt="Profile DP" class="img-responsive img-circle" style="width: 100px; margin: 0 auto; height: 100px; border-radius: 50%;">
                @else
                    <img class="profile_info_item" src="{{asset('images/apple-icon.png')}}" alt="" style="width: 100px; height: 100px; border-radius: 50%;">
                @endif
            </div>
        </div>
        <h4 class="text-center no-margin-bottom">{{$profile->first_name}} {{$profile->last_name}}</h4>
        <p class="no-margin text-center hidden">
            <strong>Status: </strong> {{$profile->about}}
        </p>
        <div class="text-center">
            <a href=""><span class="icon icon-pencil2">&nbsp;</span>Edit Profile</a>
        </div>
    </div>
</div>

@include('utils.account')
