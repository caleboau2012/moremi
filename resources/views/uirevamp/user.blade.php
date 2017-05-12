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
    <link href="{{asset('libs/owl/owl.carousel.css')}}" rel="stylesheet">
@endsection

@section('content')
    {{--trending--}}
    <div class="hidden container-fluid bg-grey" id="trending_container" >
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="btn-group btn-group-justified">
                        <a href="#" class="btn active  trending_menu">Trending</a>
                        {{--<a href="#" class="btn  trending_menu">Trending</a>--}}
                    </div>
                </div>
            </div>
            <div class="row trending-items">
                <div class="trending-item">
                    <div class="profile-card">
                        <div class="profile-card-heading">
                            <img class="img-responsive img-circle" src="{{asset('images/cheeks/0.jpg')}}" alt="Moses">
                        </div>
                        <div class="profile-card-content">
                            <div class="profile-card-name">
                                <h4 class="text-center">Adebayo Sannnimulwirrr</h4>
                                <span class="content-end"></span>
                            </div>
                            <p class="text-center">
                                <span class="icon icon-location">&nbsp;</span>Lagos, Nigeria
                            </p>
                            <p class="text-center">
                                <span class="icon icon-heart3">&nbsp;</span>5,000
                            </p>
                            <div class="text-center">
                                <button class="btn get_started btn-sm vote-btn btn-fill">Vote</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="trending-item">
                    <div class="profile-card">
                        <div class="profile-card-heading">
                            <img class="img-responsive img-circle" src="{{asset('images/cheeks/1.jpg')}}" alt="Moses">
                        </div>
                        <div class="profile-card-content">
                            <div class="profile-card-name">
                                <h4 class="text-center">Adebayo Moses</h4>
                                <span class="content-end"></span>
                            </div>

                            <p class="text-center">
                                <span class="icon icon-location">&nbsp;</span>Lagos, Nigeria
                            </p>
                            <p class="text-center">
                                <span class="icon icon-heart3">&nbsp;</span>1,000
                            </p>
                            <div class="text-center">
                                <button class="btn get_started btn-sm vote-btn btn-fill">Vote</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="trending-item">
                    <div class="profile-card">
                        <div class="profile-card-heading">
                            <img class="img-responsive img-circle" src="{{asset('images/cheeks/5.jpg')}}" alt="Moses">
                        </div>
                        <div class="profile-card-content">
                            <div class="profile-card-name">
                                <h4 class="text-center">Mbakwe Chukwulegezookwe</h4>
                                <span class="content-end"></span>
                            </div>
                            <p class="text-center">
                                <span class="icon icon-location">&nbsp;</span>Lagos, Nigeria
                            </p>
                            <p class="text-center">
                                <span class="icon icon-heart3">&nbsp;</span>80
                            </p>
                            <div class="text-center">
                                <button class="btn get_started btn-sm vote-btn btn-fill">Vote</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="trending-item">
                    <div class="profile-card">
                        <div class="profile-card-heading">
                            <img class="img-responsive img-circle" src="{{asset('images/users/moses.jpg')}}" alt="Moses">
                        </div>
                        <div class="profile-card-content">
                            <div class="profile-card-name">
                                <h4 class="text-center">Adebayo Sannnimulwirrr</h4>
                                <span class="content-end"></span>
                            </div>

                            <p class="text-center">
                                <span class="icon icon-location">&nbsp;</span>Lagos, Nigeria
                            </p>
                            <p class="text-center">
                                <span class="icon icon-heart3">&nbsp;</span>300
                            </p>
                            <div class="text-center">
                                <button class="btn get_started btn-sm vote-btn btn-fill">Vote</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="trending-item">
                    <div class="profile-card">
                        <div class="profile-card-heading">
                            <img class="img-responsive img-circle" src="{{asset('images/cheeks/6.jpg')}}" alt="Moses">
                        </div>
                        <div class="profile-card-content">
                            <div class="profile-card-name">
                                <h4 class="text-center">Mbakwe Chukwulegezookwe</h4>
                                <span class="content-end"></span>
                            </div>

                            <p class="text-center">
                                <span class="icon icon-location">&nbsp;</span>Lagos, Nigeria
                            </p>
                            <p class="text-center">
                                <span class="icon icon-heart3">&nbsp;</span>1,000
                            </p>
                            <div class="text-center">
                                <button class="btn get_started btn-sm vote-btn btn-fill">Vote</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="trending-item">
                    <div class="profile-card">
                        <div class="profile-card-heading">
                            <img class="img-responsive img-circle" src="{{asset('images/cheeks/7.jpg')}}" alt="Moses">
                        </div>
                        <div class="profile-card-content">
                            <div class="profile-card-name">
                                <h4 class="text-center">Adebayo Caleb</h4>
                                <span class="content-end"></span>
                            </div>

                            <p class="text-center">
                                <span class="icon icon-location">&nbsp;</span>Lagos, Nigeria
                            </p>
                            <p class="text-center">
                                <span class="icon icon-heart3">&nbsp;</span>48,000
                            </p>
                            <div class="text-center">
                                <button class="btn get_started btn-sm vote-btn btn-fill">Vote</button>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="trending-item">
                    <div class="profile-card">
                        <div class="profile-card-heading">
                            <img class="img-responsive img-circle" src="{{asset('images/cheeks/0.jpg')}}" alt="Moses">
                        </div>
                        <div class="profile-card-content">
                            <div class="profile-card-name">
                                <h4 class="text-center">Adebayo Caleb</h4>
                                <span class="content-end"></span>
                            </div>

                            <p class="text-center">
                                <span class="icon icon-location">&nbsp;</span>Lagos, Nigeria
                            </p>
                            <p class="text-center">
                                <span class="icon icon-heart3">&nbsp;</span>39,010
                            </p>
                            <div class="text-center">
                                <button class="btn get_started btn-sm vote-btn btn-fill">Vote</button>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    {{--PICK SECTION--}}
    <div class="container-fluid bg-grey">
        <h3 class="text-center text-primary">PICK</h3>

        {{--Filter Panel--}}
        <div class="container">
            <button class="btn btn-default">Females</button>
            <button class="btn btn-default">Males</button>
            <button class="btn btn-default">Spot</button>
        </div>

    </div>


@endsection

@section('bottomScripts')
    @parent
    <script src="{{asset("libs/owl/owl.carousel.min.js")}}"></script>
    <script>
        $(function() {

            /* Trending Block */
            $(".trending-items").owlCarousel({
                autoPlay: 3000, //Set AutoPlay to 3 seconds
                items : 4,
                itemsDesktop : [1199,4],
                itemsDesktopSmall : [979,3],
                itemsTablet	: [768,2],
                navigation : false,
                pagination : false
            });
        })

    </script>
@endsection