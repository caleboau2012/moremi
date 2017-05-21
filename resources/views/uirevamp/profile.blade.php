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
@endsection

@section('content')
    <div style="height: 50px;">

    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 bg-white">
                <div class=" profile-court">
                    <div class="row">

                        <div class="col-md-6">
                            <img id="profile-dp" src="{{asset('images/users/moses.jpg')}}" alt="" class="img-responsive img-thumbnail">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div>
                                    <textarea placeholder="My status message" class="form-control margin-top-sm" id="textArea"></textarea>
                                </div>
                            </div>
                            {{--Previous DP--}}
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-small-card">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="profile-small-card">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="profile-small-card">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="profile-small-card">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="profile-small-card">

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="profile-small-card">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    {{--profile--}}
                    <div class="profile-form">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">First Name</label>
                                    <input type="text" class="form-control" name="" id="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Last Name</label>
                                    <input type="text" class="form-control" name="" id="">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Phone Number</label>
                                    <input type="text" class="form-control" name="" id="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Email Address</label>
                                    <input type="email" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for=""></label>
                                    <select name="" class="form-control" id="">
                                        <option value="">Ozone Cinema</option>
                                        <option value="">Ozone Cinema</option>
                                        <option value="">Ozone Cinema</option>
                                        <option value="">Ozone Cinema</option>
                                        <option value="">Ozone Cinema</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">&nbsp;</label>
                                    <button class="margin-top-sm btn btn-success">Finish</button>
                                </div>
                                </div>

                        </div>
                    </div>

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

@section('bottomScripts')
    @parent
@endsection