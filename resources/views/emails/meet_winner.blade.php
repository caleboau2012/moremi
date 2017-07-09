
@extends('emails.layout')
@section('content')
    <tr>
        <td bgcolor="#ffffff" style="padding:40px 30px 40px 30px">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="text-transform: capitalize; color:#fe574a;font-family:Arial,sans-serif;font-size:24px">
                        <b>Dear {{$user->first_name}} {{$user->last_name}},</b>
                    </td>
                </tr>
                <tr>
                    <td style="padding:20px 0 30px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:25px">
                        Get ready for something magical!!! Your connection, {{ $voter->first_name }} {{$voter->last_name}} would like to meet with you and has booked an expensive spot at {{$location}} on <a href="{{route('index')}}" target="_blank">Moree.me</a>.
                        <br> <br> <span style="color:#f59c43"> Find below, the ticket to your spot ,****please note that the ticket is only valid if you go with (<i style="text-transform: capitalize">{{ $voter->first_name }} {{$voter->last_name}}</i>)<br><br></span>
                        Log into your account now to chat with your new connection.
                    </td>
                </tr>

                <tr>
                    <td style="padding:10px 0 30px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:25px;text-align:center">
                        <a href="{{route('profile')}}" style="padding:10px 30px 10px 30px;color:#ffffff;font-family:Arial,sans-serif;font-size:16px;line-height:25px;background-color:#fe574a;text-decoration:none">LOG IN</a>
                    </td>
                </tr>
                <tr>
                    <td>
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <tr>
                                <td width="260" valign="top" style="border-bottom:solid 1px #ededed">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                                Reference :
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                                Spot :
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                                Ticket Id :
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                                Admits :
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                Expires :
                                            </td>
                                        </tr>
                                    </table>
                                </td>

                                <td width="260" valign="top" style="border-bottom:solid 1px #ededed">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                        <tr>
                                            <td style="text-transform: capitalize; padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                                <b>{{$reference}}</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="text-transform: capitalize; padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                                <b>{{$location}}</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                                <b>{{$ticket}}</b>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                                <b>Two people</b>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px">
                                                <b> {{$expiryDate->format('l, d F, Y')}}</b>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
@endsection