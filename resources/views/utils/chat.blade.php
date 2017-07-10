@if(isset($profile))
    {{-- Constants --}}
    <p class="hidden" id="_token">{{ csrf_token() }}"</p>
    <p class="hidden" id="id_user_from">{{$profile->id}}</p>
    <h2 class="text-center hidden" id="user">{{$profile->first_name}} {{$profile->last_name}}</h2>
    <p class="hidden" id="chat-url">{{route('chat-url')}}</p>

    <div class="chat-widget">
        <div class="connections">
            <h4 class="text-primary text-center margin-bottom-md hidden-sm hidden-xs">Your Connections</h4>
            <div class="row">
                {{--{{dd($connections)}}--}}
                @if(sizeof($connections) != 0)
                    @foreach($connections as $c)
                        <div class="col-xs-12 col-sm-3">
                            <div class="connection-item" data-id="messages-between-{{$c[\TableConstant::PROFILE_ID]}}-{{$c[\ConnectionConstant::RECIPIENT_ID]}}">
                                @if($c[\ConnectionConstant::PHOTO])
                                    <img data-toggle="tooltip" data-placement="top" data-original-title="{{ucwords($c[\ConnectionConstant::NAME])}}"  src="{{asset($c[\ConnectionConstant::PHOTO]->thumb_path)}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-circle img-responsive">
                                @elseif($c[ProfileConstant::SEX] == ProfileConstant::MALE)
                                    <img data-toggle="tooltip" data-placement="top" data-original-title="{{ucwords($c[\ConnectionConstant::NAME])}}" src="{{asset('images/default-male.png')}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-circle img-responsive">
                                @elseif($c[ProfileConstant::SEX] == ProfileConstant::FEMALE)
                                    <img data-toggle="tooltip" data-placement="top" data-original-title="{{ucwords($c[\ConnectionConstant::NAME])}}" src="{{asset('images/default-female.png')}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-circle img-responsive">
                                @endif
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col-xs-12">
                        <p class="text-primary text-center">Keep Picking. We'll connect you shortly...</p>
                    </div>
                @endif
            </div>

        </div>
    </div>

    {{--CHAT BOX--}}
    <div id="chat-container">
        @foreach($connections as $c)
            <div class="hidden chat-box" id="messages-between-{{$c[\TableConstant::PROFILE_ID]}}-{{$c[\ConnectionConstant::RECIPIENT_ID]}}">
                <div class="chat-container-header">
                    <div>
                        <p class="text-right close_icon_con">
                            <span class="icon icon-close pointer close-icon"></span>
                        </p>
                        <div class="recipient_details_con">
                            <h5 class="text-capitalize text-white recipient_details">
                                @if($c[\ConnectionConstant::PHOTO])
                                    <img src="{{asset($c[\ConnectionConstant::PHOTO]->thumb_path)}}" class="img-thumb img-circle img-small">
                                @elseif($c[ProfileConstant::SEX] == ProfileConstant::MALE)
                                    <img src="{{asset('images/default-male.png')}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-thumb img-circle img-small">
                                @elseif($c[ProfileConstant::SEX] == ProfileConstant::FEMALE)
                                    <img src="{{asset('images/default-female.png')}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-thumb img-circle img-small">
                                @endif
                                {{$c[\ConnectionConstant::NAME] }}
                            </h5>
                            <div class="details-end"></div>
                        </div>
                    </div>
                </div>
                <div class="chat-container-body">
                    <div class="row">
                        <div class="col-xs-12" >
                            <div class="chat-messages">
                                @if(isset($c[\ConnectionConstant::MESSAGES]))
                                    @foreach($c[\ConnectionConstant::MESSAGES] as $m)
                                        <div class="chat-message-item">
                                            <strong>{{$m->user}}:</strong>
                                            <p class="chat-message">{{$m->message}}</p>
                                            <small class="text-right chat-time format_time">{{$m->time}}</small>
                                        </div>
                                    @endforeach
                                    {{--@else--}}
                                    {{--&nbsp;--}}
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-7" >
                            <p class="hidden" id="id_user_to">{{$c[\ConnectionConstant::RECIPIENT_ID]}}</p>
                            <textarea class="form-control msg" placeholder="Type Here..."></textarea>
                        </div>
                        <div class="col-xs-5">
                            <button class="btn btn-sm btn-block btn-default meet-from-chat"><img src="{{asset('images/favicon.png')}}" width="20px"></button>
                            {{--<input type="button" value="Send" class="btn btn-sm btn-block btn-success send-msg">--}}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif