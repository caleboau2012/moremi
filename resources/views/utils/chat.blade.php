<div class="chat-widget">
    <div class="connections">
        <h4 class="text-primary text-center margin-bottom-md hidden-sm hidden-xs">Your Connections</h4>
        <div class="row">
            @if(sizeof($connections) != 0)
            @foreach($connections as $c)
                <div class="col-xs-12 col-sm-3">
                    <div class="connection-item" data-id="messages-between-{{$c[\TableConstant::PROFILE_ID]}}-{{$c[\ConnectionConstant::RECIPIENT_ID]}}">
                        @if($c[\ConnectionConstant::PHOTO])
                            <img data-toggle="tooltip" data-placement="top" data-original-title="{{ucwords($c[\ConnectionConstant::NAME])}}"  src="{{asset($c[\ConnectionConstant::PHOTO]->thumb_path)}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-circle img-responsive">
                        @else
                            <img data-toggle="tooltip" data-placement="top" data-original-title="{{ucwords($c[\ConnectionConstant::NAME])}}" src="{{asset('images/default.png')}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-circle img-responsive">
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
            <div class="chat-container-header text-center">
                <h3 class="panel-title text-capitalize">
                    @if($c[\ConnectionConstant::PHOTO])
                        <img width="100px" src="{{asset($c[\ConnectionConstant::PHOTO]->thumb_path)}}" class="img-thumb img-circle img-small">
                    @else
                        <img width="100px" src="{{asset('images/default.png')}}" alt="{{$c[\ConnectionConstant::NAME]}}" class="img-thumb img-circle img-small">
                    @endif
                    {{$c[\ConnectionConstant::NAME]}}
                    <span class="icon icon-close"></span>
                </h3>
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
                        <textarea class="form-control msg"></textarea>
                    </div>
                    <div class="col-xs-5">
                        <button class="btn btn-sm btn-block btn-success send-msg"><span class="icon icon-send"></span> </button>
                        {{--<input type="button" value="Send" class="btn btn-sm btn-block btn-success send-msg">--}}
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>