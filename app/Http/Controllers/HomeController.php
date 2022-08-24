<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Auth;
use App\Models\ReferralLink;
use App\Models\ReferralRelationship;
use App\Models\User;
use URL;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        if(Auth::user()->role == "admin"){
            $detail_data = ReferralLink::all();
            return view('admin_dashboard',compact('detail_data'));
        }
        else
        {$referral_data = ReferralLink::where('user_id', Auth::id())->get();
                foreach ($referral_data as $data) {
                    if (ReferralRelationship::where('referral_link_id', '=', $data->id)->exists()) {
                        ReferralLink::where('id',$data->id)->update(['status' => 2]);
                    }
                }
                $referral_count = ReferralLink::where('user_id', Auth::id())->where('status', 2)->count();
                
                return view('home', compact('referral_data','referral_count'));
        }
    }

    public static function UserName($user_id){
        $user = User::where('id', $user_id)->value('name');
        return $user;
    }
    
    public function mail(Request $request){
        
        $data = $request->all();
        $count = ReferralLink::where('user_id', Auth::id())->where('status', 2)->count();
        if($count > 10){
            $message[] = "No of referral exceed for this account";
            return redirect()->back()->with('success', $message);
        }
        if(!empty($data)){
            
            $message = [];
            foreach ($request->all() as $request_email) {
                $data_exist_check = ReferralLink::where('id', Auth::user()->id)->where('referral_email', '=', $request_email)->first();
                
                 // check email exist
                if (User::where('email', '=', $request_email)->exists()) {
                    
                    $message[] = "$request_email already exist";
                }
                //already invited user
                elseif(ReferralLink::where('referral_email', $request_email)->count() > 0){
                     
                    $message[] = "$request_email already Invited";
                }
                else{ 
                    
                    $ref_code = (string)Uuid::uuid1();
                               
                    $data = array('user_id'=>Auth::user()->id, 'referral_program_id'=> 1, 'referral_email' =>$request_email,'code'=> $ref_code);
                   
                    $input = ReferralLink::create($data);
                    $base_url = URL::to('');
                    $ref_code_url = "$base_url/register?refer=$input->code";
   
                   $data2  =  array('url'=> $ref_code_url,'sender'=>Auth::user()->name);
                   
                   $sender_email = Auth::user()->email;
           
                   //Send mail to referrer 
              
                   \Mail::send('email.mail', $data2, function($message) use ($request, $sender_email,$request_email){
                       $message->from(Auth::user()->email, Auth::user()->name);
                       $message->to($request_email)->subject( Auth::user()->name ."  ". 'recommends ContactOut');
                   });
                   
                   $message[] = "Mail has been sent to $request_email";
                }
            }
            
            return redirect()->back()->with('success', $message);
        }
        else{
            $message[] = "Please Try again";
            return redirect()->back()->with('success', $message);
        }
        
    }
}
