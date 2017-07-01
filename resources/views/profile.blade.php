@extends('layouts.app')

@section('title')
    <title>Moree.me - Connecting people: Profile Page</title>
@endsection

@section('stylesheets')
    @parent
    {{-- Drag Drop JS --}}
    <link href="{{asset('css/chat.css')}}" rel="stylesheet">
    <script src="{{asset("js/utils/DragDropTouch.js")}}"></script>
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
                    <div class="row" data-step="2" data-intro="These are your pictures">
                        <div class="col-md-6" data-step="5" data-intro="Drag a picture here to use as your profile picture">
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
                                                <img class="img-responsive img-thumbnail" id="profile-dp" data-index="{{$profile_pic}}" src="{{asset($profile->photo->full_path)}}">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row" data-step="3" data-intro="Click here to import pictures from your computer or Facebook">
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
                        <div class="col-md-6">
                            {{--Previous DP--}}
                            <div class="row" id="pictures-panel">
                                @if(!empty($photos))
                                    <div class="masonry_items" id="masonry_items" data-step="4" data-intro="Your pictures show here">
                                    @foreach($photos as $i => $photo)
                                        <div class="col-md-4 col-sm-6 masonry_item">
                                            <div class="image-box picture-panel pointer" draggable="true">
                                                <div class="image">
                                                    <img class="img-responsive" data-index="{{$i}}" src="{{Request::root() . "/" . $photo['full_path']}}">
                                                    <span class="delete-picture icon icon-close" data-url="{{route("delete_pic", $photo['id'])}}"></span>
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
                        <div data-step="6" data-position="top" data-intro="Don't forget to change your status and select your Spot">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div>
                                            <label for="status" class="control-label"><strong>Status</strong></label>
                                            <textarea placeholder="My status message" class="form-control margin-top-sm" id="status">{{$profile->about}}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="venue"><strong>Preferred Spot</strong></label>
                                        <select name="venue" id="venue" class="form-control">
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
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <br>
                                    <button data-step="7" data-intro="Click finish to save all you've done and become trending..." id="finish" data-loading-text="<i class='icon icon-circle-o-notch icon-spin'></i> Updating your profile" data-url="{{route("photo_upload")}}" class="btn btn-success btn-block"><span class="icon icon-upload"></span> Save Changes</button>
                                    <br>
                                </div>
                            </div>
                        </div>

                        <div class="row">
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
                        <div class="col-md-4 col-xs-6">
                            <div class="image-box picture-panel pointer" draggable="true">
                                <div class="image">
                                    <img data-index="[[i]]" src="[[src]]">
                                    <span class="delete-picture icon icon-close"></span>
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
                                                    <span class="icon icon-square-o"></span>
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
                    <h4 class="text-primary text-center margin-bottom-md">Your Connections</h4>

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

                    {{-- Voters --}}
                    <div class="row table-responsive">
                        <h4 class="text-primary text-center">People who picked you</h4>

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
                                                <img width="20px" src="{{asset($v['profile']->photo->thumb_path)}}" alt="{{$v['profile']->first_name}} {{$v['profile']->last_name}}" class="img-circle img-responsive">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--@include('utils.votePay')--}}
    @include('utils.chat')
@endsection

@section('bottomScripts')
    @parent
    <script src="{{asset('js/app/Account.js')}}"></script>
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
    <script src="{{asset('js/app/Chat.js')}}"></script>
    <script>
        $(window).load(function(){
            $('[data-toggle="tooltip"]').tooltip();

        });
        (function($){

        })(jQuery);

        Profile.showDemo();
    </script>

@endsection