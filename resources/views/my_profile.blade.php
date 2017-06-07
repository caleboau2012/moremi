@extends('layouts.app')

@section('title')
    <title>Moree.me - Connecting people: {{$profile->first_name}} {{$profile->last_name}} </title>
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
            <h2 class="text-center hidden" id="user">{{$profile->first_name}} {{$profile->last_name}}</h2>
            <h3 class="text-center hidden"><span class="text-danger">Picks: {{$profile->vote}} <i class="icon icon-heart"></i></span> </h3>
            <p class="hidden" id="id_user_from">{{$profile->id}}</p>
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
                                @if((!isset($profile->photo_id)) || (!isset($profile->photo->full_path)) ||
                                 is_null($profile->photo_id) || is_null($profile->photo->full_path))
                                    @if($profile->sex == "male")
                                        <img class="img-responsive img-thumbnail" id="profile-dp" src="{{asset("images/default-male.png")}}">
                                    @else
                                        <img class="img-responsive img-thumbnail" id="profile-dp" src="{{asset("images/default-female.png")}}">
                                    @endif
                                @else
                                    <img class="img-responsive img-thumbnail" id="profile-dp" data-index="{{$profile_pic}}" src="{{asset($profile->photo->full_path)}}">
                                @endif
                            </div>
                            <br>
                        </div>
                        <div class="col-md-12">
                            {{--Previous DP--}}
                            <div class="row" id="pictures-panel">
                                @if(!empty($photos))
                                    @foreach($photos as $i => $photo)
                                        <div class="col-md-4">
                                            <div class="image-box picture-panel pointer">
                                                <div class="image">
                                                    <img data-index="{{$i}}" src="{{Request::root() . "/" . $photo['full_path']}}">
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-center text-muted">No image yet!</p>
                                @endif
                            </div>
                        </div>
                    </div>


                    {{--profile--}}
                    <div class="profile-form">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div>
                                        <label for="status" class="control-label"><strong>Status</strong></label>
                                        <textarea placeholder="My status message" readonly class="form-control margin-top-sm" id="status">{{$profile->about}}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="venue"><strong>Preferred Spot</strong></label>
                                    @if(isset($venue))
                                        <p>{{$venue->name}}</p>
                                    @else
                                        <p>No Spot Chosen</p>
                                    @endif
                                </div>
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
                            <p class="text-center">
                                <a href="#" class="pick-btn main-btn vote-btn btn-sm" data-id="{{$profile->id}}">
                                    <strong class="icon icon-heart3" aria-hidden="true">&nbsp;</strong>Pick
                                </a>
                            </p>
                        </div>
                    </div>

                    <h4 class="text-primary text-center margin-bottom-md">Connections</h4>

                    <div class="row">
                        @foreach($connections as $c)
                            <div class="col-xs-3">
                                <div class="connection-item" data-id="messages-between-{{$c[\TableConstant::PROFILE_ID]}}-{{$c[\ConnectionConstant::RECIPIENT_ID]}}">
                                    @if($c[\ConnectionConstant::PHOTO])
                                        <img data-toggle="tooltip" data-placement="top" data-original-title="{{ucwords($c[\ConnectionConstant::NAME])}}"  src="{{asset($c[\ConnectionConstant::PHOTO]->thumb_path)}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-circle img-responsive">
                                    @else
                                        <img data-toggle="tooltip" data-placement="top" data-original-title="{{ucwords($c[\ConnectionConstant::NAME])}}" src="{{asset('images/default.png')}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-circle img-responsive">
                                    @endif
                                </div>
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
@endsection