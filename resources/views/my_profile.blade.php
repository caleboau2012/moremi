@extends('layouts.app')

@section('description')
    <meta name="description" content="Connect with {{$p->first_name}} {{$p->last_name}}">
@endsection

@section('title')
    <title>Moree.me - Connecting people to {{$p->first_name}} {{$p->last_name}} </title>
@endsection

@section('stylesheets')
    @parent
@endsection

@section('header')
    @include('include.header_public_profile')
@endsection

@section('content')
    <div style="height: 65px;">
        <div class="row hidden">
            <p class="hidden" id="_token">{{ csrf_token() }}"</p>
            <h2 class="text-center hidden" id="user">{{$p->first_name}} {{$p->last_name}}</h2>
            <h3 class="text-center hidden"><span class="text-danger">Picks: {{$p->vote}} <i class="icon icon-heart"></i></span> </h3>
            <p class="hidden" id="id_user_from">{{$p->id}}</p>
            <p class="hidden" id="chat-url">{{route('chat-url')}}</p>
            <hr>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 bg-white">
                <div class=" profile-court">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="image text-center">
                                @if((!isset($p->photo_id)) || (!isset($p->photo->full_path)) ||
                                 is_null($p->photo_id) || is_null($p->photo->full_path))
                                    @if($p->sex == "male")
                                        <img class="img-responsive img-thumbnail" id="profile-dp" src="{{asset("images/default-male.png")}}">
                                    @else
                                        <img class="img-responsive img-thumbnail" id="profile-dp" src="{{asset("images/default-female.png")}}">
                                    @endif
                                @else
                                    <img class="img-responsive img-thumbnail" id="profile-dp" data-index="{{$p_p}}" src="{{asset($p->photo->full_path)}}">
                                @endif
                            </div>
                            <br>
                        </div>
                        <div class="col-md-12">
                            {{--Previous DP--}}
                            <div class="row" id="pictures-panel">
                                @if(!empty($photos))
                                    <div class="masonry_items" id="masonry_items">
                                    @foreach($photos as $i => $photo)
                                        <div class="col-md-4 col-sm-6 masonry_item">
                                            <div class="image-box picture-panel pointer">
                                                <div class="image">
                                                    <img data-index="{{$i}}" src="{{Request::root() . "/" . $photo['full_path']}}">
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    @endforeach
                                    </div>
                                @else
                                    <p class="text-center text-muted">No image yet!</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    

                    <script id="picture-template" type="text/html">
                        <div class="col-md-4">
                            <div class="image-box picture-panel pointer" draggable="true">
                                <div class="image">
                                    <img data-index="[[i]]" src="[[src]]">
                                    <span class="delete-picture icon icon-close"></span>
                                </div>
                            </div>
                        </div>
                    </script>
                </div>

            </div>

            <div class="col-md-4">
                <div class="connections-container">
                    <div class="row">
                        <div class="col-sm-12">
                            <br>
                            <h4 class="no-margin-top text-primary text-center">About</h4>
                            <p class="text-center">
                                @if(trim($p->about) != "")
                                    {{$p->about}}
                                @else
                                    No Info!
                                @endif
                            </p>
                            <br>
                            <h4 class="no-margin-top text-primary text-center">Preferred Spot</h4>
                            <p class="text-center">
                                <span class="icon icon-location"></span>
                                @if(isset($venue))
                                    {{$venue->name}}
                                @else
                                    Undisclosed
                                @endif
                            </p>
                            <br>
                            <p class="text-center">
                                <a href="#" class="pick-btn main-btn vote-btn btn-sm" data-id="{{$p->id}}">
                                    <strong class="icon icon-heart3" aria-hidden="true">&nbsp;</strong>Pick
                                </a>
                            </p>
                        </div>
                    </div>

                    <hr class="">
                    <h4 class="text-primary text-center margin-bottom-md">Connections</h4>

                    <div class="row">
                        @foreach($connections as $c)
                            <div class="col-xs-3">
                                <a href="{{route('my_profile', \Illuminate\Support\Facades\Crypt::encrypt($c[\ConnectionConstant::RECIPIENT_ID]))}}">
                                <div class="connection-item" data-id="messages-between-{{$c[\TableConstant::PROFILE_ID]}}-{{$c[\ConnectionConstant::RECIPIENT_ID]}}">
                                    @if($c[\ConnectionConstant::PHOTO])
                                        <img data-toggle="tooltip" data-placement="top" data-original-title="{{ucwords($c[\ConnectionConstant::NAME])}}"  src="{{asset($c[\ConnectionConstant::PHOTO]->thumb_path)}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-circle img-responsive">
                                    @else
                                        <img data-toggle="tooltip" data-placement="top" data-original-title="{{ucwords($c[\ConnectionConstant::NAME])}}" src="{{asset('images/default.png')}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-circle img-responsive">
                                    @endif
                                </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('utils.votePay')
    @include('utils.account');
@endsection

@section('bottomScripts')
    @parent
    <script src="{{asset('js/app/Vote.js')}}"></script>
    <script src="{{asset('js/app/VotePay.js')}}"></script>
    <script src="{{asset('js/app/Account.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection