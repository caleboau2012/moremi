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
                <h4 class="modal-title" id="votePayModalLabel">Pay</h4>
            </div>
            <div class="modal-body">
                <div class="row" data-url="{{route('pay')}}" id="pay-slips">
                    <div class="col-md-4">
                        <div class="panel panel-danger">
                            <div class="panel-body">
                                <h1 class="h1 text-center">
                                    ₦ 100
                                </h1>
                                <h2 class="h2 text-center">
                                    1 vote
                                </h2>
                                <p>
                                    <button class="btn btn-danger btn-lg btn-block vote-pay" data-amount="55"
                                            data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing...">
                                        <i class="fa fa-credit-card fa-lg"></i> Pay Now!
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-warning">
                            <div class="panel-body">
                                <h1 class="h1 text-center">
                                    ₦ 400
                                </h1>
                                <h2 class="h2 text-center">
                                    5 votes
                                </h2>
                                <p>
                                    <button class="btn btn-warning btn-lg btn-block vote-pay" data-amount="355"
                                            data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing...">
                                        <i class="fa fa-credit-card fa-lg"></i> Pay Now!
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="panel panel-success">
                            <div class="panel-body">
                                <h1 class="h1 text-center">
                                    ₦ 700
                                </h1>
                                <h2 class="h2 text-center">
                                    10 votes
                                </h2>
                                <p>
                                    <button class="btn btn-success btn-lg btn-block vote-pay" data-amount="655"
                                            data-loading-text="<i class='fa fa-circle-o-notch fa-spin'></i> Processing...">
                                        <i class="fa fa-credit-card fa-lg"></i> Pay Now!
                                    </button>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row hidden" id="validationFrame">
                    <iframe class="validation-frame">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>