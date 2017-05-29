<?php

namespace App\Http\Controllers;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\VenueService;
use App\Venue;

class VenueController extends Controller {
    public function fetchPreviews(){
        $venues = Venue::all();

        $venueService = new VenueService();
        $previews = [];
        $index = 0;

        foreach($venues as $v){
            $previews[$index] = $venueService->fetchPreview($v->url);
            $v->thumb = $previews[$index]['images'][0];
            $v->title = $previews[$index]['title'];
            $v->save();

            $index++;
        }

        return response()->json([
            "status" => "done",
            "previews" => $previews
        ]);
    }
}
