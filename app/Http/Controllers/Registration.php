<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tblregistration;
use App\Models\tbllogin;
use App\Models\tblchallenge;
use DB;
use Hash;

class Registration extends Controller
{
    function register(Request $req){
        $logindet = new tbllogin;
        $challenge = new tblchallenge;

        $req->validate([
            'fname' => 'required|max:30|',
            'dob' => 'required|date|before:-13 years',
            'email' => 'required|unique:tbllogins,email|email',
            'pass' => 'required|regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*#?&])[A-Za-z0-9!@$%*#?&]{6,16}$/|confirmed',  
            //Should have At least one Uppercase letter.
            // At least one Lower case letter.
            // Also,At least one numeric value.
            // And, At least one special character.
            // Must be more than 6 characters long.
            'pass_confirmation' => 'required'
        ]);    

        $challenge->userid = $logindet->userid = DB::table('tblregistrations')->insertGetId(
            ['fullname' =>preg_replace('/\s+/', ' ',$req->fname),'dob' => $req->dob,'age'=>$req->age,'status'=>'2']
        );

        $logindet->email=$req->email;
        $logindet->password=Hash::make($req->pass);
        $logindet->save();

        $challenge->save(); 
        
        return redirect('/login');


    }
}
