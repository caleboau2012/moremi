<div class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle pull-right" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="index.html" class="navbar-brand"><strong class="text-white">Moree.me</strong></a>
    </div>

    <div class="collapse navbar-collapse navbar-ex1-collapse" role="navigation">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about_content"><span class="text-white">About</span></a></li>
        <li><a href="#moment_pick_container"><span class="text-white">Pick of the Week</span></a></li>
        <li><a href="#trending_container"><span class="text-white">Trending</span></a></li>
        @if(!$loggedIn)
          <li><a href="#" id="app-url" data-url="{{route("login")}}" data-url-app="{{route('app')}}" class="login"><span class="text-white">Join</span></a></li>
        @else
          <li><a href="#" class="profile-btn">
              @if($profile != null)
                <img src="{{asset($profile->photo()->first()->thumb_path)}}" class="profile-thumb">
                <span class="text-white">{{$profile->first_name}} {{$profile->last_name}}</span></a></li>
              @endif
        @endif
      </ul>
    </div>
  </div>
</div>