@extends('emails.layout')
@section('content')
    <tr>
        <td bgcolor="#ffffff" style="padding:40px 30px 40px 30px">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="color:#fe574a;font-family:Arial,sans-serif;font-size:24px">
                        <b style="text-transform: capitalize; ">Dear {{$picked->first_name}} {{$picked->last_name}},</b> you were picked <b>{{$poll->total }}</b> time{{($poll->total > 1)?"s":""}} today
                    </td>
                </tr>
                <tr>
                    <td style="padding:20px 0 30px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:25px">
                        Log into your account to see who picked you.
                    </td>
                </tr>

                <tr>
                    <td style="padding:10px 0 30px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:25px;text-align:center">
                        <a href="{{route('profile')}}" style="padding:10px 30px 10px 30px;color:#ffffff;font-family:Arial,sans-serif;font-size:16px;line-height:25px;background-color:#fe574a;text-decoration:none">See Who Picked You</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection