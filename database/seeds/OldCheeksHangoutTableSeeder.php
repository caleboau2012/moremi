<?php

use Illuminate\Database\Seeder;

class OldCheeksHangoutTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $oldCheeks = \App\OldCheek::all();
        $now_ = new DateTime();

        foreach ($oldCheeks as $oc){
            $ticket = \App\Ticket::where(TicketConstant::CODE, $oc->ticket)->first();

            if($ticket){
                //Save hangout record of Old cheek
                $hangout = new \App\Hangout();
                $hangout[\HangoutConstant::REFERENCE] = uniqid('HNG');
                $hangout[\HangoutConstant::CREATOR] = $oc->voter_id;
                $hangout[\TableConstant::CREATED_AT] = $now_;
                $hangout[\HangoutConstant::VENUE] = $ticket->venue_id;

                $hangout->save();

//                Add Hangout Id to Old cheek record
                $oc->hangout_id = $hangout->id;
                $oc->save();

            }

        }
    }
}
