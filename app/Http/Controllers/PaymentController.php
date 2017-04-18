<?php

namespace App\Http\Controllers;

use App\Profile;
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
//                "ref" => Str::random(60)
            ));

            $tran->dispatch();

            if($tran->successful()) {
                //yay!
                $response = $tran->getResponse();
//                die(var_dump($response));
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

            dd($tran->getResponse());
//        return Paystack::getAuthorizationUrl()->redirectNow();
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
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
//        $paymentDetails = Paystack::getPaymentData();

//        dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want
    }
}