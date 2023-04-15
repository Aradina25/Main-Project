<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblregistration;
use App\Models\tbllogin;
use App\Models\tblfriend;
use App\Models\tbllibrary;
use App\Models\tblchallenge;
use App\Models\tblprofilepicture;
use App\Models\tblpost;
use App\Models\tblpersonalstore;
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

    public function friendprofileview($friendid){
        $chal = new tblchallenge;
        $data =  tbllogin::where('loginid',"=",Session::get('loginId'))->first();
        $user = tblregistration::where('userid',$data->userid)->first();
        $frnd = tblregistration::where('userid',$friendid)->first();
        $profile = tblprofilepicture::where('userid',$friendid)->first();
        $follow = tblfriend::where('userid',$user->userid)->where('approved',1)->get();
        $posts = tblpost::where('userid',$friendid)->orderBy('created_at', 'desc')->get();
        $challenge = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
        if($challenge->goal==0){
            $width=0;
        }
        else{
            $width = ($challenge->completedgoal*100)/$challenge->goal;
        }
        $challengecheck = tblchallenge::where('userid',$user->userid)->where('status',1)->first();
        $librarycheck =  tbllibrary::where('userid',$user->userid)->where('status',3)->where('updated_at','>=',$challengecheck->Createdat)->get();
        tblchallenge::where('userid',$user->userid)->where('status',1)->update(['completedgoal'=>count($librarycheck)]);
        $chal->update();
        $tobesold = tblpersonalstore::where('userid',$user->userid)->where('status',1)->get();
        $soldbooks = tblpersonalstore::where('userid',$user->userid)->where('status',0)->get();
        // tblchallenge::where('userid',$user->userid)->where('status',1)->update(['completedgoal'=>count($librarycheck)]);
        $tbr = tbllibrary::where('userid',$user->userid)->where('status',1)->get();
        $curr = tbllibrary::where('userid',$user->userid)->where('status',2)->get();
        $done = tbllibrary::where('userid',$user->userid)->where('status',3)->get(); 
        return view('friendprofile', compact('user','data','profile','challenge','tbr','curr','done','librarycheck','width','posts','tobesold','soldbooks','frnd','follow'));
    }
}
