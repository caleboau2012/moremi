@extends('layouts.app')

@section('title')
    <title>Moree.me - Connecting people: Terms & Conditions</title>
@endsection

@section('header')
    @include('include.header_public_profile')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1">
                <table>
                    <tbody>
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
                                        Congratulations!!! You booked a spot to meet {{ $winner->first_name }} {{$winner->last_name}} using <a href="{{route('index')}}" target="_blank">Moree.me</a>,
                                        <br> <br> <span style="color:#f59c43"> Find below, the ticket to your spot ,****please note that the ticket is only valid if you go with
                            (<i style="text-transform: capitalize">{{ $winner->first_name }} {{$winner->last_name}}</i>)<br><br></span>
                                        We've sent details to your email and also emailed your pick. You can print this instead also. Just present these details at the spot.
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection