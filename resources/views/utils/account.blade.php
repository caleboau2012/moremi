<!--Account details modal-->
<div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="accountModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <span class="fa fa-close fa-inverse"></span>
                    </span>
                </button>
                <h4 class="modal-title" id="accountModalLabel">Account Details <span class="small">(All fields are required to make payments)</span></h4>
            </div>
            <form data-url="{{route("account-update")}}" name="account" accept-charset="UTF-8" class="form-horizontal" role="form">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h5 class="text-muted"> Personal Details</h5>
                        </div>
                        <div class="col-xs-6">
                            <span class="help-block text-muted small-font">  First Name</span>
                            <input type="text" class="form-control" placeholder="First Name" name="first_name"
                                   id="first_name" value="{{$profile->first_name}}" required/>
                        </div>
                        <div class="col-xs-6">
                            <span class="help-block text-muted small-font">  Last Name</span>
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name"
                                   id="last_name" value="{{$profile->last_name}}" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
                            <span class="help-block text-muted small-font">  Phone Number (+2345678901234)</span>
                            <input type="text" class="form-control" placeholder="Phone Number" name="phone"
                                   id="phone" value="{{$profile->phone}}" required/>
                        </div>
                        <div class="col-xs-6">
                            <span class="help-block text-muted small-font">  Email Address</span>
                            <input type="text" class="form-control" placeholder="Email Address" name="email"
                                   id="email" value="{{$profile->email}}" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <h5 class="text-muted"> Credit Card Number (eg. 0000111122223333)</h5>
                            <input type="text" class="form-control" placeholder="0000111122223333" name="card_no"
                                   id="card_no" value="{{$profile->card_no}}" required/>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-xs-3">
                            <span class="help-block text-muted small-font"> Expiry Month (MM)</span>
                            <input type="text" class="form-control" placeholder="MM" name="expiry_month"
                                   id="expiry_month" value="{{$profile->expiry_month}}" required/>
                        </div>
                        <div class="col-xs-3">
                            <span class="help-block text-muted small-font">  Expiry Year (YYYY)</span>
                            <input type="text" class="form-control" placeholder="YYYY" name="expiry_year"
                                   id="expiry_year" value="{{$profile->expiry_year}}" required/>
                        </div>
                        <div class="col-xs-3">
                            <span class="help-block text-muted small-font">  CCV</span>
                            <input type="text" class="form-control" placeholder="CCV" name="cvv"
                                   id="cvv" value="{{$profile->cvv}}" required/>
                        </div>
                        <div class="col-xs-3">
                            <br>
                            <img src="data:image/png;base64,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" class="img-rounded" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <br>
                            <label class="small">
                                Card details are saved for fast payments. <a target="_blank" href="{{route('policy')}}">Learn More</a>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row ">
                        <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                            <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <input type="submit" class="btn btn-warning btn-block" value="Save" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
