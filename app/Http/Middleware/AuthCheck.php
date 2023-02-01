<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthCheck
{
    /**
   * Handle an incoming request.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \Closure  $next
   * @return mixed
   */
  public function handle($request, Closure $next) {
    // $response = $next($request);
 
            // $response->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
            // ->header('Pragma','no-cache')
            // ->header('Expires','Sat, 26 Jul 1997 05:00:00 GMT');
    // }
        if(!Session()->has('loginId')){
            return redirect('/login')->with('fail','You have to login first');
        }
        return $next($request);
  }
    
}
