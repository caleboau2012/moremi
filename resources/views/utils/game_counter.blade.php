<?php
/**
 * Created by PhpStorm.
 * User: macair
 * Date: 6/16/17
 * Time: 9:19 PM
 */
?>
@if(isset($voteEnds) && $voteEnds != null)
        <div class=" col-md-1 counter">
            <div class="cter-label"> <p>Pick stops In</p></div>

            <ul>
                <li><span id="cter_days">0</span>Days</li>
                <li><span id="cter_hours">0</span>Hours</li>
                <li><span id="cter_minutes">0</span>Minutes</li>
                <li><span id="cter_seconds">0</span>Seconds</li>
            </ul>
        </div>

@section('bottomScripts')
    @parent
    <script src="{{ asset('libs/countdown/jquery.countdown.js') }}"></script>
    <script>
        /*
         Final Countdown Settings
         */
        var finalDate = "{{$voteEnds}}";

        if(finalDate){
            $('div.counter').countdown(finalDate)
                .on('update.countdown', function(event) {
                    $("#cter_days").html(event.strftime('%D'));
                    $("#cter_hours").html(event.strftime('%H'));
                    $("#cter_minutes").html(event.strftime('%M'));
                    $("#cter_seconds").html(event.strftime('%S'));
                });
        }

    </script>
@endsection
@endif



