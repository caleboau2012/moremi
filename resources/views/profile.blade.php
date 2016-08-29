@extends('layouts.master')

@section('content')
    <br>
    <div class="container">
        <div class="row profile-tab">
            <div class="col-sm-4">
                <div class="well profile-pic">
                    <div class="image">
                        <p class="text-center text-info image-placeholder">Drag best picture here</p>
                        <img class="hidden" src="">
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="row">
                    <textarea name="" id="" class="form-control status-message" rows="5" placeholder="Status Message"></textarea>
                </div>
                <div class="row" id="pictures-panel">

                </div>
                <div class="row">
                    <div class="col-sm-3 col-sm-offset-6">
                        <button class="btn btn-danger btn-block picture-upload"><span class="fa fa-file-image-o"></span> Upload Pictures</button>
                    </div>
                    <div class="col-sm-3">
                        <button class="btn btn-success btn-block"><span class="fa fa-upload"></span> Finish</button>
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
                        <span class="fa fa-close"></span>
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
                    <div id="pictures-pane">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Done</button>
                    {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endsection