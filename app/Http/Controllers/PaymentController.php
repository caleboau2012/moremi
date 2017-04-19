<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Profile;
use App\Services\Vote\VoteService;
use App\Traits\AuthTrait;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Moneywave\Moneywave;
use Moneywave\Bank;
use Moneywave\Transactions\CardToAccountTransaction;

class PaymentController extends Controller
{
    use AuthTrait;

    public function __construct(Request $request) {
        $this->request=$request;
        $this->authenticate();
    }

    /**
     * Redirect the User to Moneywave Payment Page
     * @return Url
     */
    public function connectToGateway(Request $request)
    {
        if(!$this->auth) {
            return response()->json(['status'=>false, "profile" => false, 'msg'=>'You must be logged in to pay']);
        }
        $profile =Profile::find($this->_userId)->first();

        if(isset($profile->card_no) && isset($profile->cvv) &&
            isset($profile->expiry_year) && isset($profile->expiry_month) &&
            isset($profile->email) && isset($profile->phone)){
            //Get a moneywave client instance
            $mw = new Moneywave();

            //get a transaction instance
            $tran = new CardToAccountTransaction($mw);

            $tran->setDetails(array(
                "amount" => $request->amount,
                "bankcode" => Bank::$UNION,
                "accountNumber" => config('constants.account_no'),
                "senderName" => $profile->first_name . " " . $profile->last_name,
                "firstname" => $profile->first_name,
                "lastname" => $profile->last_name,
                "phonenumber" => $profile->phone,
                "medium" => config('constants.medium'),
                "card_no" => $profile->card_no,
                "cvv" => $profile->cvv,
                "expiry_year" => $profile->expiry_year,
                "expiry_month" => $profile->expiry_month,
                "email" => $profile->email,
                "redirecturl" => route("payment_callback")
//                "ref" => Str::random(60)
            ));

//            Store attempted payment.
            $payment = new Payment();
            $payment->amount = $request->amount;
            $payment->accountNumber = config('constants.account_no');
            $payment->profile_id = $profile->id;
            $payment->voted_profile_id = $request->voted_profile_id;
            $payment->medium = config('constants.medium');

            $payment->save();

            session(["payment_id", $payment->id]);

            $tran->dispatch();

            if($tran->successful()) {
                $response = $tran->getResponse();
                if($response['data']['pendingValidation']){
                    return response()->json([
                        "status" => false,
                        "profile" => true,
                        "validaton" => $response['data']['pendingValidation'],
                        "html" => $response['data']['authurl'],
                        "meta" => $tran->getResponse()
                    ]);
                }
                else{
                    $this->handleGatewayCallback();

                    return response()->json([
                        "status" => true,
                        "profile" => true,
                        "validaton" => $response['data']['pendingValidation'],
                        "html" => $response['data']['responsehtml'],
                        "meta" => $tran->getResponse()
                    ]);
                }
            } else {
                return response()->json([
                    "status" => false,
                    "profile" => false,
                    "msg" => "An error occurred, please confirm that your card details in your profile are correct",
                    "meta" => $tran->getResponse()
                ]);
            }

            return ($tran->getResponse());
        }

        else{
            return response()->json([
                'status' => false,
                "profile" => false,
                "msg" => "Incomplete profile. Please fill in the details as required"
            ]);
        }
    }

    /**
     * Obtain payment information
     *
     */
    public function handleGatewayCallback()
    {
        $payment = Payment::find(session("payment_id"))->firstOrFail();

        $payment->status = 1;
        $payment->save();

        $vote = new VoteService($this->request);

        switch($payment->amount){
            case 10:
                $count = 0;
                break;
            case 355:
                $count = 4;
                break;
            case 655:
                $count = 9;
                break;
            default:
                $count = 0;
        }

        $vote->vote($payment->voted_profile_id, $count);
        $vote->storeRequest($payment->voted_profile_id,$this->_userId);
        $msg =[
            'status'=>true,
            'auth' => true,
            'free' => false,
            'profile' => true,
            'msg'=>'Photo voted successfully',
            'count'=>$vote->count
        ];

        return view('pages.terms');
    }
}