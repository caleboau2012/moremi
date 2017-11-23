<div class="st-navbar st-navbar-mini" style="margin-bottom: 65px;">
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
                     <li><a href="{{route('admin-hangout')}}"><span class="icon icon-play">&nbsp;</span>Hangout</a></li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div>
    </div>
</div>

@include('utils.account')
