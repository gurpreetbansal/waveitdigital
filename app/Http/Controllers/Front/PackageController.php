<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Package;
use App\UserPackage;
use App\User;
use Session;
use Auth;
use Cookie;


class PackageController extends Controller {

    public function index(){
        if(Session::get('referrer') !== ''){
            Session::forget('referrer');
        }

        if (isset($_SERVER['HTTP_REFERER'])) {
            $details=parse_url($_SERVER['HTTP_REFERER']);

            $word = 'agencydashboard.io';
            if(strpos($details['host'], $word) !== false){
               $phprefer = 'direct';
            }else{
                $phprefer = $details['host'];
            }
            Session::put('referrer', $phprefer);
            
        } else {
          Session::put('referrer', 'direct');
        }
        // Session::save();
        
    	$user = $user_package = array();
    	if((Auth::user()!=NULL) && !empty(Auth::user())){
    		$user = User::select('subscription_status','user_type')->where('id',Auth::user()->id)->first();
	    	$user_package = UserPackage::where('user_id',Auth::user()->id)->latest()->first();
            $user->setAttribute('previous_route', 'pricing');
	    }
    	$packages = Package::with(['package_feature'=>function($q){
            $q->where('status',1);
        }])->where('status',1)->get(); 

        // echo "<pre>";
        // print_r(Session::get('referrer'));

        return view('front.pricing', ['packages' => $packages,'user_package' => $user_package,'user' => $user]);
    }

    public function index_design(){
        return view('front.pricing_design');
    }


}
