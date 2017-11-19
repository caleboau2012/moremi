@extends('emails.layout')
@section('content')
    <tr>
        <td bgcolor="#ffffff" style="padding:40px 30px 40px 30px">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="color:#fe574a;font-family:Arial,sans-serif;font-size:24px">
                        <b style="text-transform: capitalize; ">Dear {{$picked->first_name}} {{$picked->last_name}},</b>
                        <br>
                        <br>
                        We at Moree.me hope magical things happened to you this week.
                        <br>
                        @if(!is_null($poll))
                            <br>
                            You have been picked <b>{{$poll->total }}</b> time{{($poll->total > 1)?"s":""}} thus far this week.
                            <br>
                        @endif
                        @if(sizeof($voters) != 0)
                            <br>
                            Here's your leaderboard.
                            <br>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th colspan="2" style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed; text-align: left">Picked by</th>
                                    <th style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed; text-align: left">Picks</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--{{dd($voters)}}--}}
                                @if(isset($voters) && !is_null($voters))
                                    @foreach($voters as $v)
                                        @if(isset($v["profile"]) && !is_null($v["profile"]))
                                            <tr>
                                                <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                                    <a target="_blank" href='{{route('my_profile', \Illuminate\Support\Facades\Crypt::encrypt($v['profile']->id))}}'>
                                                        @if(isset($v['profile']->photo->thumb_path))
                                                            <img width="20px" src="{{asset($v['profile']->photo->thumb_path)}}" alt="{{$v['profile']->first_name}} {{$v['profile']->last_name}}" class="img-circle img-responsive">
                                                        @elseif($v['profile']->sex == ProfileConstant::MALE)
                                                            <img width="20px" src="{{asset("images/default-male.png")}}" alt="{{$v['profile']->first_name}} {{$v['profile']->last_name}}" class="img-circle img-responsive">
                                                        @else
                                                            <img width="20px" src="{{asset("images/default-female.png")}}" alt="{{$v['profile']->first_name}} {{$v['profile']->last_name}}" class="img-circle img-responsive">
                                                        @endif
                                                    </a>
                                                </td>
                                                <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                                    <a target="_blank" href='{{route('my_profile', \Illuminate\Support\Facades\Crypt::encrypt($v['profile']->id))}}'>
                                                        {{$v['profile']->first_name}} {{$v['profile']->last_name}}
                                                    </a>
                                                </td>
                                                <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">{{$v['count']}}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="padding:10px 0 30px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:25px;text-align:center">
                        <br>
                        <a href="{{route('profile')}}" style="padding:10px 30px 10px 30px;color:#ffffff;font-family:Arial,sans-serif;font-size:16px;line-height:25px;background-color:#fe574a;text-decoration:none">See Who Picked You</a>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td style="color:#fe574a;font-family:Arial,sans-serif;font-size:24px">
                        @if(!empty($connections))
                            You received the following messages this week...
                            <br>
                            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td width="260" valign="top" style="border-bottom:solid 1px #ededed">
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            @foreach($connections as $c)
                                                <tr>
                                                    <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                                        @if(isset($c["photo"]->thumb_path))
                                                            <img src="{{asset($c["photo"]->thumb_path)}}" width="100px" alt="{{$c["name"]}}">
                                                        @elseif($c["sex"] == "female")
                                                            <img src="{{asset("images/default-female.png")}}" width="100px" alt="{{$c["name"]}}">
                                                        @else
                                                            <img src="{{asset("images/default-male.png")}}" width="100px" alt="{{$c["name"]}}">
                                                        @endif
                                                    </td>
                                                    <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                                        {{$c["name"]}}
                                                    </td>
                                                    <td style="text-transform: capitalize; padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                                        @foreach($c[ConnectionConstant::MESSAGES] as $m)
                                                            <p>{{$m->message}}</p>
                                                        @endforeach
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </td>
                                </tr>
                            </table>
                            <br>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td style="color:#fe574a;font-family:Arial,sans-serif;font-size:24px">
                        <br>
                        Don't forget that you can get to hangout for free in:
                        <br>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            @foreach($spots as $venue)
                                <tr>
                                    <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                        <a href="{{route('spot_redirect', \Illuminate\Support\Facades\Crypt::encrypt($venue->url))}}" target="_blank">
                                            <img width="200px" src="{{route('spot_redirect', \Illuminate\Support\Facades\Crypt::encrypt($venue->thumb))}}" class="img-responsive" alt="{{$venue->title}}">
                                        </a>
                                    </td>
                                    <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                        <a href="{{route('spot_redirect', \Illuminate\Support\Facades\Crypt::encrypt($venue->url))}}" target="_blank">
                                            <h4 class="text-center text-primary">{{$venue->name}}</h4>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <br>
                    </td>
                </tr>
                <tr>
                    <td style="color:#fe574a;font-family:Arial,sans-serif;font-size:24px">
                        Don't go alone though. Go there with your connections and other people on Moree.me such as:
                        <br>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            @foreach($suggestions as $s)
                                <tr>
                                    <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                        <a href="{{route('my_profile', \Illuminate\Support\Facades\Crypt::encrypt($s["id"]))}}">
                                            @if(isset($s["photo"]->full_path))
                                                <img src="{{asset($s["photo"]->full_path)}}" width="200px" alt="{{$s["first_name"]}} {{$s["last_name"]}}">
                                            @elseif($s["sex"] == "female")
                                                <img src="{{asset("images/default-female.png")}}" width="200px" alt="{{$s["first_name"]}} {{$s["last_name"]}}">
                                            @else
                                                <img src="{{asset("images/default-male.png")}}" width="200px" alt="{{$s["first_name"]}} {{$s["last_name"]}}">
                                            @endif
                                        </a>
                                    </td>
                                    <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                        <a href="{{route('my_profile', \Illuminate\Support\Facades\Crypt::encrypt($s["id"]))}}">
                                            {{$s["first_name"]}} {{$s["last_name"]}}
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        <br>
                    </td>
                </tr>

                <tr>
                    <td style="padding:10px 0 30px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:25px;text-align:center">
                        <br>
                        <a href="{{route('profile')}}" style="padding:10px 30px 10px 30px;color:#ffffff;font-family:Arial,sans-serif;font-size:16px;line-height:25px;background-color:#fe574a;text-decoration:none">Log into your account to connect</a>
                        <br>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection