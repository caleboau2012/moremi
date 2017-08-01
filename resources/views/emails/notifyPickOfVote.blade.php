@extends('emails.layout')
@section('content')
    <tr>
        <td bgcolor="#ffffff" style="padding:40px 30px 40px 30px">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="text-transform: capitalize; color:#fe574a;font-family:Arial,sans-serif;font-size:24px">
                        <b>Dear {{$picked->first_name}} {{$picked->last_name}},</b>
                        <br>
                        You have been picked by <b>
                            <a href="{{route("my_profile", \Illuminate\Support\Facades\Crypt::encrypt($picker->id))}}" target="_blank">{{$picker->first_name}} {{$picker->last_name}}</a>
                        </b>
                    </td>
                </tr>
                <tr>
                    <td style="padding:20px 0 30px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:25px">
                        Log into your account to catch up on what you have missed.
                    </td>
                </tr>

                <tr>
                    <td style="padding:10px 0 30px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:25px;text-align:center">
                        <a href="{{route('my_profile', \Illuminate\Support\Facades\Crypt::encrypt($picker->id))}}" style="padding:10px 30px 10px 30px;color:#ffffff;font-family:Arial,sans-serif;font-size:16px;line-height:25px;background-color:#fe574a;text-decoration:none">View Picker's Profile</a>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection