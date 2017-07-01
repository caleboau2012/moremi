<!--Account details modal-->
<div class="modal fade" id="accountModal" tabindex="-1" role="dialog" aria-labelledby="accountModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">
                        <span class="icon icon-close icon-inverse"></span>
                    </span>
                </button>
                <h4 class="modal-title" id="accountModalLabel">Personal Details
                </h4>
            </div>
            @if(isset($profile))
                <form data-url="{{route("account-update")}}" name="account" accept-charset="UTF-8" class="form-horizontal_" role="form">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-6 form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" placeholder="First Name" name="first_name"
                                       id="first_name" value="{{$profile->first_name}}" required/>
                            </div>
                            <div class="col-xs-6 form-group">
                                <label for="last_name"> Last Name</label>
                                <input type="text" class="form-control" placeholder="Last Name" name="last_name"
                                       id="last_name" value="{{$profile->last_name}}" required/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-6 form-group">
                                <label for="phone"> Phone Number (+2345678901234)</label>
                                <input type="text" class="form-control" placeholder="Phone Number" name="phone"
                                       id="phone" value="{{$profile->phone}}" required/>
                            </div>
                            <div class="col-xs-6 form-group">
                                <label for="email">Email Address</label>
                                {{--<span class="help-block text-muted small-font">  Email Address</span>--}}
                                <input type="text" class="form-control" placeholder="Email Address" name="email"
                                       id="email" value="{{$profile->email}}" required/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-xs-12 form-group">
                                <label for="venue">Preferred Spot</label>
                                <select name="venue" id="venue" class="form-control">
                                    <option value="0">Select your preferred meeting location</option>
                                    @foreach($venues as $venue)
                                        @if($venue->id == $profile->venue)
                                            <option selected value="{{$venue->id}}" data-url="{{$venue->url}}"
                                                    data-title="{{$venue->title}}" data-image="{{$venue->thumb}}">{{$venue->name}}</option>
                                        @else
                                            <option value="{{$venue->id}}" data-url="{{$venue->url}}"
                                                    data-title="{{$venue->title}}" data-image="{{$venue->thumb}}">{{$venue->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row ">
                            <div class="col-md-6 col-sm-6 col-xs-6 text-left">
                                <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <input type="submit" class="btn btn-success btn-block" value="Save" />
                            </div>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
