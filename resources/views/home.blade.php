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
                            <div class="col-md-2 col-sm-3" style="margin: 0px auto">
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
<div class="container homecontainer-margin group">
    <div class="row">
        <div class="col-sm-12">
            <div class="cheek-search">
                <div class="inner-addon right-addon">
                    <i class="fa fa-search"></i>
                    <input id="cheek-search" type="text" placeholder="Search" class="form-control"/>
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
            @foreach($topsix as $t)
                <div class="profile_img col-md-3">
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
    </div>
    <div class="loading-area"></div>
    <script type="text/html" id="profile_TMP">
        <div class="profile_img col-md-3">
            <header>
                <div class="user">
                    <div class="avatar">
                        <img alt="[[NAME]]" src="[[PHOTO]]"  class="r-modal-photo" >
                    </div>
                    <h2>[[NAME]]</h2>
                    <p>[[VOTE]] votes</p>
                    <a href="#"  class="follow vote-c-tw" data-id="[[ID]]"><span><i class="fa fa-heart"></i> </span>Vote</a>
                </div>
            </header>
        </div>
    </script>


</div>
<!--Profile pic modal-->
<div id="r-modal-photo" class="modal hide fade" tabindex="-1" data-replace="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">�</button>
        <h3 class="title">Title</h3>
    </div>
    <div class="modal-body">
    </div>
    <div class="modal-footer">
        <button type="button" data-dismiss="modal" class="btn">Close</button>
    </div>
</div>
<!------>
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