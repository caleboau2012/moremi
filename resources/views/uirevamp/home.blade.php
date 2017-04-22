@extends('layouts.app')

@section('content')
    <div id="home_banner">
        <div class="overlay">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6" data-scrollreveal="enter left after 0.15s over 1s">
                            <h2 class="text-white">
                                It all begins with a
                                <br>
                                <span class="bg-text text-primary">DATE!</span>
                            </h2>
                        </div>

                        <div class="col-md-5 col-md-offset-1" data-scrollreveal="enter right after 0.15s over 1s">
                           <div id="login_container">
                                <h3 class="no-margin text-white">Starts Here</h3>
                               <p class="text-grey">
                                   Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci deleniti, dignissimos dolore error incidunt nam?
                               </p>
                               <div>
                                   <button class="btn btn-lg btn-brand-primary btn-primary btn-fill">Get Started</button>
                               </div>
                           </div>
                        </div><!--Col-md-6-->
                    </div><!-- Row -->
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img  class="img-responsive" src="{{asset('images/users/ghg.jpg')}}" alt="">
            </div>
            
            <div class="col-md-8">
                <h3>Lorem ipsum dolor sit amet.</h3>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Asperiores quibusdam sequi voluptate. Asperiores, laborum, sint.
                </p>
            </div>
            
        </div>

    </div>

    <div class="container-fluid bg-grey" >
        <div class="container">
            <h3 class="text-center">TRENDING</h3>
            <div class="row">
                <div class="col-sm-3">
                    <div class="trending-item">
                        <div>
                            <img class="img-responsive" src="{{asset('images/users/moses.jpg')}}" alt="Moses">
                        </div>


                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection