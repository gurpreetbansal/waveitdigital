<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Request;
use App\User;

class Vendor {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {
        if (Auth::check()) {
            $user_id = User::get_parent_user_id(Auth::user()->id); //get user id from child
            // if(Request::segment(1) !== 'profile-settings' && Request::segment(1) !== 'cancelled-subscription'){
            //     $check = User::check_subscription($user_id); 
            //     if($check == 'expired' || $check == 'cancelled'){
            //         return redirect()->to('/profile-settings');
            //     }
            // }  
             
            return $next($request);
        }
        return redirect('/login');
    }

}
