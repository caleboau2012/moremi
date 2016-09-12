@extends('layouts.master')

@section('content')

        <!--- Main Visual Div-->
<div class="container-fluid">
    <div class="container">
        <div class="">
            <h3 class="text-center">CHEEK OF THE WEEK</h3>
            <div class="row">
                <img class="text-center img-circle center" src="{{$winner->photo->full_path}}" width="300" height="300"   alt=" {{$winner->first_name." ".$winner->last_name}}"/>
                <h3 class="text-center">{{$winner->first_name." ".$winner->last_name}}</h3>
                <div class="col-md-12">
                    <div class="clearfix" id="owl-man">
                    <?php $i =1;?>
                    @foreach($winner->photos as $p)
                        <div class="col-md-2" style="margin: 0px auto">
                            <img class="img-circle" width="150" height="150"  src="{{asset($p->full_path)}}" alt=" {{$winner->first_name." ".$winner->last_name}}">
                        </div>
                    @endforeach
                </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<br/>
<br/>

<!--/ Main Visual Div End-->
<div class="container-fluid homecontainer-margin group">
    <div class="row">
            <!--Images Section Start-->
            <div class="col-md-12">
               <!-- @foreach($topsix as $t)
                    <div class="view view-first shadow imgheight col-md-3">
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
                  -->
            </div>



    </div>
</div>
<!--Horizontal Banner Start-->
<div class="container-fluid  group ">
<!--- new profile template comes-->
    <!---An image-->
    <div id="cheeks-inf">
    @foreach($topsix as $t)
    <div class="profile_img">
        <header>
    <div class="user">
        <div class="avatar">
            <img alt="{{$t->first_name." ".$t->last_name}}" src="{{$t->photo->full_path}}">
        </div>
        <h2>{{$t->first_name." ".$t->last_name}}</h2>
        <p>{{$t->vote}} votes</p>
        <a href="#"  class="follow vote-c-tw" data-id="{{$t->id}}"><span><i class="fa fa-heart"></i> </span>Vote</a>
    </div>
            </header>
        </div>
    @endforeach
    </div>
    <div class="loading-area"></div>
    <script type="text/html" id="profile_TMP">
        <div class="profile_img">
            <header>
                <div class="user">
                    <div class="avatar">
                        <img alt="[[NAME]]" src="[[PHOTO]]">
                    </div>
                    <h2>[[NAME]]</h2>
                    <p>[[VOTE]] votes</p>
                    <a href="#"  class="follow vote-c-tw" data-id="[[ID]]"><span><i class="fa fa-heart"></i> </span>Vote</a>
                </div>
            </header>
        </div>
</script>
</div>
<!--/. Horizontal Banner End-->
@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/app/ProfileSidebar.js')}}"></script>
    <script src="{{asset('js/vendor/jquery.jscroll.min.js')}}"></script>
    <script src="{{asset('js/app/infiniteScroll.js')}}"></script>

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
            InfiniteScroll.init();
        })

    </script>

@endsection