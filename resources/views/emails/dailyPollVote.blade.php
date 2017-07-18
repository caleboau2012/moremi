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
                        We at Moree.me hope magical things happened to you today.
                        <br>
                        Here are places you can visit to cool off...
                        <br>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            @foreach($spots as $venue)
                                <tr>
                                    <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                        <a href="{{route('spot_redirect', \Illuminate\Support\Facades\Crypt::encrypt($venue->url))}}" target="_blank">
                                            <img src="{{route('spot_redirect', \Illuminate\Support\Facades\Crypt::encrypt($venue->thumb))}}" class="img-responsive" alt="{{$venue->title}}">
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
                    Don't go alone though. Here are people we suggest you should go there with...
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
                    <td style="color:#fe574a;font-family:Arial,sans-serif;font-size:24px">
                        Log into your account to connect with them...
                    </td>
                </tr>

                <tr>
                    <br>
                    <td style="padding:10px 0 30px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:25px;text-align:center">
                        <a href="{{route('profile')}}" style="padding:10px 30px 10px 30px;color:#ffffff;font-family:Arial,sans-serif;font-size:16px;line-height:25px;background-color:#fe574a;text-decoration:none">See Who Picked You</a>
                    </td>
                </tr>

                <tr>
                    @if(!is_null($poll))
                        More on Moree.me...
                        <br>
                        You were picked <b>{{$poll->total }}</b> time{{($poll->total > 1)?"s":""}} today.
                    @endif
                    <br>
                    @if(!empty($connections))
                        You received the following messages today...
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
                </tr>
            </table>
        </td>
    </tr>
@endsection