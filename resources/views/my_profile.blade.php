@extends('layouts.app')

@section('description')
    <meta name="description" content="Connect with {{$p->first_name}} {{$p->last_name}}. It's FREE. You PICK the person, you PICK the SPOT, we PAY for the HANGOUT.">
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
    <div class="clearfix"></div>

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
                        <div class="col-sm-12 about-me">
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
                                <a href="#" class="pick-btn main-btn vote-btn btn-sm btn-block" data-id="{{$p->id}}">
                                    <strong class="icon icon-heart3" aria-hidden="true">&nbsp;</strong>Pick
                                </a>
                            </p>
                        </div>
                    </div>

                    <hr class="">
                    <h4 class="text-primary text-center margin-bottom-md">Connections</h4>

                    <div class="row">
                        @if(sizeof($connects) != 0)
                            @foreach($connects as $c)
                                <div class="col-xs-3">
                                    <a href="{{route('my_profile', \Illuminate\Support\Facades\Crypt::encrypt($c[\ConnectionConstant::RECIPIENT_ID]))}}">
                                        <div class="connection-item" data-id="messages-between-{{$c[\TableConstant::PROFILE_ID]}}-{{$c[\ConnectionConstant::RECIPIENT_ID]}}">
                                            @if($c[\ConnectionConstant::PHOTO])
                                                <img data-toggle="tooltip" data-placement="top" data-original-title="{{ucwords($c[\ConnectionConstant::NAME])}}" src="{{asset($c[\ConnectionConstant::PHOTO]->thumb_path)}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-circle img-responsive">
                                            @elseif($c[ProfileConstant::SEX] == "male")
                                                <img data-toggle="tooltip" data-placement="top" data-original-title="{{ucwords($c[\ConnectionConstant::NAME])}}" src="{{asset('images/default-male.png')}}" class="img-circle img-responsive">
                                            @elseif($c[ProfileConstant::SEX] == "female")
                                                <img data-toggle="tooltip" data-placement="top" data-original-title="{{ucwords($c[\ConnectionConstant::NAME])}}" src="{{asset('images/default-female.png')}}"  class="img-circle img-responsive">
                                            @endif
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center">No connections yet... Pick to be the first!</p>
                        @endif
                    </div>

                    {{-- Voters --}}
                    <div class="row table-responsive">
                        <h4 class="text-primary text-center">Picks this Week</h4>

                        @if(sizeof($voters) != 0)
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th colspan="2">Picked by</th>
                                    <th>Picks</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--{{dd($voters)}}--}}
                                @if(isset($voters) && !is_null($voters))
                                    @foreach($voters as $v)
                                        @if(isset($v["profile"]) && !is_null($v["profile"]))
                                        <tr>
                                            <td class="text-center">
                                                <a target="_blank" href='{{route('my_profile', \Illuminate\Support\Facades\Crypt::encrypt($v['profile']->id))}}'>
                                                    @if(isset($v['profile']->photo->thumb_path))
                                                        <img width="20px" src="{{asset($v['profile']->photo->thumb_path)}}" alt="{{$v['profile']->first_name}} {{$v['profile']->last_name}}" class="img-circle img-responsive">
                                                    @elseif($v['profile']->sex == ProfileConstant::MALE)
                                                        <img width="20px" src="{{asset("images/default-male.png")}}" alt="{{$v['profile']->first_name}} {{$v['profile']->last_name}}" class="img-circle img-responsive">
                                                    @else
                                                        <img width="20px" src="{{asset("images/default-female.png")}}" alt="{{$v['profile']->first_name}} {{$v['profile']->last_name}}" class="img-circle img-responsive">
                                                    @endif
                                                </a>
                                            </td>
                                            <td>
                                                <a target="_blank" href='{{route('my_profile', \Illuminate\Support\Facades\Crypt::encrypt($v['profile']->id))}}'>
                                                    {{$v['profile']->first_name}} {{$v['profile']->last_name}}
                                                </a>
                                            </td>
                                            <td>{{$v['count']}}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        @else
                            <p class="text-center">No picks yet... Be the first?</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('utils.votePay')
    @include('utils.account')
@endsection

@section('bottomScripts')
    @parent
    <script src="{{asset('js/app/Vote.js')}}"></script>
    <script src="{{asset('js/app/Pay.js')}}"></script>
    <script src="{{asset('js/app/Account.js')}}"></script>
    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection