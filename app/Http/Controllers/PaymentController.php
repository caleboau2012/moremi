<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Profile;
use App\Services\Vote\VoteService;
use App\Traits\AuthTrait;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Unicodeveloper\Paystack\Facades\Paystack;

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
    public function redirectToGateway(Request $request)
    {
        if(!$this->auth) {
            return response()->json(['status'=>false, "profile" => false, 'msg'=>'You must be logged in to pay']);
        }
        $profile =Profile::find($this->_userId);

//            Store attempted payment.
        $payment = new Payment();
        $payment->amount = $request->amount / 100;
        $payment->accountNumber = config('constants.account_no');
        $payment->profile_id = $profile->id;
        $payment->voted_profile_id = $request->voted_profile_id;
        $payment->medium = config('constants.medium');

        $payment->save();

        session(["payment_id" => $payment->id]);

        $request->orderID = $payment->id;
        $request->message = $payment->id;

        return Paystack::getAuthorizationUrl()->redirectNow();
    }

    /**
     * Obtain payment information
     *
     */
    public function handleGatewayCallback()
    {
        $paymentDetails = Paystack::getPaymentData();

        $payment = Payment::find(session("payment_id")) ;

        $payment->status = 1;
        $payment->save();

        $vote = new VoteService($this->request);

        switch($payment->amount){
            case config('constants.small_bundle'):
                $count = 0;
                break;
            case config('constants.medium_bundle'):
                $count = 4;
                break;
            case config('constants.large_bundle'):
                $count = 9;
                break;
            default:
                $count = 0;
        }

        $vote->vote($payment->voted_profile_id, $count);
        $vote->storeRequest($payment->voted_profile_id,$this->_userId,(config('settings.vote_counter') +$count));
        $msg =[
            'status'=>true,
            'auth' => true,
            'free' => false,
            'profile' => true,
            'msg'=>'Photo voted successfully',
            'count'=>$vote->count
        ];

//        dd(url()->previous());
//
//        return redirect()->back();
        return redirect()->route('app');
    }
}