
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
                        Congratulations!!! , You have been selected for an Hangout on <a href="{{route('index')}}" target="_blank">Moree.me</a>,
                        <br>
                        <p style="color:#f59c43"> Find below, the ticket to the hangout spot ,****please note that the ticket is only valid if you go with the following people selected for the hangout: </p>

                        <ul>
                            @foreach($beneficiaries as $b)
                            <li>
                                <a href="{{route("my_profile", \Illuminate\Support\Facades\Crypt::encrypt($b->id))}}" target="_blank"><i style="text-transform: capitalize">{{ $b->first_name }} {{$b->last_name}}</i></a>
                            </li>
                            @endforeach
                        </ul>
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
                                                <b>{{$spot->name}}</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                                <b>{{$ticket->code}}</b>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td style="padding:25px 0 13px 0;color:#153643;font-family:Arial,sans-serif;font-size:16px;line-height:20px;border-bottom:solid 1px #ededed">
                                                <b>{{sizeof($beneficiaries)}}</b>
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