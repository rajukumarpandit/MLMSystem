<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Referral_Reward;

class SubscriptionController extends Controller
{
    public function subscriptionPage(){
        return view('subscription.subscription');
    }
    public function subscription(Request $request){
        $userid=Auth::id();
        $user=User::find($userid);
            $request->validate([
                'plan_name'=>'required|string',
                'car_limit'=>'required',
                'date'=>'required|date',
            ]);
    
        if($user){
            
            Subscription::create([
                'user_id'=>$userid,
                'plan_name'=>$request->plan_name,
                'car_limit'=>$request->car_limit,
                'expires_at'=>$request->date,
                'status'=>'active',
            ]);
            if($user->referrer_id ){
                $referredUser=User::find($user->referrer_id);
                //dd($referredUser);
                $bonus=$request->car_limit*(10/100);
                if($referredUser->cfm !=null ){
                    $bonus=$request->car_limit*(15/100);
                    $referredUser->balance += $bonus;
                    $referredUser->save();
                        Referral_Reward::create([
                            'user_id' => $userid,
                            'referrer_id' => $referredUser->id,
                            //'amount' => 15,
                            'amount' => $bonus,
                        ]);
                }else{
                    $referredUser->balance += $bonus;
                    $referredUser->save();
                    Referral_Reward::create([
                        'user_id' => $userid,
                        'referrer_id' => $referredUser->id,
                        'amount' => $bonus,
                        //'amount' => 10,
                    ]);

                }
                
            }
            
            //return redirect()->route('login')->with('success', 'Book plan successfully.');
            return redirect()->route('login.page')->with('success', 'Book plan successfully.');
        }
        //dd($request->all());
        return redirect()->route('subscription')->with('error', 'Your credencials not matched.');
    }
}
