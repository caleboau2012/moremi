@extends('layouts.admin')

@section('title')
    <title>Moree.me - Connecting people: The Game Page</title>
@endsection

@section('stylesheets')
    {{--<link href="{{asset('libs/bootstrap-slider/bslider.css')}}" rel="stylesheet">--}}
@endsection

@section('header')
    @include('include.header_admin')
@endsection

@section('content')
    <div class="clearfix"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {{--PICK SECTION--}}
                <div class="bg-grey padding-sm">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <div class="btn-group btn-group-justified hidden-xs hidden-sm" id="game">
                                <p class="subtitle fancy fancy-long"><span>Hangouts </span></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h3 class="no-margin pull-left text-primary">
                                {{sizeof($hangouts)}} hangouts
                            </h3>
                            <div class="pull-right">
                                <button class="btn btn-block btn-primary btn-sm" data-target="#hangoutModal" data-toggle="modal">Create</button>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>

                    {{--Hangouts AREA--}}
                    <table class="table table-responsive table-hover table-stripped">
                        <thead>
                        <tr>
                             <th>Ref</th>
                            <th>Spot</th>
                            <th>Capacity</th>
                            <th>Fee</th>
                             <th>Creator</th>
                            <th>Created On</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($hangouts as $hangout)
                            <tr>
                                 <td>{{$hangout->reference}}</td>
                                <td>{{$hangout->venue->name}}</td>
                                <td>{{sizeof($hangout->beneficiaries)}}</td>
                                <td>
                                    @if($hangout->fee)
                                        <label class="label label-success">{{$hangout->fee}}</label>
                                    @else
                                        <label class="label label-danger">Sponsored</label>
                                    @endif
                                </td>
                                <td class="text-capitalize">{{$hangout->creator->first_name .' '. $hangout->creator->last_name}}</td>
                                 <td>{{$hangout->created_at }}</td>
                                <td>
                                    <a href="">View</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="hangoutModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Select people to hangout with </h4>
                </div>
                <div class="modal-body">
                    <form data-url="{{route("admin-set-hangout")}}" id="hangoutForm" name="hangoutForm" accept-charset="UTF-8" class="form-horizontal_" role="form">
                        <p class="text-center text-danger" id="form_error"></p>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Spot</label>
                                    <select class="form-control" name="spot" id="spot_sel">
                                        @foreach($spots as $spot)
                                            <option class="text-capitalize" value="{{$spot->id}}" >{{$spot->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="users_select">Beneficiaries</label>
                                    <select name="users[]" id="users_select" class="form-control" multiple="multiple">
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}">{{ ucwords($user->first_name .' '. $user->last_name) }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" id="hangoutBtn">Submit</button>

                            </div>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

@endsection

@section('bottomScripts')
    @parent
    <script src="{{asset('js/app/Hangout.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#users_select').select2(
                {
                    width: 'resolve'
                 }
            );
        });
    </script>
@endsection