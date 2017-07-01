<div class="container-fluid" id="footer">
    <div class="row">
        <div class=" col-md-12 foot-top"></div>
    </div>
    <!--Main Footer Section-->
    {{--<div class="container-fluid row">--}}
    <div class="container">
        <div class="row">
            <br>
            <!--About Section-->
            <section class="col-xs-12 col-sm-5 footerbg1 text-muted footer-about">
                <h4>About Moree.me</h4>
                <div class="row">
                    <div class="col-md-5">
                        <p>
                            <img src="{{asset('images/logo.png')}}" id="">

                        </p>
                    </div>
                    <div class="col-md-7">
                        <p>
                            Moree.me is the quickest way to connect.

                            <br>
                            There are only two clauses. You can only pick once a day. The day starts 0:00 GMT. Everything resets on Sunday.
                        </p>
                    </div>
                </div>
            </section>

            <section class="col-xs-12 col-sm-4 footerbg1 text-muted">
                <h4>Spots</h4>

                <p>
                    Spots are where the hangouts happen. From Cinemas to restaurants, to parties. Select your preferred spot in your profile.
                    <br>
                    The number of spots we provide for your hangouts will continue to increase as we thrive to bring you the best money can buy for free :)
                </p>

            </section>

            <section class="col-xs-12 col-sm-3 footerbg1 text-muted social-media text-center">
                <h4>Social Media</h4>
                <p class="text-center">
                    <a href="https://twitter.com/officialmoreeme" target="_blank" class="fa fa-twitter" ></a>
                    <a href="https://www.facebook.com/officialmoreeme/" target="_blank" class="fa fa-facebook"></a>
                    <a href="https://www.instagram.com/officialmoreeme/" class="fa fa-instagram" target="_blank"></a>
                </p>
                <p class="text-center"><i class="fa fa-envelope" aria-hidden="true"></i>mail@moree.me</p>
            </section>

        </div>
        <div class="row footer-bottom">
            <div class="col-xs-7 col-sm-4">
                <a href="#"> Moree.me 2017 </a>
            </div>
            <div class="col-xs-5 col-sm-8 text-right pull-right">
                <ul>
                    <li><a href="#" class="help"><span class="hidden-xs">How it works</span> <span class="icon icon-question-circle"></span></a> </li>
                    <li><a href="{{route('faq')}}">FAQs</a></li>
                    <li><a href="{{route("policy")}}">Terms </a></li>
                </ul>
            </div>
        </div>
    </div>
    {{--</div>--}}
    <!--/. End Footer Section -->
</div>