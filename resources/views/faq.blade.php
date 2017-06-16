@extends('layouts.app')

@section('title')
    <title>Moree.me - Connecting people: Terms & Conditions</title>
@endsection

@section('header')
    @include('include.header_public_profile')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-xs-offset-1">

                <!-- Main Title & Image  Start-->
                <h1 class="font-black">
                    FAQs <br>
                    <small class="font-red">Frequently Asked Questions</small>
                </h1>

                <!--img alt="" src="images/home1/post-image.jpg" class="img-responsive" /-->
                <!-- Main Title & Image  End-->
                <div class="section-div  sectionbg single-article">
                    <!-- Single Post  Start-->
                    <h2>How to Trend</h2>
                    <blockquote>
                        <p>The following activities will get you to trend:</p>
                        <ul>
                            <li>
                                Change Profile Picture
                            </li>
                            <li>
                                Get Picked by someone
                            </li>
                        </ul>
                    </blockquote>
                    <p>When you trend, you get to our homepage and this increases your chances of getting picked by others so start trending today...</p>
                </div>
                <br>
                <div class="section-div  sectionbg single-article">
                    <!-- Single Post  Start-->
                    <h2>What is a SPOT</h2>
                    <blockquote>
                        <p>
                            Spots are where the hangouts happen. From Cinemas to restaurants, to parties. Select your preferred spot in your profile. You can always change your choice.
                        </p>
                    </blockquote>
                    <p>The number of spots we provided for your dates will continue to increase as we thrive to bring you the best money can buy for free :)</p>
                </div>
                <br>
                <div class="section-div  sectionbg single-article">
                    <!-- Single Post  Start-->
                    <h2>How to get help</h2>
                    <blockquote>
                        <p>
                            We provide a guide to help you in case you get stuck.
                            Simply click the <span class="icon icon-question"></span> icon in the footer of your screen and we wil run you through our tour for that page if one exists.
                        </p>
                    </blockquote>
                    <p>Alternatively, you can reach out to one of our representatives by clicking the chat icon on the bottom right of your screen and ask any question you need clarification on.</p>
                </div>
                <br>
            </div>
        </div>
    </div>
@endsection