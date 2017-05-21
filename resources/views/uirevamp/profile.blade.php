<?php
/**
 * Created by PhpStorm.
 * User: moscoworld
 * Date: 5/12/17
 * Time: 10:44 PM
 */
?>
@extends('layouts.app')
@section('stylesheets')
@endsection

@section('header')
    @include('include.header_app')
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                appId      : '469144689836682',
                xfbml      : true,
                version    : 'v2.7'
            });
            FB.Event.subscribe('xfbml.render', Facebook.status);
        };

        (function(d, s, id){
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) {return;}
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
@endsection

@section('content')
    <div style="height: 50px;">
        <div class="row hidden">
            <p class="hidden" id="_token">{{ csrf_token() }}"</p>
            <h2 class="text-center hidden" id="user">{{$profile->first_name}} {{$profile->last_name}}</h2>
            <h3 class="text-center hidden"><span class="text-danger">Votes: {{$profile->vote}} <i class="fa fa-heart"></i></span> </h3>
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
                        <div class="col-md-6">
                            <div class="profile-pic">
                                <div class="image">
                                    @if(is_null($profile->photo_id) || is_null($profile->photo->full_path))
                                        <p class="text-center text-info img-placeholder">Drag best picture here</p>
                                        <img class="hidden" src="">
                                    @else
                                        <p class="text-center hidden text-info image-placeholder">Drag best picture here</p>
                                        <img class="img-responsive img-thumbnail" id="profile-dp" src="{{asset($profile->photo->full_path)}}">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <textarea placeholder="My status message" class="form-control margin-top-sm" id="status">{{$profile->about}}</textarea>
                                </div>
                            </div>
                            {{--Previous DP--}}
                            <div class="row" id="pictures-panel" data-url="{{route('my_profile')}}">
                                @if(!empty($photos))
                                    @foreach($photos as $photo)
                                        <div class="col-md-4">
                                            <div class="image-box picture-panel pointer" draggable="true">
                                                <div class="image">
                                                    <img src="{{Request::root() . "/" . $photo['full_path']}}">
                                                    <span class="delete-picture icon icon-close" data-url="{{route("delete_pic", $photo['id'])}}"></span>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>


                    {{--profile--}}
                    <div class="profile-form">
                        {{--<div class="row">--}}
                        {{--<div class="col-md-6">--}}
                        {{--<div class="form-group">--}}
                        {{--<label for="">First Name</label>--}}
                        {{--<input type="text" class="form-control" name="" id="">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6">--}}
                        {{--<div class="form-group">--}}
                        {{--<label for="">Last Name</label>--}}
                        {{--<input type="text" class="form-control" name="" id="">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="row">--}}
                        {{--<div class="col-md-6">--}}
                        {{--<div class="form-group">--}}
                        {{--<label for="">Phone Number</label>--}}
                        {{--<input type="text" class="form-control" name="" id="">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-md-6">--}}
                        {{--<div class="form-group">--}}
                        {{--<label for="">Email Address</label>--}}
                        {{--<input type="email" class="form-control">--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        {{--</div>--}}

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="venue"></label>
                                    <select name="venue" id="venue" class="form-control">
                                        <option value="0">Select your preferred date location</option>
                                        @foreach($venues as $venue)
                                            @if($venue->id == $profile->venue)
                                                <option selected value="{{$venue->id}}" data-url="{{$venue->url}}"
                                                        data-title="{{$venue->title}}" data-image="{{$venue->thumb}}">{{$venue->name}}</option>
                                            @else
                                                <option value="{{$venue->id}}" data-url="{{$venue->url}}"
                                                        data-title="{{$venue->title}}" data-image="{{$venue->thumb}}">{{$venue->name}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for=""></label>
                                    <button class="btn btn-default btn-block" data-toggle="modal" data-target="#accountModal">
                                        <span class="fa fa-user"></span> Update Account Details
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <br>
                                <button class="btn bg-primary btn-block" id="facebook-fetch">
                                    Import <span class="icon icon-file-image-o"></span> From <span class="icon icon-facebook-official"></span>
                                </button>
                                <br>
                            </div>
                            <div class="col-sm-6">
                                <br>
                                <button class="btn btn-danger btn-block picture-upload">
                                    Upload <span class="icon icon-file-image-o"></span>
                                </button>
                                <br>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <br>
                                <button id="finish" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Updating your profile" data-url="{{route("photo_upload")}}" class="btn btn-success btn-block"><span class="fa fa-upload"></span> Finish</button>
                                <br>
                            </div>
                        </div>
                        <input type="file" id="pic-upload" class="hidden" multiple="multiple">
                    </div>

                    <script id="picture-template" type="text/html">
                        <div class="col-md-4">
                            <div class="image-box picture-panel pointer" draggable="true">
                                <div class="image">
                                    <img src="[[src]]">
                                    <span class="delete-picture icon icon-close"></span>
                                </div>
                            </div>
                        </div>
                    </script>

                    <div id="picturesModal" class="modal fade" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Select Pictures to import <small>Tap to select</small></h4>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div id="pictures-pane">
                                        </div>
                                    </div>
                                    <script type="text/html" id="facebook-picture">
                                        <div class="col-sm-2">
                                            <div class="select-picture pointer image-box">
                                                <div class="image">
                                                    <img src="[[src]]">
                                                    <span class="icon icon-square-o"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </script>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                </div>
            </div>

            <div class="col-md-4">
                <div class="connections-container">
                    <h4 class="text-primary margin-bottom-md">Your Connections</h4>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="connection-item">
                                <img src="{{asset('images/users/moses.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="connection-item">
                                <img src="{{asset('images/users/moses.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="connection-item">
                                <img src="{{asset('images/users/moses.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="connection-item">
                                <img src="{{asset('images/users/moses.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="connection-item">
                                <img src="{{asset('images/users/moses.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="connection-item">
                                <img src="{{asset('images/users/moses.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="connection-item">
                                <img src="{{asset('images/users/moses.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="connection-item">
                                <img src="{{asset('images/users/moses.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="connection-item">
                                <img src="{{asset('images/users/moses.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="connection-item">
                                <img src="{{asset('images/users/moses.jpg')}}" alt="" class="img-circle img-responsive">
                            </div>
                        </div>
                    </div>

                    {{--CHAT BOX--}}
                    <div id="chat-container">
                        <div id="chat-container-header" class="text-center">
                            <h5 class="no-margin text-white">
                                <span class="icon icon-lightning"></span>Chat Box
                            </h5>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
@endsection

@include('utils.votePay');
@include('utils.account');

@section('bottomScripts')
    @parent
    <script src="{{asset('js/app/Account.js')}}"></script>
@endsection