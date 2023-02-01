<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblregistration;
use App\Models\tbllogin;
use App\Models\tblfriend;
use Session;

class friendController extends Controller
{
    public function follow(Request $req,$friendid){
        $follow = new tblfriend;
        $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
        $user = tblregistration::where('userid',$data->userid)->first();
        $follower = tblfriend::where('userid',$user->userid)->where('friendid',$friendid)->first();
        if($follower ==""){
           $follow->userid = $user->userid;
            $follow->friendid = $friendid;
            $follow->approved = 1;
            $follow->save(); 
        }
        else{
            if($follower->approved == 1)
                tblfriend::where('userid',$user->userid)->where('friendid',$friendid)->update(['approved'=>0]);
            else
                tblfriend::where('userid',$user->userid)->where('friendid',$friendid)->update(['approved'=>1]);
        }
        
        return redirect()->back();
    }
}
