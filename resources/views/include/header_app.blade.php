<div id="app-header" class="hidden-xs hidden-sm">
 <div class="container-fluid">
   <img id="logo" src="{{asset('images/logo.png')}}" alt="">
 </div>
  <div><a href="{{route("profile")}}">
    <div id="profile-container hidden-xs hidden-sm">
      <div id="profile-info-left" class="profile-info hidden-sm hidden-xs">
        <h4 class="no-margin text-white">{{$profile->first_name}} {{$profile->last_name}}</h4>
        <p class="no-margin text-white">
          {{$profile->about}}
        </p>
      </div>
      <div id="profile-dp" class="hidden-sm hidden-xs">
        <a href="#" class="dp-edit-btn"><span class="icon icon-pencil2 text-white"></span></a>
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
            <span>No venue</span>
            @endif
        </p>
      </div>
    </div>
  </a></div>
</div>

<div class="visible-xs visible-sm" id="app-header">
  <div class="container-fluid">
    <img id="logo" src="{{asset('images/logo.png')}}" alt="">
  </div>
  <div class="container">
    <div class="text-center">
      <div id="profile-dp-xs" class="center-block">
        @if($profile->photo()->first())
          <img src="{{asset($profile->photo()->first()->full_path)}}" alt="Profile DP" class="img-responsive img-circle">
        @else
          <img src="{{asset('images/apple-icon.png')}}" class="profile-thumb">
        @endif
      </div>
    </div>
    <h4 class="text-center no-margin-bottom">{{$profile->first_name}} {{$profile->last_name}}</h4>
    <p class="no-margin">
      <strong>Status: </strong> {{$profile->about}}
    </p>
    <div class="text-center">
      <a href=""><span class="icon icon-pencil2">&nbsp;</span>Edit Profile</a>
    </div>
  </div>
</div>