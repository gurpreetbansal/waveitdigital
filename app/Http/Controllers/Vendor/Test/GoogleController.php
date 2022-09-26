<?php

namespace App\Http\Controllers\Vendor\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GoogleController extends Controller {

	public function connect_ga4(){
		return view('vendor.test.google');
	}

	

}