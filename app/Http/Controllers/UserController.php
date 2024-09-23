<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Subscription;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Mail\SendMail;
use App\Models\Referral_Reward;


class UserController extends Controller
{
     // this function used for load login page
    public function loginPage(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('login');
    }


    // this function used for load register page
    public function registerPage(){
        if(Auth::check()){
            return redirect()->route('dashboard');
        }
        return view('register');
    }


    public function registerNewUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|unique:users,email|max:255',
            'password' => 'required|min:4',
            'referral_id' => 'nullable|string',
            'state' => 'nullable|string',
            'cfm' => 'nullable|string'
            
        ]);

        // Register the new user
        
        

        // Distribute rewards if referrer exists
        $level=1;
        if(!$request->referral_id){
            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'referrer_id' =>$request->referral_id ?? null,
                'password'=>Hash::make($request->password),
                'state' =>$request->state ?? null,
            ]);
        }

        $referrer = User::find($request->referral_id);
        if ($referrer) {
            $newUser = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'referrer_id' =>$request->referral_id ?? null,
                'password'=>Hash::make($request->password),
                'state' =>$request->state ?? null,
            ]);
            
            //$this->distributeReferralRewards($newUser);
            $this->distributeReferralRewards($newUser, $referrer, $level);
            $domin=URL::to('/');
            $url=$domin.'/referral/register?referral='.$newUser->id;
            $level=$referrer->user_level+1 ?? $level;
            $newUser->update([
                'user_level'=>$level,
                'referral_link'=>$url,
            ]);
        }
            $domin=URL::to('/');
            $url=$domin.'/referral/register?referral='.$newUser->id;
            $newUser->update([
                'user_level'=>$level,
                'referral_link'=>$url,
            ]);

            $cfm = User::where('referrer_id',$request->referral_id)->get();
            if(count($cfm)==10){
                $cfmupdat = User::find($request->referral_id);
                $cfmupdat->update([
                    'cfm'=>"CFM",
                ]);
            }
        return redirect()->route('login.page')->with('success', 'Your are register successfully.');
    }
    

    protected function distributeReferralRewards(User $newUser, User $currentReferrer, $level)
    {
        // Define reward amounts for each level
        $first=array(10);
        $second=array(2);
        $third=array_fill(2,4,1);
        $rewards=array_merge($first,$second,$third); // Rewards for levels 1, 2, and 3 respectively

        // Check if the current level has a reward defined
        if ($level > count($rewards)) {
            return; // No more levels to process
        }

        // Get the reward for the current level
        $rewardAmount = $rewards[$level - 1];

        // Update referrer's balance and create a referral reward record
        //dd($currentReferrer);
        if($currentReferrer->cfm){
            $currentReferrer->balance += 10;
            $currentReferrer->save();
            Referral_Reward::create([
                'user_id' => $newUser->id,
                'referrer_id' => $currentReferrer->id,
                'amount' => $rewardAmount,
            ]);
        }else{
            $currentReferrer->balance += $rewardAmount;
            $currentReferrer->save();

            Referral_Reward::create([
                'user_id' => $newUser->id,
                'referrer_id' => $currentReferrer->id,
                'amount' => $rewardAmount,
            ]);

            // Get the next level referrer
            $nextReferrer = User::find($currentReferrer->referrer_id);
            
            // Recursively distribute rewards to the next level
            if ($nextReferrer) {
                $this->distributeReferralRewards($newUser, $nextReferrer, $level + 1);
            }
        }
    }

    // protected function distributeReferralRewards(User $user)
    // {
    //     $referrer = User::find($user->referrer_id);

    //     if ($referrer) {
    //         // Referrer gets 10
    //         $referrer->balance += 10;
    //         $referrer->save();
    //         Referral_Reward::create([
    //             'user_id' => $user->id,
    //             'referrer_id' => $referrer->id,
    //             'amount' => 10,
    //         ]);

    //         $referrerLevel2 = User::find($referrer->referrer_id);
    //         if ($referrerLevel2) {
    //             // Referrer Level 2 gets 2
    //             $referrerLevel2->balance += 2;
    //             $referrerLevel2->save();
    //             Referral_Reward::create([
    //                 'user_id' => $user->id,
    //                 'referrer_id' => $referrerLevel2->id,
    //                 'amount' => 2,
    //             ]);

    //             $referrerLevel3 = User::find($referrerLevel2->referrer_id);
    //             if ($referrerLevel3) {
    //                 // Referrer Level 3 gets 1
    //                 $referrerLevel3->balance += 1;
    //                 $referrerLevel3->save();
    //                 Referral_Reward::create([
    //                     'user_id' => $user->id,
    //                     'referrer_id' => $referrerLevel3->id,
    //                     'amount' => 1,
    //                 ]);
    //                 $referrerLevel4 = User::find($referrerLevel3->referrer_id);
    //                 if ($referrerLevel4) {
    //                     // Referrer Level 3 gets 1
    //                     $referrerLevel4->balance += 1;
    //                     $referrerLevel4->save();
    //                     Referral_Reward::create([
    //                         'user_id' => $user->id,
    //                         'referrer_id' => $referrerLevel4->id,
    //                         'amount' => 1,
    //                     ]);
                        
    //                 }
    //             }
    //         }
    //     }
    // }


    // this function used for login users
    public function login(Request $request){
        $credencials=$request->validate([
            'email'=>'required|email',
            'password'=>'required|min:4',
        ]);
        if(Auth::attempt($credencials)){
            return redirect()->route('dashboard')->with('success', 'Your are login successfully.');
        }
        return redirect()->route('login.page')->with('error', 'Your credencials not matched.');
    }


    // this function used for logout users
    public function userLogout(){
        Auth::logout();
        return redirect()->route('login.page');
    }

    
    // this function used for load dashboard with data
    public function dashboard(){
        if(!Auth::check()){
            return redirect()->route('login.page');
        }
        $earnpoint=User::with(['referrals','referralRewards','triggeredReferralRewards',])->where('id',Auth::id())->get();
        // dd($earnpoint);
        return view('dashboard')->with(['userdata'=>$earnpoint]);
    }

    // this function used for load referral register page
    public function referralRegisterPage(Request $request){
        if($request->referral){
            //$parent = User::where('referral_id',$request->referral)->first();
            $user=User::find($request->referral);	
            if($user){
                return view('referalregister')->with('referral',$user->id);
            }
            
        }
        return redirect()->route('login.page')->with('error', 'Your referral id invalid');

    }

    public function profile(){
        $user = User::find(Auth::id());
        return view('profile')->with('user',$user);
    }
    public function MyReferral(){
        $myreferral = User::where('referrer_id',Auth::id())->get();
        return view('myreferral')->with('myreferral',$myreferral);
    }
    
    
    
    // public function MyTree(){
    //     $userid=Auth::id();
    // 	//$mytree = Referral_Reward::with('user')->where('referrer_id',$userid)->get();
    //     $user=User::where('id',$userid)->first();
    //     $mytree=$this->fetch_all_referral($userid);
    //     //dd($mytree);
        
    //     return view('mytree')->with(['members'=>$mytree, 'users'=>$user]);
    // }
    // public  function children($id)
    // {
    //     return User::where('referrer_id',$id)->get();
    // }

    // public  function fetch_all_referral($id)
    // {
    //     static $refferal = array();

    //     if($this->children($id)->isNotEmpty())
    //     {
    //         foreach($this->children($id) as $child)
    //         {  
    //             $refferal[] = ['name'=>$child->name,'code'=>$child->email,'level'=>$child->user_level];
    //             if($this->children($child->id)->isNotEmpty())
    //             {
    //                Self::fetch_all_referral($child->id);
    //             }
    //         }
    //     }

       
    //     return $refferal; 

    // }
    // public function MyTree() {
    //     $userid = Auth::id();
    //     $user = User::where('id', $userid)->first();
        
    //     // Fetch the referral tree using the recursive function
    //     $mytree = $this->fetch_all_referral($userid);
        
    //     // Pass the tree data to the view
    //     return view('mytree')->with(['members' => $mytree, 'user' => $user]);
    // }
    
    // public function children($id) {
    //     return User::where('referrer_id', $id)->get();
    // }
    
    // public function fetch_all_referral($id, &$referral = []) {
    //     // Get all direct referrals of the user
    //     $children = $this->children($id);
    
    //     if ($children->isNotEmpty()) {
    //         foreach ($children as $child) {
    //             // Add the referral to the array
    //             $referral[] = [
    //                 'name' => $child->name,
    //                 'email' => $child->email,
    //                 'level' => $child->user_level,
    //                 'id' => $child->id
    //             ];
    
    //             // Recursively fetch this child's referrals
    //             $this->fetch_all_referral($child->id, $referral);
    //         }
    //     }
    
    //     return $referral;
    // }

    /** level by tree */
    public function MyTree(){
        $userid = Auth::id();
        $user = User::where('id', $userid)->first();
    
        // Fetch all referrals with their associated levels
        $members = $this->fetch_all_referral($userid);
        //dd($members);
        return view('mytree')->with(['members' => $members, 'user' => $user]);
    }
    
    
    public function fetch_all_referral($id, $level = 1)
    {
        $referrals = User::where('referrer_id', $id)->get();
        $tree = [];
    
        foreach ($referrals as $referral) {
            $tree[] = [
                'id' => $referral->id,
                'name' => $referral->name,
                'level' => $level,
                'state' => $referral->state,
                'cfm'=> $referral->cfm,
                'children' => $this->fetch_all_referral($referral->id, $level + 1)
            ];
        }
    
        return $tree;
    }
    
    public function EarnHistory(){
        $history=Referral_Reward::with('user')->where('referrer_id',Auth::id())->get();
        //dd($history);
        return view('earn_history')->with('histories',$history);
    }
    

    public function editUser($id){
        $user=User::find($id);
        if(!$user){
            return redirect()->route('login.page')->with('error', 'invalid');
        }
        return view('edituser')->with('user',$user);
    }
    public function updateUser(Request $request){
        $user=User::find($request->id);
        $user->update(
            [
                'name'=>$request->name,
                'email'=>$request->email,
                'state'=>$request->state,
                'cfm'=>$request->cfm,
            ]
        );
        return redirect()->route('dashboard');
    }
}

