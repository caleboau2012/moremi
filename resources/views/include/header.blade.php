<div class="st-navbar">
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
                <a class="navbar-brand" href="#home"><img src="{{asset('images/logo3.png')}}" alt="" class="img-responsive"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse main-nav" id="sept-main-nav">
                <ul class="nav navbar-nav navbar-right">
                    {{--<li class="active"><a href="#home">Home</a></li>--}}
                    <li><a href="#about">About</a></li>
                    <li><a href="#pick-of-the-week">Pick of the Week</a></li>
                    <li><a href="#trending">Trending</a></li>
                    @if(!$loggedIn)
                        <li><a href="#" id="app-url" data-url="{{route("login")}}" data-url-app="{{route('profile')}}" class="login"><span class="icon icon-facebook-official"></span> Login/Sign Up</a></li>
                    @else
                        <li><a href="{{route("app")}}"><span class="icon icon-play"></span> Connect Now</a></li>
                        <li>
                            <a href="{{route("profile")}}" class="profile-btn">
                                @if($profile != null)
                                    @if($profile->photo()->first())
                                        <img src="{{asset($profile->photo()->first()->thumb_path)}}" class="profile-thumb">
                                    @elseif($profile->sex == "male")
                                        <img src="{{asset('images/default-male.png')}}" class="profile-thumb">
                                    @elseif(($profile->sex == "female"))
                                        <img src="{{asset('images/default-female.png')}}" class="profile-thumb">
                                    @endif
                                    <span>{{$profile->first_name}} {{$profile->last_name}}</span>
                                @else
                                    <img src="{{asset('images/default.png')}}" class="profile-thumb">
                                @endif
                            </a>
                        </li>
                    @endif

                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </div>
</div>
