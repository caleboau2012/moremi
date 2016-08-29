@extends('layouts.master')

@section('content')
        <!--- Main Visual Div-->
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div id="owl-main">
                <div class="item">
                    <div class="svgoverlay1 bannerEffect"></div>
                    <div class="textoverlay ">
                        <h1><small class="font-white"> CHEEK OF THE WEEK</small></h1>
                        <h1>
                            {{$winner->first_name." ".$winner->last_name}}
                        </h1>
                    </div>

                    <img class="img-responsive" src="{{$winner->photo->full_path}}" width="600"   alt=" {{$winner->first_name." ".$winner->last_name}}"/>
                </div>
                <?php $i =1;?>
                @foreach($winner->photos as $p)

                    <div class="item">
                        <div class="svgoverlay1 bannerEffect"></div>
                        <div class="textoverlay">
                            <h1><small class="font-white"> CHEEK OF THE WEEK</small></h1>
                            <h1>
                                {{$winner->first_name." ".$winner->last_name}}
                            </h1>
                        </div>
                        <img class="img-responsive"  src="{{asset($p->full_path)}}" alt=" {{$winner->first_name." ".$winner->last_name}}">

                    </div>

                @endforeach
            </div>
        </div>
    </div>
</div>
<!--/ Main Visual Div End-->
<div class="container homecontainer-margin group">
    <div class="row">

        <div class="col-lg-9 col-lg-push-3 ">
            <!--Images Section Start-->
            <div class="row col-md-12">
                @foreach($topsix as $t)
                    <div class="view view-first shadow imgheight col-md-4">
                        <img class="img-responsive"  src="{{asset($t->photo->full_path)}}" width="600"  alt="{{$t->first_name." ".$t->last_name}}">

                        <div class="mask1 mask shadow thumbEffect">
                            <h3 class="font-white">{{$t->first_name." ".$t->last_name}}</h3>
                            <p>
                                I'm trendy and fashionable
                            </p>
                            <br>
                            <p class="v-count">{{$t->vote}} votes</p>
                            <label class="link-effect cl-effect-5">
                                <button type="button" class="btn btn-primary btn-block vote-c-tw" data-id="{{$t->id}}"><span class="fa fa-square-o"></span> Vote</button>
                            </label>

                        </div>
                    </div>
                @endforeach
            </div>

        </div>

    </div>
</div>
<!--Horizontal Banner Start-->
<div class="container-fluid  group ">
    <div class=" horizontal-banner row">
        <div class="container">
            <h1>
                <small>I'm hot and spicy</small>
                <br>
                <i>FEATURED CHEEK</i>
            </h1>
            <br>
            <button class="btn btn-lg btn-primary"><span class="fa fa-square-o"></span> Vote Now</button>
            {{--<input type="button" value="Get your copy now" />--}}
        </div>
    </div>
</div>
<!--/. Horizontal Banner End-->
@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/app/ProfileSidebar.js')}}"></script>
    <script src="{{asset('js/vendor/jquery.jscroll.min.js')}}"></script>

    <script type="application/javascript">
        $(document).ready( function() {
            Vote.init();
        })
        $(function() {
            $('#contestant-parent').jscroll({
                autoTrigger: true,
                nextSelector: '.pagination li.active + li a',
                contentSelector: 'div.scroll',
                loadingHtml:'<small>Loading...</small>',
                pagingSelector:'p',
                callback: function() {
                    $('ul.pagination:visible:first').hide();
                }
            });
        });
    </script>

@endsection