<?php

namespace App\Http\Controllers;

use App\Profile;
use App\Services\UserService;
use App\Services\VenueService;
use App\Traits\AuthTrait;
use App\Venue;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    use AuthTrait;
    protected $_upload;
    public function __construct(Request $request) {
        $this->request=$request;
        $this->authenticate();
    }

    public  function myProfile(){
        if(!$this->auth) {
            return response()->json(['status'=>false,'message'=>'You must be logged in to upload photo']);
        }
        $profile =Profile::find($this->_userId)->first();
        return response()->json([
            'status'=>true,
            'data'=>[
                'status'=>$profile->about,
                'profile_pic'=>$profile->photo->full_path,
                'photos'=>$profile->photos->toArray()
            ]
        ]);
    }

    //profile page
    public function profile(){
        if(!$this->auth) {
            return back();
        }

        $venues = Venue::all()->toArray();

        $venueService = new VenueService();

        for($i = 0; $i < sizeof($venues); $i++){
            $venues[$i]['preview'] = $venueService->fetchPreview($venues[$i]['url']);
        }

        $profile = Profile::find($this->_userId)->first();

        return view('profile',[
                'photos' => $profile->photos->toArray(),
                'profile' => $profile,
                'venues' => $venues
            ]
        );
    }

    //edit account details
    public function updateAccountDetails(Requests\UpdateAccountRequest $request){
        if(!$this->auth) {
            return response()->json([
                "status" => false,
                "msg" => "You must be logged in to updateProfile"
            ]);
        }
        else{
            $profile = Profile::find($this->_userId)->first();

            $profile->first_name = $request->first_name;
            $profile->last_name = $request->last_name;
            $profile->phone = $request->phone;
            $profile->email = $request->email;
            $profile->card_no = $request->card_no;
            $profile->expiry_month = $request->expiry_month;
            $profile->expiry_year = $request->expiry_year;
            $profile->cvv = $request->cvv;

            $profile->save();

            return response()->json([
                'status' => true,
                'msg' => "Profile saved successfully"
            ]);
        }
    }
}
