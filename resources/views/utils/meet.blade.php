<!--VotePay modal-->
<div class="modal fade" id="meetModal" tabindex="-1" role="dialog" aria-labelledby="meetModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <span class="icon icon-close icon-inverse"></span>
                    </span>
                </button>
                <h2 class="modal-title" id="meetModalLabel">Select A Spot</h2>
            </div>
            <div class="modal-body">
                @if(isset($profile))
                    <div class="row" id="meet-slips">
                        @if(isset($spots))
                            @foreach($spots as $spot)
                                <div class="col-md-4">
                                    <div class="spot-item">
                                        <form method="POST" action="{{ route('meet') }}" accept-charset="UTF-8" class="form-horizontal meet" role="form">
                                         <div class="card hovercard">
                                            <div class="cardheader"></div>
                                            <div class="avatar center-block">
                                                <img class="img-responsive img-circle" src="{{$spot->thumb}}" alt="{{$spot->title}}">
                                            </div>
                                            <div class="info">
                                                <div class="title name">
                                                    <h4 class="text-center">{{$spot->title}}</h4>
                                                    <div class="content-end"></div>
                                                </div>

                                                <p>{{$spot->description}}</p>

                                                <h1 class="no-margin">
                                                    <strong class="font-main">&#x20a6;{{number_format($spot->discounted, 2)}}</strong>
                                                </h1>

                                                <h4 class="no-margin text-muted line-through">&#x20a6;{{number_format($spot->price, 2)}}</h4>

                                            </div>

                                            <div class="bottom">
                                                <input type="hidden" name="email" value="{{$profile->email}}"> {{-- required --}}
                                                <input type="hidden" name="amount" value="{{$spot->discounted * 100}}"> {{-- required in kobo --}}
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                                <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}
                                                <input type="hidden" name="voted_profile_id" value="">
                                                <input type="hidden" name="spot" value="{{$spot->id}}"> {{-- The spot ID --}}
                                                <button class="btn main-btn btn-block" type="submit"
                                                        data-loading-text="<i class='icon icon-circle-o-notch icon-spin'></i> Processing...">
                                                    <img src="{{asset('images/favicon.png')}}" width="30px"> Meet Here
                                                </button>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>