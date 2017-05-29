<!--VotePay modal-->
<div class="modal fade" id="votePayModal" tabindex="-1" role="dialog" aria-labelledby="votePayModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <span class="fa fa-close fa-inverse"></span>
                    </span>
                </button>
                <h4 class="modal-title" id="votePayModalLabel">This won't take a while</h4>
            </div>
            <div class="modal-body">
                @if(isset($profile))
                    <div class="row" id="pay-slips">
                        <div class="col-md-4">
                            <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal vote-pay" role="form">
                                <div class="panel panel-danger">
                                    <div class="panel-body">
                                        <h2 class="text-center">
                                            ₦ {{config('constants.small_bundle') * config('constants.scale')}}
                                        </h2>
                                        <h3 class="text-center">
                                            1 vote
                                        </h3>
                                        <input type="hidden" name="email" value="{{$profile->email}}"> {{-- required --}}
                                        <input type="hidden" name="amount" value="{{config('constants.small_bundle') * 100}}"> {{-- required in kobo --}}
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                        <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}
                                        <input type="hidden" name="voted_profile_id" value="">
                                        <p>
                                            <button class="btn btn-danger btn-lg btn-block" type="submit"
                                                    data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing...">
                                                <i class="fa fa-credit-card fa-lg"></i> Pay Now!
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal vote-pay" role="form">
                                <div class="panel panel-danger">
                                    <div class="panel-body">
                                        <h2 class="text-center">
                                            ₦ {{config('constants.medium_bundle') * config('constants.scale')}}
                                        </h2>
                                        <h3 class="text-center">
                                            5 votes
                                        </h3>
                                        <input type="hidden" name="email" value="{{$profile->email}}"> {{-- required --}}
                                        <input type="hidden" name="amount" value="{{config('constants.medium_bundle') * 100}}"> {{-- required in kobo --}}
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                        <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}
                                        <input type="hidden" name="voted_profile_id" value="">
                                        <p>
                                            <button class="btn btn-warning btn-lg btn-block" type="submit"
                                                    data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing...">
                                                <i class="fa fa-credit-card fa-lg"></i> Pay Now!
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal vote-pay" role="form">
                                <div class="panel panel-danger">
                                    <div class="panel-body">
                                        <h2 class="text-center">
                                            ₦ {{config('constants.large_bundle') * config('constants.scale')}}
                                        </h2>
                                        <h3 class="text-center">
                                            10 votes
                                        </h3>
                                        <input type="hidden" name="email" value="{{$profile->email}}"> {{-- required --}}
                                        <input type="hidden" name="amount" value="{{config('constants.large_bundle') * 100}}"> {{-- required in kobo --}}
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}"> {{-- required --}}
                                        <input type="hidden" name="key" value="{{ config('paystack.secretKey') }}"> {{-- required --}}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}"> {{-- employ this in place of csrf_field only in laravel 5.0 --}}
                                        <input type="hidden" name="voted_profile_id" value="">
                                        <p>
                                            <button class="btn btn-success btn-lg btn-block" type="submit"
                                                    data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing...">
                                                <i class="fa fa-credit-card fa-lg"></i> Pay Now!
                                            </button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>