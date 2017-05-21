@extends('layouts.master')

@section('content')
    {{--{{dd($venues)}}--}}
    <br>
    <div class="container">
        <div class="row">
            <p class="hidden" id="_token">{{ csrf_token() }}"</p>
            <h2 class="text-center" id="user">{{$profile->first_name}} {{$profile->last_name}}</h2>
            <h3 class="text-center"><span class="text-danger">Votes: {{$profile->vote}} <i class="fa fa-heart"></i></span> </h3>
            <p class="hidden" id="id_user_from">{{$profile->id}}</p>
            <p class="hidden" id="chat-url">{{route('chat-url')}}</p>
            <hr>
        </div>
        <div class="row profile-tab">
            <div class="col-sm-4">
                <div class="well profile-pic">
                    <div class="image">
                        @if(is_null($profile->photo_id) || is_null($profile->photo->full_path))
                            <p class="text-center text-info image-placeholder">Drag best picture here</p>
                            <img class="hidden" src="">
                        @else
                            <p class="text-center hidden text-info image-placeholder">Drag best picture here</p>
                            <img src="{{$profile->photo->full_path}}">
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <div class="col-sm-6">
                        <textarea id="status" class="form-control status-message" rows="5" placeholder="Status Message">{{$profile->about}}</textarea>
                    </div>
                    <div class="col-sm-6">
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
                </div>
                <div class="row" id="pictures-panel" data-url="{{route('my_profile')}}">
                    @if(!empty($photos))
                        @foreach($photos as $photo)
                            <div class="col-sm-2">
                                <div class="well image-box picture-panel pointer" draggable="true">
                                    <div class="image">
                                        <img src="{{Request::root() . "/" . $photo['full_path']}}">
                                        <span class="delete-picture fa fa-close" data-url="{{route("delete_pic", $photo['id'])}}"></span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-3">
                        <br>
                        <button class="btn btn-default btn-block" data-toggle="modal" data-target="#accountModal"><span class="fa fa-user"></span> Account details</button>
                        <br>
                    </div>
                    <div class="col-sm-3">
                        <br>
                        <button class="btn btn-danger btn-block picture-upload"><span class="fa fa-file-image-o"></span> Upload Pictures</button>
                        <br>
                    </div>
                    <div class="col-sm-3">
                        <br>
                        <button id="finish" data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Updating your profile" data-url="{{route("photo_upload")}}" class="btn btn-success btn-block"><span class="fa fa-upload"></span> Finish</button>
                        <br>
                    </div>
                </div>
                <input type="file" id="pic-upload" class="hidden" multiple="multiple">
            </div>
        </div>
        <script id="picture-template" type="text/html">
            <div class="col-sm-2">
                <div class="well image-box picture-panel pointer" draggable="true">
                    <div class="image">
                        <img src="[[src]]">
                        <span class="delete-picture fa fa-close"></span>
                    </div>
                </div>
                <br>
            </div>
        </script>
        <div class="row">
            <hr>
            <h2 class="text-center">Your Connections</h2>
            @foreach($connections as $c)
                <div class="col-md-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <a class="btn btn-block" role="button" data-toggle="collapse" href="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                <h3 class="panel-title">
                                    <img src="{{$c[\ConnectionConstant::PHOTO]->thumb_path}}" class="img-thumb">
                                    {{$c[\ConnectionConstant::NAME]}}
                                </h3>
                            </a>
                        </div>
                        <div class="panel-body collapse" id="collapseExample">
                            <div class="row">
                                <div class="col-xs-12" >
                                    <div id="messages-between-{{$c[\TableConstant::PROFILE_ID]}}-{{$c[\ConnectionConstant::RECIPIENT_ID]}}"
                                         class="pre-scrollable chat-messages">
                                        @foreach($c[\ConnectionConstant::MESSAGES] as $m)
                                            <div>
                                                <strong>{{$m->user}}:</strong>
                                                <p class="chat-message">{{$m->message}}</p>
                                                <small class="text-right chat-time">{{$m->time}}</small>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-xs-8" >
                                    <p class="hidden" id="id_user_to">{{$c[\ConnectionConstant::RECIPIENT_ID]}}</p>
                                    <textarea class="form-control msg"></textarea>
                                </div>
                                <div class="col-xs-4">
                                    <input type="button" value="Send" class="btn btn-block send-msg">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

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
                            <div class="select-picture image-box">
                                <div class="image">
                                    <img src="[[src]]">
                                    <span class="fa fa-square-o"></span>
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
@endsection

@section('scripts')
    @parent
    <script src="https://cdn.socket.io/socket.io-1.3.4.js"></script>
    <script src="{{asset('js/app/Chat.js')}}"></script>
@endsection