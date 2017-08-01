@extends('layouts.app')

@section('title')
    <title>Moree.me - Connecting people: Profile Page</title>
@endsection

@section('stylesheets')
    @parent
    {{-- Drag Drop JS --}}
    {{--<script src="{{asset("js/utils/DragDropTouch.js")}}"></script>--}}
@endsection

@section('header')
    @include('include.header_app')
@endsection

@section('content')
    <div style="height: 65px;">
        <div class="row hidden">
            <h3 class="text-center hidden"><span class="text-danger">Picks: {{$profile->vote}} <i class="icon icon-heart"></i></span> </h3>
            <hr>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 bg-white">
                <div class=" profile-court">
                    <div class="row">
                        <div class="col-md-6" data-step="4" data-intro="Select or Drag a picture from your gallery to use as your profile picture">
                            {{--<h4 class="no-margin-top">Profile Picture</h4>--}}
                            <div class="profile-pic">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <div class="image">
                                            @if(!isset($profile->photo->full_path) || is_null($profile->photo_id) || is_null($profile->photo->full_path))
                                                <div id="upload_image_placeholder">
                                                    <div id="caption"  class="image-placeholder">
                                                        <h1 class="text-center">
                                                            <span class="icon icon-upload2"></span>
                                                        </h1>
                                                        <p class="text-center text-muted">Drag best picture here</p>
                                                    </div>
                                                    <img class="hidden" src="">
                                                </div>

                                            @else
                                                <p class="text-center hidden text-info image-placeholder">Drag best picture here</p>
                                                <img class="img-responsive img-thumbnail" id="profile-active-dp" data-index="{{$profile_pic}}" src="{{asset($profile->photo->full_path)}}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row" data-step="2" data-intro="Click here to import pictures from your computer or Facebook">
                                    <br>
                                    <div class="col-xs-12 col-sm-6">
                                        <a href="#" title="Upload image" class="btn btn-primary btn-block picture-upload">
                                            Upload <strong class="icon icon-image"></strong>
                                        </a>
                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <a href="#" title="Import image from Facebook" class="btn btn-primary btn-block" id="facebook-fetch">
                                            <span class="icon icon-image"></span> from  <span class="icon icon-facebook-official"></span>
                                        </a>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6" data-step="3" data-intro="This is your Gallery. Your imported pictures end up here.">
                            <h4 class="no-margin text-primary">Gallery</h4>
                            <p class="small text-muted no-margin">Use your best picture as your profile picture</p>
                            {{--Previous DP--}}
                            <div class="row" id="pictures-panel" data-url="{{route("photo_upload")}}">
                                @if(!empty($photos))
                                    <div class="masonry_items" id="masonry_items">
                                        @foreach($photos as $i => $photo)
                                            <div class="col-xs-6 masonry_item">
                                                <div class="image-box picture-panel pointer" draggable="true">
                                                    <div class="image">
                                                        <img class="img-responsive" data-index="{{$i}}" src="{{Request::root() . "/" . $photo['full_path']}}">
                                                        {{--<span class="delete-picture icon icon-search" data-url="{{route("delete_pic", $photo['id'])}}"></span>--}}
                                                    </div>
                                                    <div class="action-button-bg text-center">
                                                        <a class="drag-pp" data-img-src="{{Request::root() . "/" . $photo['full_path']}}" data-img-index="{{$i}}" >
                                                            <span class="icon icon-left icon-check"></span>
                                                        </a>
                                                        <a class="delete-picture" data-url="{{route("delete_pic", $photo['id'])}}">
                                                            <span class="icon icon-right icon-trash"></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-center text-muted">No image yet!</p>
                                @endif
                            </div>
                        </div>
                    </div>


                    {{--profile--}}
                    <div class="profile-form">
                        <div class="row" data-step="8" data-position="top" data-intro="Share your profile on social media to get more picks.">
                            <div class="row_">
                                <div class="col-xs-12 col-sm-4">
                                    <br>
                                    <a target="_blank" class="btn btn-block bg-facebook text-white"
                                       href="https://www.facebook.com/sharer/sharer.php?u={{route("my_profile", \Illuminate\Support\Facades\Crypt::encrypt($profile->id))}}">
                                        Share on <span class="icon icon-facebook-square"></span>
                                    </a>
                                </div>

                                <div class="col-xs-12 col-sm-4">
                                    <br>
                                    <a target="_blank" class="btn btn-block bg-primary"
                                       href="https://twitter.com/home?status=Hangout%20with%20me%20for%20free%20on%20Moree.me%20{{route("my_profile", \Illuminate\Support\Facades\Crypt::encrypt($profile->id))}}%20.">
                                        Share on <span class="icon icon-twitter"></span>
                                    </a>
                                </div>

                                <div class="col-xs-12 col-sm-4">
                                    <br>
                                    <a target="_blank" class="btn btn-block btn-danger"
                                       href="https://plus.google.com/share?url={{route("my_profile", \Illuminate\Support\Facades\Crypt::encrypt($profile->id))}}">
                                        Share on <span class="icon icon-google-plus"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <input type="file" id="pic-upload" class="hidden" multiple="multiple">
                    </div>

                    <script id="picture-template" type="text/html">
                        <div class="col-xs-6">
                            <div class="image-box picture-panel pointer" draggable="true">
                                <div class="image">
                                    <img data-index="[[i]]" src="[[src]]" class="img-responsive">
                                    {{--<span class="delete-picture icon icon-search"></span>--}}
                                </div>
                                <div class="action-button-bg text-center">
                                    <a class="drag-pp" data-img-src="[[src]]" data-img-index="[[i]]">
                                        <span class="icon icon-left icon-check"></span>
                                    </a>
                                    <a class="delete-picture">
                                        <span class="icon icon-right icon-trash"></span>
                                    </a>
                                </div>
                            </div>
                            <br>
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
                                        <div id="pictures-pane" class="masonry_items">
                                        </div>
                                    </div>
                                    <script type="text/html" id="facebook-picture">
                                        <div class="col-sm-2 masonry_item">
                                            <div class="select-picture pointer image-box">
                                                <div class="image">
                                                    <img class="img-responsive" src="[[src]]">
                                                    <span class="icon icon-right icon-square-o"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </script>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                </div>

            </div>

            <div class="col-md-4">
                <div class="connections-container">
                    <div class="status-container">
                        <div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="{{route('new-status')}}" id="statusForm">
                                        <div class="form-group text-center">
                                            <div data-step="5" data-position="top" data-intro="Don't forget to change your status, this appears on your public profile.">
                                                <h4 class="text-primary">Status</h4>
                                                <textarea placeholder="What's on your mind?" class="form-control margin-top-sm" id="statusContent">{{$profile->about}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group text-center" data-step="6" data-position="top" data-intro="Select your preferred spot, this where you will hangout">
                                            <h4 class="text-primary">Preferred Spot</h4>
                                            <select name="p_spot" id="p_spot" class="form-control">
                                                <option value="0">Select your preferred meeting location</option>
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
                                            <div class="row">
                                                <a target="_blank" href="" id="venue-url" class="hidden">
                                                    <div class="col-xs-6">
                                                        <div class="well-sm">
                                                            <img src="" id="venue-image" style="width: 100%">
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <p id="venue-title"></p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="form-group text-center">
                                            <button class="btn btn-primary btn-sm" id="submitStatus" data-step="7" data-position="top" data-intro="Save when you are done">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="text-primary text-center margin-bottom-sm">Your Connections</h4>

                    <div class="row">
                        @foreach($connections as $c)
                            <div class="col-xs-3">
                                <div class="connection-item" data-id="messages-between-{{$c[\TableConstant::PROFILE_ID]}}-{{$c[\ConnectionConstant::RECIPIENT_ID]}}">
                                    @if($c[\ConnectionConstant::PHOTO])
                                        <img data-toggle="tooltip" data-placement="top" data-original-title="{{ucwords($c[\ConnectionConstant::NAME])}}"  src="{{asset($c[\ConnectionConstant::PHOTO]->thumb_path)}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-circle img-responsive">
                                    @elseif($c[ProfileConstant::SEX] == ProfileConstant::MALE)
                                        <img data-toggle="tooltip" data-placement="top" data-original-title="{{ucwords($c[\ConnectionConstant::NAME])}}" src="{{asset('images/default-male.png')}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-circle img-responsive">
                                    @elseif($c[ProfileConstant::SEX] == ProfileConstant::FEMALE)
                                        <img data-toggle="tooltip" data-placement="top" data-original-title="{{ucwords($c[\ConnectionConstant::NAME])}}" src="{{asset('images/default-female.png')}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-circle img-responsive">
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Voters --}}
                    <div class="row table-responsive">
                        <h4 class="text-primary text-center">People who picked you</h4>

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
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        @else
                            <p class="text-center">No one has picked you yet ... :(</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('bottomScripts')
    @parent
    <script src="{{asset('js/app/Account.js')}}"></script>
    <script>
        $(window).load(function(){
            $('[data-toggle="tooltip"]').tooltip();

        });
        (function($){

        })(jQuery);

        Profile.showDemo();
    </script>

@endsection