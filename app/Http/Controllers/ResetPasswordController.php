<?php 

namespace App\Http\Controllers; 
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\tbllogin;
class ResetPasswordController extends Controller { 

  public function getPassword($token) { 

     return view('resetPassword', ['token' => $token]);
  }

  public function updatePassword(Request $request)
  {
    
  $request->validate([
      'email' => 'required|email|exists:tbllogins'

  ]);
  $updatePassword = DB::table('password_resets')
                      ->where(['email' => $request->email, 'token' => $request->token])
                      ->first();

    if(!$updatePassword){
        return back()->withInput()->with('error', 'Invalid token!');
    }

    $user = tbllogin::where('email', $request->email)
                ->update(['password' => Hash::make($request->password)]);

    DB::table('password_resets')->where(['email'=> $request->email])->delete();

    return redirect('/login')->with('fail', 'Your password has been changed!');

  }
}