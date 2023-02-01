<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblregistration;
use App\Models\tbllogin;
use App\Models\tblchallenge;
use App\Models\tbllibrary;
use App\Models\tblbook;
use App\Models\tblfriend;
use App\Models\tblpost;
use App\Models\tblpersonalstore;
use App\Models\tblsuspention;
use Session;
use DB;
use Auth;
use Hash;
use Sentinel;
use Reminder;


class LoginController extends Controller
{

    
    function login(Request $req){
        $req->validate([
            'uname' => 'required',
            'pass' => 'required',  
        ]);
             
             $user = tbllogin::where('email','=',$req->uname)->first(); //first()- single rec. one row
             if($user){
                if(Hash::check($req->pass,$user->password)){
                    $req->session()->put('loginId',$user->loginid);
                    $user = tblregistration::where('userid',$user->userid)->first();
                    if($user->status == 2)
                        return redirect('memhome');
                    else if($user->status == 1)
                        return redirect('adminDashboard');
                    else if($user->status == 0)
                        return back()->with('fail','Your account is blocked! Contact customercareblounge@gmail.com for more details.');
                    else if($user->status == 3){
                        $sus = tblsuspention::where('userid',$user->userid)->first();
                        $date = date_diff(date_create($sus->end_date),date_create($sus->created_at));
                        $day = $date->format('%a')-1;
                        return back()->with('fail','Your account has been suspended for '.$day.' days !!');
                    }
                    else
                        return back()->with('fail','This email is not registered.');

                }
                else{
                        return back()->with('fail','Incorrect Password');
                }
             }
             else{
                    return back()->with('fail','This email is not registered.');
             } 
    }

    public function adminDashboard(){
        if(Session::has('loginId')){
            $data = array();
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            return view('AdDashboard', compact('data','user'));
        }       
    }

    public function memhome(){
        $data = array();
        if(Session::has('loginId')){
            $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
            $user = tblregistration::where('userid',$data->userid)->first();
            // echo $user->userid;
            $challenge = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
                if($challenge->goal==0){
                    $width=0;
                }
                else{
                    $width = ($challenge->completedgoal*100)/$challenge->goal;
                }
                $tbr = tbllibrary::where('userid',$user->userid)->where('status',1)->get();
                $curr = tbllibrary::where('userid',$user->userid)->where('status',2)->get();
                $done = tbllibrary::where('userid',$user->userid)->where('status',3)->get();
                $challengecheck = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
                $librarycheck =  tbllibrary::where('userid',$user->userid)->where('status',3)->where('updated_at','>=',$challenge->Createdat)->get();
                $tobesold = tblpersonalstore::where('userid',$user->userid)->where('status',1)->get();
                $soldbooks = tblpersonalstore::where('userid',$user->userid)->where('status',0)->get();
                $followers = tblfriend::where('userid',$user->userid)->where('approved',1)->first();
                $followpost = array();
                if($followers!="")
                    $followpost = tblpost::where('userid',$followers->friendid)->get();
                // tblchallenge::where('userid',$user->userid)->where('status',1)->update(['completedgoal'=>count($librarycheck)]);
                $completedbooks = tblbook::all();
                
        }
        return view('userpage', compact('data','user','challenge','width','tbr','curr','done','librarycheck','completedbooks','followpost','tobesold','soldbooks'));
    }

    public function logout(Request $request){
        // if(Session::has('loginId')){
            // Session::pull('loginId');
            // Auth::logout();
            header("cache-Control: no-store, no-cache, must-revalidate");
            header("cache-Control: post-check=0, pre-check=0", false);
            header("Pragma: no-cache");
            header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");

            Session::flush();
            // $request->session()->regenerate();
            // Session::flash('succ_message', 'Logged out Successfully');
            return redirect('/login');
        }
    // }
}