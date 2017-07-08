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
                        @foreach($spots as $spot)
                            <div class="col-md-4">
                                <form method="POST" action="{{ route('meet') }}" accept-charset="UTF-8" class="form-horizontal meet" role="form">
                                    <div class="panel panel-danger">
                                        <div class="panel-heading">
                                            <h2 class="panel-title text-center">
                                                {{$spot->title}}
                                            </h2>
                                        </div>
                                        <div class="panel-body meet-spot">
                                            <div class="text-center">
                                                <img class="spot-logo" src="{{$spot->thumb}}">
                                            </div>
                                            <h3 class="text-center">
                                                <label class="label label-danger">Amount:</label> ₦ {{$spot->discounted}}
                                            </h3>
                                            <h5 class="text-center">
                                                <label class="label label-default">Originally:</label> ₦ {{$spot->price}}
                                            </h5>
                                            <p>{{$spot->description}}</p>
                                            <input type="hidden" name="email" value="{{$profile->email}}"> {{-- required --}}
                                            <input type="hidden" name="amount" value="{{$spot->discounted * 100}}"> {{-- required in kobo --}}
                                            <input type="hidden" name="quantity" value="1">
                                            <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                            <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}
                                            <input type="hidden" name="voted_profile_id" value="">
                                            <input type="hidden" name="spot" value="{{$spot->id}}"> {{-- The spot ID --}}
                                        </div>
                                        <div class="panel-footer">
                                            <p>
                                                <button class="btn btn-danger btn-block" type="submit"
                                                        data-loading-text="<i class='icon icon-circle-o-notch icon-spin'></i> Processing...">
                                                    <img src="{{asset('images/favicon.png')}}" width="30px"> Meet Now!
                                                </button>
                                            </p>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>