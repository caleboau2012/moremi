@extends('layouts.master')

@section('content')
    {{--    {{dd($profile_pic, $photos, $status, $profile)}}--}}
    <br>
    <div class="container">
        <div class="row">
            <h2 class="text-center">{{$profile->first_name}} {{$profile->last_name}}</h2>
            <h3 class="text-center"><span class="text-danger">Votes: {{$profile->vote}} <i class="fa fa-heart"></i></span> </h3>
            <hr>
        </div>
        <div class="row profile-tab">
            <div class="col-sm-4">
                <div class="well profile-pic">
                    <div class="image">
                        @if(is_null($profile->photo->full_path))
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
                    <textarea name="{{$profile->about}}" id="status" class="form-control status-message" rows="5" placeholder="Status Message"></textarea>
                </div>
                <div class="row" id="pictures-panel" data-url="{{route('my_profile')}}">
                    @if(!is_null($photos))
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
                    <div class="col-sm-3 col-sm-offset-6">
                        <button class="btn btn-danger btn-block picture-upload"><span class="fa fa-file-image-o"></span> Upload Pictures</button>
                    </div>
                    <div class="col-sm-3">
                        <button id="finish" data-url="{{route("photo_upload")}}" class="btn btn-success btn-block"><span class="fa fa-upload"></span> Finish</button>
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
            </div>
        </script>
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