@extends('layouts.master')

@section('topStyles')
    <link href="{{asset('libs/owl/owl.carousel.css')}}" rel="stylesheet">
    @endsection

    @section('content')

            <!--- Main Visual Div-->
    {{--{{dd($winner)}}--}}
    <div class="container-fluid">
        <div class="container">

            {{--Start of Trending Conhtainer--}}
            <div class="row">
                @if(!empty($trending))
                    <h2 class="text-center">TRENDING</h2>
                    <div class="trending-items">
                        @foreach($trending as $t)
                            <div class="trending-item">
                                <div>
                                    <div class="text-center">
                                        @if(empty($t->photo))
                                            <img alt="{{$t->first_name." ".$t->last_name}}" src="{{asset('images/default.png')}}">
                                        @else

                                            <img alt="{{$t->first_name." ".$t->last_name}}" src="{{$t->photo->full_path}}">
                                        @endif
                                    </div>
                                    <h4 class="text-center text-capitalize">{{$t->first_name." ".$t->last_name}}</h4>
                                    <p class="text-center">{{$t->vote}} votes</p>
                                    <a href="#"  class="follow vote-c-tw" data-id="{{$t->id}}"><span><i class="fa fa-heart"></i> </span>Vote</a>

                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
            {{--End of Trending Container--}}

            @if($winner)
                <div class="row">
                    <div class="">
                        <h2 class="text-center">CHEEK OF THE WEEK</h2>
                        <div class="row">
                            <div class="col-md-4 col-xs-12 col-sm-12">
                                <div class="dl-horizontal listing-info text-center">
                                    <code class="text-danger"><b>Votes:</b> {{isset($winner->vote)?$winner->vote:0}} <i class="fa fa-heart"></i></code>
                                    <br>
                                    <br>
                                    <code class="text-danger"><b>About:</b> <p class="small">{{isset($winner->about)?$winner->about:null}}</p> </code>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-12">
                                <img class="text-center img-circle center" id="winner-photo" src="{{$winner->photo?$winner->photo->full_path:asset('images/default.png')}}" width="300" height="300"   alt=" {{$winner!=null?$winner->first_name." ".$winner->last_name:'No winner yet'}}"/>
                                <h3 class="text-center">{{$winner!=null?$winner->first_name." ".$winner->last_name:'No winner yet'}}</h3>
                            </div>
                            <div class="col-md-4 col-xs-12 col-sm-12">
                                <div class="facebook-comments">
                                    <div class="fb-comments" data-href="{{url('/')}}" data-numposts="10" data-width="100%"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="clearfix" id="owl-man">
                                @if($winner!=null)
                                    <?php $i =1;?>
                                    @foreach($winner->photos->take(6) as $p)
                                        <div class="col-md-2 col-sm-3" style="margin: 0px auto">
                                            <img class="img-circle winner-photo pointer" width="150" height="150"  src="{{asset($p->full_path)}}" alt=" {{$winner->first_name." ".$winner->last_name}}">
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>


                </div>
            @endif

        </div>
    </div>
    <div class="clearfix"></div>
    <br/>
    <br/>

    <!--/ Main Visual Div End-->
    <div class="container homecontainer-margin group">
        <div class="row">
            <div class="col-sm-12">
                <div class="cheek-search">
                    <div class="inner-addon right-addon">
                        <i class="fa fa-search"></i>
                        <input id="cheek-search" data-url="{{route("cheeks", "10")}}" type="text" placeholder=" Search" class="form-control"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Horizontal Banner Start-->
    <div class="container group">
        <!--- new profile template comes-->
        <!---An image-->
        <div id="cheeks-inf">
            <div class="row">
                @if(!empty($topsix) && !is_null($topsix))
                    @foreach($topsix as $t)
                        <div class="profile_img col-md-3">
                            <header>
                                <div class="user">
                                    <div class="avatar">
                                        @if(empty($t->photo))
                                            <img alt="{{$t->first_name." ".$t->last_name}}" src="{{asset('images/default.png')}}">
                                        @else

                                            <img alt="{{$t->first_name." ".$t->last_name}}" src="{{$t->photo->full_path}}">
                                        @endif
                                    </div>
                                    <h2 class="text-capitalize">{{$t->first_name." ".$t->last_name}}</h2>
                                    <p>{{$t->vote}} votes</p>
                                    <div class="text-center">
                                        <a href="#"  class="follow vote-c-tw" data-id="{{$t->id}}"><span><i class="fa fa-heart"></i> </span>Vote</a>
                                    </div>
                                </div>
                            </header>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="loading-area"></div>
        <script type="text/html" id="profile_TMP">
            <div class="profile_img col-md-3">
                <header>
                    <div class="user">
                        <div class="avatar" data-id="[[ID]]" data-name="[[DATA-NAME]]" data-vote="[[VOTE]]" data-about="[[DATA-ABOUT]]">
                            <img alt="[[NAME]]" src="[[PHOTO]]"  class="r-modal-photo" data-img-1="[[data-img-1]]" data-img-2="[[data-img-2]]"
                                 data-img-3="[[data-img-3]]" data-img-4="[[data-img-4]]"
                                 data-img-5="[[data-img-5]]" data-img-6="[[data-img-6]]">
                        </div>
                        <h2>[[NAME]]</h2>
                        <p class="vote-count"><span>[[VOTE]]</span> votes</p>
                        <a href="#"  class="follow vote-c-tw" data-id="[[ID]]"><span><i class="fa fa-heart"></i> </span>Vote</a>
                    </div>
                </header>
            </div>
        </script>


    </div>
    <!--Profile pic modal-->
    <div class="modal fade" id="profileModal" tabindex="-1" role="dialog" aria-labelledby="profileModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <span class="fa fa-close fa-inverse"></span>
                    </span>
                    </button>
                    <h4 class="modal-title" id="profileModalLabel">[[NAME]]</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <pre class="text-center">VOTE[s] <span id="profileModalVote">[[VOTE]]</span></pre>
                        </div>
                        <div class="col-sm-12">
                            <script id="carousel-control-template" type="text/html">
                                <li data-target="#carousel-example-generic" data-slide-to="[[i]]" class="[[0]] image-[[i]]"></li>
                            </script>
                            <script id="carousel-image-template" type="text/html">
                                <div class="item image-[[i]] [[0]]">
                                    <img src="[[src]]" alt="[[about]]">
                                </div>
                            </script>
                            <script id="profile-vote-template" type="text/html">
                                <span href="#" class="vote-c-tw" data-id="[[id]]"><span><i class="fa fa-heart"></i> </span>Vote</span>
                            </script>

                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                </div>

                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <span id="profileVote" class="btn btn-danger"></span>
                    {{--<button type="button" class="btn btn-warning">Chat</button>--}}
                </div>
            </div>
        </div>
    </div>

    @include('utils.votePay');

    <!--/. Horizontal Banner End-->
@endsection

@section('past_winners')
    @if(!empty($pastwinners))
        <h4>Previous Winners</h4>
        @foreach($pastwinners as $s)
            <div class="img-div"><a href="#"><img alt="" src="{{$s->won_photo}}" class="img-responsive" /></a></div>

        @endforeach
    @endif
@endsection

@section('scripts')
    @parent
    <script src="{{asset('js/app/ProfileSidebar.js')}}"></script>
    <script src="{{asset('js/vendor/jquery.jscroll.min.js')}}"></script>
    <script src="{{asset('js/app/infiniteScroll.js')}}"></script>
    <script src="{{asset('js/app/Home.js')}}"></script>
    <script src="{{asset('js/app/VotePay.js')}}"></script>
    <script src="{{asset("libs/owl/owl.carousel.min.js")}}"></script>

    <script type="application/javascript">
        $(document).ready( function() {
            Vote.init();
        });
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

            /* Trending Block */
            $(".trending-items").owlCarousel({
                autoPlay: 3000, //Set AutoPlay to 3 seconds
                items : 5,
                itemsDesktop : [1199,4],
                itemsDesktopSmall : [979,3],
                itemsTablet	: [768,2],
                navigation : false,
                pagination : false
            });
        })

    </script>

@endsection