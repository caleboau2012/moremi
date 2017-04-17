<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; font-size: 14px; margin: 0;">
<head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <style type="text/css">
        img {
            max-width: 100%;
        }
        body {
            -webkit-font-smoothing: antialiased; -webkit-text-size-adjust: none; width: 100% !important; height: 100%; line-height: 1.6em;
        }
        body {
            background-color: #f6f6f6;
        }
    </style>
</head>

<body  style="background: #f3f3f3; padding: 10px;">

<div class="body-wrap" style="padding: 20px 10px; font-family: 'Helvetica Neue',Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 80%; background-color: #ffffff; margin: 5px auto 10px">
    <h3>
        We got a date for this week contest!
    </h3>
    <table>
        <tbody>
        <tr style="text-align: left; margin-top: 0; padding: 6px; width: 100%;">
            <td colspan="2" style="color: #fff; background: #D33834; font-family: 'Roboto', 'Helvetica Neue',Helvetica,Arial,sans-serif; padding: 7px;">Poll Details</td>
        </tr>
        <tr style="margin-left: 0;">
            <td width="35%" style="font-family: 'Roboto', 'Helvetica Neue',Helvetica,Arial,sans-serif; text-align: right; color: #000; font-weight: 600; background: #DCDCDC; padding: 5px 10px 5px 7px; text-transform: capitalize;">
                Total votes
            </td>
            <td style="text-transform: capitalize; font-family: 'Roboto', 'Helvetica Neue',Helvetica,Arial,sans-serif; background: #E7E7E7; padding-left: 5px;">
                {{ $poll->total }}
            </td>
        </tr>
        <tr style="margin-left: 0;">
            <td width="35%" style="font-family: 'Roboto', 'Helvetica Neue',Helvetica,Arial,sans-serif; text-align: right; color: #000; font-weight: 600; background: #DCDCDC; padding: 5px 10px 5px 7px; text-transform: capitalize;">
                Winner
            </td>
            <td style="text-transform: capitalize; font-family: 'Roboto', 'Helvetica Neue',Helvetica,Arial,sans-serif; background: #E7E7E7; padding-left: 5px;">
                {{ $winner->first_name }} {{$winner->last_name}}
            </td>
        </tr>
        <tr style="margin-left: 0;">
            <td width="35%" style="font-family: 'Roboto', 'Helvetica Neue',Helvetica,Arial,sans-serif; text-align: right; color: #000; font-weight: 600; background: #DCDCDC; padding: 5px 10px 5px 7px; text-transform: capitalize;">
                Highest Voter
            </td>
            <td style="text-transform: capitalize; font-family: 'Roboto', 'Helvetica Neue',Helvetica,Arial,sans-serif; background: #E7E7E7; padding-left: 5px;">
                {{ $voter->first_name }} {{$voter->last_name}}
            </td>
        </tr>
        <tr style="margin-left: 0;">
            <td width="35%" style="font-family: 'Roboto', 'Helvetica Neue',Helvetica,Arial,sans-serif; text-align: right; color: #000; font-weight: 600; background: #DCDCDC; padding: 5px 10px 5px 7px; text-transform: capitalize;">
                Date Location
            </td>
            <td style="text-transform: capitalize; font-family: 'Roboto', 'Helvetica Neue',Helvetica,Arial,sans-serif; background: #E7E7E7; padding-left: 5px;">
               {{$location}}
            </td>
        </tr>
        <tr style="margin-left: 0;">
            <td width="35%" style="font-family: 'Roboto', 'Helvetica Neue',Helvetica,Arial,sans-serif; text-align: right; color: #000; font-weight: 600; background: #DCDCDC; padding: 5px 10px 5px 7px; text-transform: capitalize;">
                Expiry Date
            </td>
            <td style="text-transform: capitalize; font-family: 'Roboto', 'Helvetica Neue',Helvetica,Arial,sans-serif; background: #E7E7E7; padding-left: 5px;">
               {{$expiryDate->format('l, d F, Y')}}
            </td>
        </tr>
        </tbody>
    </table>

</div>

<div style="width: 80%; margin : 0 auto;">
    <p style="color: #eeeeee; text-align: center;">
        You're receiving these emails because you signed up on Moree.me.
        Moree.me would never send you emails asking you to enter your account information on any site other than www.moree.me
    </p>
    <p style="color: #eeeeee; text-align: center;">
        Copyright © 2017 Moree.me All rights reserved.
    </p>
</div>
</body>
</html>